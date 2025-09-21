<?php
/**
 * Theme functions and definitions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function talenavi_event_setup() {
    // Add theme support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Add theme support for title tag
    add_theme_support('title-tag');
    
    // Add theme support for custom logo
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'talenavi_event_setup');

/**
 * Enqueue scripts and styles
 */
function talenavi_event_scripts() {
    // Enqueue theme stylesheet
    wp_enqueue_style('talenavi-event-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue WordPress jQuery
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'talenavi_event_scripts');


/**
 * Event Formatter Class
 * Handles all event data formatting in a centralized way
 */
class EventFormatter {
    
    /**
     * Format event datetime
     */
    public static function format_datetime($datetime, $format_type = 'both') {
        if (!$datetime) {
            return $format_type === 'both' ? ['date' => '', 'time' => ''] : '';
        }
        
        $datetime_obj = self::parse_datetime($datetime);
        
        if (!$datetime_obj) {
            return $format_type === 'both' ? ['date' => '', 'time' => ''] : '';
        }
        
        switch ($format_type) {
            case 'date':
                return $datetime_obj->format('l, M j');
            case 'time':
                return $datetime_obj->format('H:i');
            case 'full':
                return $datetime_obj->format('l, M j \a\t H:i');
            case 'iso':
                return $datetime_obj->format('Y-m-d H:i:s');
            case 'both':
            default:
                return [
                    'date' => $datetime_obj->format('l, M j'),
                    'time' => $datetime_obj->format('H:i')
                ];
        }
    }
    
    /**
     * Parse datetime from various formats
     */
    private static function parse_datetime($datetime) {
        $formats = ['Y-m-d H:i:s', 'Y-m-d', 'Y/m/d H:i:s', 'Y/m/d', 'd/m/Y H:i:s', 'd/m/Y'];
        
        foreach ($formats as $format) {
            $datetime_obj = DateTime::createFromFormat($format, $datetime);
            if ($datetime_obj !== false) {
                return $datetime_obj;
            }
        }
        
        // Fallback to strtotime
        $timestamp = strtotime($datetime);
        if ($timestamp !== false) {
            $datetime_obj = new DateTime();
            $datetime_obj->setTimestamp($timestamp);
            return $datetime_obj;
        }
        
        return false;
    }
    
    /**
     * Format price with Indonesian Rupiah format
     */
    public static function format_price($price, $show_free = true) {
        if (!$price || $price <= 0) {
            return $show_free ? 'Gratis' : '';
        }
        
        return 'Rp ' . number_format($price, 0, ',', '.');
    }
    
    /**
     * Get banner URL with fallback
     */
    public static function get_banner_url($event_id, $event_banner = null, $fallback_image = 'event-1.jpg') {
        $banner_url = '';
        
        // Try Pods first
        if (function_exists('pods')) {
            $pod = pods('event', $event_id);
            if ($pod && $pod->exists()) {
                $pods_banner = $pod->field('event_banner');
                if (is_array($pods_banner) && isset($pods_banner['guid'])) {
                    $banner_url = $pods_banner['guid'];
                }
            }
        }
        
        // Try custom field
        if (!$banner_url && $event_banner) {
            if (is_numeric($event_banner)) {
                $banner_url = wp_get_attachment_image_url($event_banner, 'large');
            } else {
                $attachment_id = intval($event_banner);
                if ($attachment_id > 0) {
                    $banner_url = wp_get_attachment_image_url($attachment_id, 'large');
                }
            }
        }
        
        // Fallback image
        if (!$banner_url) {
            $banner_url = get_template_directory_uri() . '/assets/images/' . $fallback_image;
        }
        
        return $banner_url;
    }
    
    /**
     * Get event category name with fallback
     */
    public static function get_category_name($event_id) {
        // Try event_category taxonomy first
        $categories = wp_get_post_terms($event_id, 'event_category');
        if (!empty($categories) && !is_wp_error($categories)) {
            return $categories[0]->name;
        }
        
        // Fallback to default WordPress categories
        $categories = wp_get_post_terms($event_id, 'category');
        if (!empty($categories) && !is_wp_error($categories)) {
            return $categories[0]->name;
        }
        
        return '';
    }
    
    /**
     * Format complete event data
     */
    public static function format_event_data($event, $custom_fields = []) {
        $event_datetime = get_post_meta($event->ID, 'event_datetime', true);
        $event_location = get_post_meta($event->ID, 'event_location', true);
        $event_price = get_post_meta($event->ID, 'event_price', true);
        $event_banner = get_post_meta($event->ID, 'event_banner', true);
        
        // Format datetime
        $datetime_formatted = self::format_datetime($event_datetime);
        
        // Base event data
        $event_data = [
            'id' => $event->ID,
            'title' => $event->post_title,
            'content' => $event->post_content,
            'datetime' => $event_datetime,
            'location' => $event_location,
            'price' => $event_price,
            'banner_url' => self::get_banner_url($event->ID, $event_banner),
            'category' => self::get_category_name($event->ID),
            'formatted_date' => $datetime_formatted['date'],
            'formatted_time' => $datetime_formatted['time'],
            'formatted_price' => self::format_price($event_price),
            'formatted_datetime_full' => self::format_datetime($event_datetime, 'full'),
            'formatted_datetime_iso' => self::format_datetime($event_datetime, 'iso')
        ];
        
        // Add any custom fields
        foreach ($custom_fields as $field_key => $field_name) {
            $event_data[$field_key] = get_post_meta($event->ID, $field_name, true);
        }
        
        return $event_data;
    }
}

// AJAX handler for event search and filtering
add_action('wp_ajax_search_events', 'handle_event_search');
add_action('wp_ajax_nopriv_search_events', 'handle_event_search');
add_action('wp_ajax_get_events', 'get_events');
add_action('wp_ajax_nopriv_get_events', 'get_events');

function handle_event_search() {
    $search_term = sanitize_text_field($_POST['search_term']);
    $location = sanitize_text_field($_POST['location']);
    $category = sanitize_text_field($_POST['category']);
    $date_filter = sanitize_text_field($_POST['date_filter']);
    
    // Debug logging
    error_log("Search term: " . $search_term);
    error_log("Location: " . $location);
    error_log("Category: " . $category);
    error_log("Date filter: " . $date_filter);
    
    $args = array(
        'post_type' => array('post', 'event'),
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );
    
    // Add search term if provided (searches in title only)
    if (!empty($search_term)) {
        // Use a custom filter to search only in post title
        add_filter('posts_where', function($where, $wp_query) use ($search_term) {
            global $wpdb;
            if (!empty($search_term)) {
                $where .= " AND {$wpdb->posts}.post_title LIKE '%" . esc_sql($wpdb->esc_like($search_term)) . "%'";
            }
            return $where;
        }, 10, 2);
        
        // Set a flag to remove the filter after this query
        $args['title_search_only'] = true;
    }
    
    // Build meta_query array
    $meta_query = array();
    
    // Add location search if provided (searches in event_location meta field)
    if (!empty($location)) {
        $meta_query[] = array(
            'key' => 'event_location',
            'value' => $location,
            'compare' => 'LIKE'
        );
    }
    
    // Add date filter if provided
    if (!empty($date_filter) && $date_filter !== 'any-date') {
        $date_meta_query = get_date_meta_query($date_filter);
        if ($date_meta_query) {
            $meta_query[] = $date_meta_query;
        }
    }
    
    // Set meta_query if we have conditions
    if (!empty($meta_query)) {
        if (count($meta_query) > 1) {
            $args['meta_query'] = array_merge(array('relation' => 'AND'), $meta_query);
        } else {
            $args['meta_query'] = $meta_query;
        }
    }
    
    // Add category filter if provided
    if (!empty($category)) {
        $args['tax_query'] = array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'event_category',
                'field'    => 'name',
                'terms'    => $category,
            )
        );
    }
    
    $events = get_posts($args);
    
    // Remove the title search filter after query execution
    if (!empty($search_term) && isset($args['title_search_only'])) {
        remove_all_filters('posts_where');
    }
    
    $event_data = array();
    
    // Debug logging
    error_log("Found " . count($events) . " events");
    foreach ($events as $event) {
        error_log("Event ID: " . $event->ID . ", Title: " . $event->post_title . ", Content: " . substr($event->post_content, 0, 100));
    }
    
    foreach ($events as $event) {
        // Get custom fields with Pods fallback
        $event_datetime = get_post_meta($event->ID, 'event_datetime', true);
        $event_banner = get_post_meta($event->ID, 'event_banner', true);
        $event_location = get_post_meta($event->ID, 'event_location', true);
        $event_price = get_post_meta($event->ID, 'event_price', true);
        
        // Use Pods if available
        if (function_exists('pods')) {
            $pod = pods('event', $event->ID);
            if ($pod && $pod->exists()) {
                $event_datetime = $pod->field('event_datetime') ?: $event_datetime;
                $event_banner = $pod->field('event_banner') ?: $event_banner;
                $event_location = $pod->field('event_location') ?: $event_location;
                $event_price = $pod->field('event_price') ?: $event_price;
            }
        }
        
        // Use EventFormatter to format all event data
        $formatted_event = EventFormatter::format_event_data($event);
        
        // Override with Pods data if available
        if ($event_datetime) $formatted_event['datetime'] = $event_datetime;
        if ($event_location) $formatted_event['location'] = $event_location;
        if ($event_price) $formatted_event['price'] = $event_price;
        if ($event_banner) {
            $formatted_event['banner_url'] = EventFormatter::get_banner_url($event->ID, $event_banner);
        }
        
        // Re-format datetime and price with updated values
        $datetime_formatted = EventFormatter::format_datetime($event_datetime);
        $formatted_event['formatted_date'] = $datetime_formatted['date'];
        $formatted_event['formatted_time'] = $datetime_formatted['time'];
        $formatted_event['formatted_price'] = EventFormatter::format_price($event_price);
        $formatted_event['formatted_datetime_full'] = EventFormatter::format_datetime($event_datetime, 'full');
        $formatted_event['formatted_datetime_iso'] = EventFormatter::format_datetime($event_datetime, 'iso');
        
        $event_data[] = $formatted_event;
    }
    
    wp_send_json_success($event_data);
}

