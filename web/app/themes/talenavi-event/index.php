<?php get_header(); ?>

   <!-- Hero Section -->
    <section class="hero">
        <div class="hero-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-image.jpg" alt="Event venue" class="hero-image">
            <div class="hero-overlay"></div>
        </div>
        
        <div class="container">
            <div class="hero-content">
                <span class="hero-badge">Discover Amazing Events</span>
                <h1 class="hero-title">
                    Find Events That 
                    <span class="hero-gradient-text">Inspire You</span>
                </h1>
                <p class="hero-description">
                    Discover concerts, workshops, exhibitions, and more happening around you. 
                    Book tickets instantly and never miss out on amazing experiences.
                </p>
                
                <div class="hero-buttons">
                    <a href="#events" class="btn btn-primary btn-lg">
                        Explore Events
                        <svg class="icon icon-spacing" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12,5 19,12 12,19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <div class="search-card">
                <div class="search-grid">
                    <div class="search-input-wrapper">
                        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        <input type="text" class="search-input" placeholder="Search events, artists, or venues..." id="searchInput">
                    </div>
                    
                    <div class="search-input-wrapper">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <input type="text" class="search-input" placeholder="Enter location..." id="locationInput">
                    </div>
                    
                    <div class="select" id="dateSelect">
                        <div class="select-trigger" onclick="toggleDropdown('dateSelect')">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span id="dateSelectText">Date</span>
                            <svg class="select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="6,9 12,15 18,9"></polyline>
                            </svg>
                        </div>
                        <div class="select-content" id="dateSelectContent">
                            <div class="select-item" onclick="selectDate('today')">Today</div>
                            <div class="select-item" onclick="selectDate('tomorrow')">Tomorrow</div>
                            <div class="select-item" onclick="selectDate('this-week')">This Week</div>
                            <div class="select-item" onclick="selectDate('this-weekend')">This Weekend</div>
                            <div class="select-item" onclick="selectDate('next-week')">Next Week</div>
                            <div class="select-item" onclick="selectDate('this-month')">This Month</div>
                            <div class="select-item" onclick="selectDate('any-date')">Any Date</div>
                        </div>
                    </div>
                </div>
                
                <div class="search-categories">
                    <div class="categories-left">
                        <span class="categories-label">Categories:</span>
                    </div>
                    <div class="categories-right">
                          <div class="category-buttons">
                            <button class="btn btn-primary btn-sm category-btn active" data-category="">All Categories</button>
                            <?php 
                            $event_categories = get_event_categories();
                            if (!empty($event_categories)) {
                                foreach ($event_categories as $category) {
                                    echo '<button class="btn btn-outline btn-sm category-btn" data-category="' . esc_attr($category['name']) . '">' . esc_html($category['name']) . '</button>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="22,12 18,12 15,21 9,3 6,12 2,12"></polyline>
                    </svg>
                    <span class="stat-text">50K+ Events Listed</span>
                </div>
                <div class="stat-item">
                    <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"></polygon>
                    </svg>
                    <span class="stat-text">1M+ Happy Attendees</span>
                </div>
                <div class="stat-item">
                    <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <span class="stat-text">25+ Cities Covered</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Events -->
    <section class="events-section" id="events">
        <div class="container">
            
            <div class="events-grid" id="eventsGrid">
                <?php
                // Get events directly in PHP
                $events = get_posts(array(
                    'post_type' => array('post', 'event'),
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'meta_key' => 'event_datetime',
                    'orderby' => 'meta_value',
                    'order' => 'ASC'
                ));
                
                if (!empty($events)) {
                    foreach ($events as $event) {
                        // Get custom fields with Pods fallback
                        $event_datetime = get_post_meta($event->ID, 'event_datetime', true);
                        $event_banner = get_post_meta($event->ID, 'event_banner', true);
                        $event_location = get_post_meta($event->ID, 'event_location', true);
                        $event_price = get_post_meta($event->ID, 'event_price', true);
                        
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
                        
                        // Extract variables for template use
                        $formatted_date = $formatted_event['formatted_date'];
                        $formatted_time = $formatted_event['formatted_time'];
                        $formatted_price = $formatted_event['formatted_price'];
                        $banner_url = $formatted_event['banner_url'];
                        $category_name = $formatted_event['category'];
                        $event_location = $formatted_event['location'];
                ?>
                
                <div class="event-card" 
                     data-category="<?php echo esc_attr($category_name); ?>" 
                     data-title="<?php echo esc_attr($event->post_title); ?>" 
                     data-venue="<?php echo esc_attr($event_location); ?>" 
                     data-location="<?php echo esc_attr($event_location); ?>">
                    
                    <div class="event-image-wrapper">
                        <img src="<?php echo esc_url($banner_url); ?>" alt="<?php echo esc_attr($event->post_title); ?>" class="event-image">
                        <?php if ($category_name): ?>
                        <div class="event-badge badge-category"><?php echo esc_html($category_name); ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="event-content">
                        <h3 class="event-title"><?php echo esc_html($event->post_title); ?></h3>
                        
                        <div class="event-details">
                            <div class="event-detail">
                                <svg class="event-detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span><?php echo esc_html($formatted_date); ?></span>
                                <?php if ($formatted_time): ?>
                                <svg class="event-detail-icon icon-spacing" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12,6 12,12 16,14"></polyline>
                                </svg>
                                <span><?php echo esc_html($formatted_time); ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <?php if ($event_location): ?>
                            <div class="event-detail">
                                <svg class="event-detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span><?php echo esc_html($event_location); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="event-footer">
                            <?php if ($formatted_price): ?>
                            <div class="event-price">
                                <span class="price-current"><?php echo esc_html($formatted_price); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <button class="btn btn-primary btn-sm" onclick="event.stopPropagation();">
                                Get Tickets
                            </button>
                        </div>
                    </div>
                </div>
                
                <?php
                    }
                } else {
                ?>
                <div class="no-events-message">
                    <p>Belum ada event yang tersedia saat ini.</p>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>