/**
 * Get date meta query based on filter value
 */
function get_date_meta_query($date_filter) {
    $current_date = current_time('Y-m-d');
    $current_datetime = current_time('Y-m-d H:i:s');
    
    switch ($date_filter) {
        case 'today':
            return array(
                'key' => 'event_datetime',
                'value' => array($current_date . ' 00:00:00', $current_date . ' 23:59:59'),
                'compare' => 'BETWEEN',
                'type' => 'DATETIME'
            );
            
        case 'tomorrow':
            $tomorrow = date('Y-m-d', strtotime($current_date . ' +1 day'));
            return array(
                'key' => 'event_datetime',
                'value' => array($tomorrow . ' 00:00:00', $tomorrow . ' 23:59:59'),
                'compare' => 'BETWEEN',
                'type' => 'DATETIME'
            );
            
        case 'this-week':
            $week_start = date('Y-m-d', strtotime('monday this week', strtotime($current_date)));
            $week_end = date('Y-m-d', strtotime('sunday this week', strtotime($current_date)));
            return array(
                'key' => 'event_datetime',
                'value' => array($week_start . ' 00:00:00', $week_end . ' 23:59:59'),
                'compare' => 'BETWEEN',
                'type' => 'DATETIME'
            );
            
        case 'this-weekend':
            $saturday = date('Y-m-d', strtotime('saturday this week', strtotime($current_date)));
            $sunday = date('Y-m-d', strtotime('sunday this week', strtotime($current_date)));
            return array(
                'key' => 'event_datetime',
                'value' => array($saturday . ' 00:00:00', $sunday . ' 23:59:59'),
                'compare' => 'BETWEEN',
                'type' => 'DATETIME'
            );
            
        case 'next-week':
            $next_week_start = date('Y-m-d', strtotime('monday next week', strtotime($current_date)));
            $next_week_end = date('Y-m-d', strtotime('sunday next week', strtotime($current_date)));
            return array(
                'key' => 'event_datetime',
                'value' => array($next_week_start . ' 00:00:00', $next_week_end . ' 23:59:59'),
                'compare' => 'BETWEEN',
                'type' => 'DATETIME'
            );
            
        case 'this-month':
            $month_start = date('Y-m-01', strtotime($current_date));
            $month_end = date('Y-m-t', strtotime($current_date));
            return array(
                'key' => 'event_datetime',
                'value' => array($month_start . ' 00:00:00', $month_end . ' 23:59:59'),
                'compare' => 'BETWEEN',
                'type' => 'DATETIME'
            );
            
        default:
            return null;
    }
}

/**
 * Get event categories for filter
 */
function get_event_categories() {
    $categories_data = array();
    
    // First try to get event_category taxonomy
    $categories = get_terms(array(
        'taxonomy' => 'event_category',
        'hide_empty' => false
    ));
    
    if ($categories && !is_wp_error($categories) && !empty($categories)) {
        foreach ($categories as $category) {
            $categories_data[] = array(
                'slug' => $category->slug,
                'name' => $category->name,
                'count' => $category->count
            );
        }
    } 
    
    return $categories_data;
}