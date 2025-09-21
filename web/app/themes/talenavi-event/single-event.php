<?php
/**
 * Template for displaying single event posts
 */

get_header(); ?>

    <style>
        /* Main Content */
        .main-content {
            padding: var(--space-8) 0;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--space-8);
        }

        /* Hero Image */
        .hero-image-container {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-xl);
        }

        .hero-image {
            width: 100%;
            height: 320px;
            object-fit: cover;
        }

        .hero-controls {
            position: absolute;
            top: var(--space-4);
            left: 0;
            right: 0;
            z-index: 10;
            padding: 0 var(--space-4);
        }

        .hero-controls-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hero-controls .back-btn {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-3) var(--space-4);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-lg);
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: var(--font-size-sm);
            transition: all 0.2s;
        }

        /* Event Info */
        .event-info {
            display: flex;
            flex-direction: column;
            gap: var(--space-2);
            margin-top: var(--space-6);
        }

        .event-header h1 {
            font-size: var(--font-size-3xl);
            font-weight: bold;
            margin-bottom: var(--space-2);
        }

        .event-subtitle {
            font-size: var(--font-size-xl);
            color: hsl(var(--muted-foreground));
        }

        .event-meta {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            font-size: var(--font-size-sm);
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: var(--space-1);
        }

        .rating {
            color: #fbbf24;
        }

        .attendees {
            color: hsl(var(--muted-foreground));
        }

        /* Info Cards */
        .info-cards {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--space-4);
        }

        .info-card {
            background-color: hsl(var(--card));
            border: 1px solid hsl(var(--border));
            border-radius: var(--radius);
            padding: var(--space-4);
            box-shadow: var(--card-shadow);
        }

        .info-card-content {
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        .info-icon {
            width: var(--space-5);
            height: var(--space-5);
            color: hsl(var(--primary));
        }

        .info-text h3 {
            font-weight: 500;
            margin-bottom: var(--space-1);
        }

        .info-text p {
            font-size: var(--font-size-sm);
            color: hsl(var(--muted-foreground));
        }

        /* Content Sections */
        .content-section {
            margin-bottom: var(--space-8);
        }

        .section-title {
            font-size: var(--font-size-2xl);
            font-weight: bold;
            margin-bottom: var(--space-4);
        }

        .section-content {
            color: hsl(var(--foreground));
            line-height: 1.8;
            font-size: var(--font-size-base);
            max-width: none;
        }

        /* Article Typography Styling */
        .section-content h1,
        .section-content h2,
        .section-content h3,
        .section-content h4,
        .section-content h5,
        .section-content h6 {
            color: hsl(var(--foreground));
            font-weight: var(--font-weight-bold);
            line-height: var(--line-height-tight);
            margin-top: var(--space-8);
            margin-bottom: var(--space-4);
        }

        .section-content h1:first-child,
        .section-content h2:first-child,
        .section-content h3:first-child,
        .section-content h4:first-child,
        .section-content h5:first-child,
        .section-content h6:first-child {
            margin-top: 0;
        }

        .section-content h1 {
            font-size: var(--font-size-3xl);
        }

        .section-content h2 {
            font-size: var(--font-size-2xl);
        }

        .section-content h3 {
            font-size: var(--font-size-xl);
        }

        .section-content h4 {
            font-size: var(--font-size-lg);
        }

        .section-content h5,
        .section-content h6 {
            font-size: var(--font-size-base);
        }

        .section-content p {
            margin-bottom: var(--space-6);
            line-height: 1.8;
            color: hsl(var(--foreground));
        }

        .section-content p:last-child {
            margin-bottom: 0;
        }

        /* Lists */
        .section-content ul,
        .section-content ol {
            margin-bottom: var(--space-6);
            padding-left: var(--space-6);
        }

        .section-content li {
            margin-bottom: var(--space-2);
            line-height: 1.7;
        }

        .section-content li:last-child {
            margin-bottom: 0;
        }

        /* Nested lists */
        .section-content ul ul,
        .section-content ol ol,
        .section-content ul ol,
        .section-content ol ul {
            margin-top: var(--space-2);
            margin-bottom: var(--space-2);
        }

        /* Blockquotes */
        .section-content blockquote {
            border-left: 4px solid hsl(var(--primary));
            padding-left: var(--space-4);
            margin: var(--space-6) 0;
            font-style: italic;
            color: hsl(var(--muted-foreground));
            background-color: hsl(var(--muted) / 0.3);
            padding: var(--space-4);
            border-radius: var(--radius);
        }

        /* Links */
        .section-content a {
            color: hsl(var(--primary));
            text-decoration: underline;
            text-decoration-color: hsl(var(--primary) / 0.3);
            text-underline-offset: 2px;
            transition: all 0.2s ease;
        }

        .section-content a:hover {
            color: hsl(var(--primary));
            text-decoration-color: hsl(var(--primary));
        }

        /* Code */
        .section-content code {
            background-color: hsl(var(--muted));
            padding: 0.125rem 0.25rem;
            border-radius: 0.25rem;
            font-size: 0.875em;
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
        }

        .section-content pre {
            background-color: hsl(var(--muted));
            padding: var(--space-4);
            border-radius: var(--radius);
            overflow-x: auto;
            margin: var(--space-6) 0;
        }

        .section-content pre code {
            background-color: transparent;
            padding: 0;
        }

        /* Images */
        .section-content img {
            max-width: 100%;
            height: auto;
            border-radius: var(--radius);
            margin: var(--space-6) 0;
            box-shadow: var(--card-shadow);
        }

        /* Tables */
        .section-content table {
            width: 100%;
            border-collapse: collapse;
            margin: var(--space-6) 0;
            border: 1px solid hsl(var(--border));
            border-radius: var(--radius);
            overflow: hidden;
        }

        .section-content th,
        .section-content td {
            padding: var(--space-3) var(--space-4);
            text-align: left;
            border-bottom: 1px solid hsl(var(--border));
        }

        .section-content th {
            background-color: hsl(var(--muted));
            font-weight: var(--font-weight-semibold);
        }

        .section-content tr:last-child td {
            border-bottom: none;
        }

        /* Horizontal Rule */
        .section-content hr {
            border: none;
            height: 1px;
            background-color: hsl(var(--border));
            margin: var(--space-8) 0;
        }

        /* Strong and Emphasis */
        .section-content strong {
            font-weight: var(--font-weight-bold);
            color: hsl(var(--foreground));
        }

        .section-content em {
            font-style: italic;
        }

        /* Small text */
        .section-content small {
            font-size: var(--font-size-sm);
            color: hsl(var(--muted-foreground));
        }

        /* Highlights */
        .highlights-list {
            list-style: none;
            margin-top: var(--space-4);
        }

        .highlights-list li {
            display: flex;
            align-items: flex-start;
            gap: var(--space-2);
            margin-bottom: var(--space-2);
        }

        .highlight-icon {
            width: var(--space-4);
            height: var(--space-4);
            color: hsl(var(--primary));
            margin-top: var(--space-1);
            flex-shrink: 0;
        }

        /* Schedule */
        .schedule-card {
            background-color: hsl(var(--card));
            border: 1px solid hsl(var(--border));
            border-radius: var(--radius);
            padding: var(--space-6);
            box-shadow: var(--card-shadow);
        }

        .schedule-item {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            margin-bottom: var(--space-4);
        }

        .schedule-item:last-child {
            margin-bottom: 0;
        }

        .schedule-time {
            width: 4rem;
            font-size: var(--font-size-sm);
            font-weight: 500;
            color: hsl(var(--primary));
        }

        .schedule-divider {
            width: 1px;
            height: var(--space-6);
            background-color: hsl(var(--border));
        }

        .schedule-activity {
            font-size: var(--font-size-sm);
            color: hsl(var(--muted-foreground));
        }

        /* Organizer */
        .organizer-card {
            background-color: hsl(var(--card));
            border: 1px solid hsl(var(--border));
            border-radius: var(--radius);
            padding: var(--space-6);
            box-shadow: var(--card-shadow);
        }

        .organizer-content {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        .organizer-avatar {
            width: var(--space-12);
            height: var(--space-12);
            background: var(--hero-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .organizer-info h3 {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-weight: 600;
            margin-bottom: var(--space-1);
        }

        .verified-icon {
            width: var(--space-4);
            height: var(--space-4);
            color: #10b981;
        }

        .organizer-description {
            font-size: var(--font-size-sm);
            color: hsl(var(--muted-foreground));
        }

        /* Sidebar */
        .sidebar {
            position: sticky;
            top: calc(var(--space-16) + var(--space-6));
        }

        .ticket-card {
            background-color: hsl(var(--card));
            border: 1px solid hsl(var(--border));
            border-radius: var(--radius);
            padding: var(--space-4);
            display: flex;
            flex-direction: column;
            gap: var(--space-6);
        }

        .ticket-title {
            font-size: var(--font-size-xl);
            font-weight: bold;
            margin-bottom: var(--space-4);
        }

        .ticket-options {
            display: flex;
            flex-direction: column;
            gap: var(--space-4);
            margin-bottom: var(--space-6);
        }

        .ticket-option {
            border: 1px solid hsl(var(--border));
            border-radius: var(--radius);
            padding: var(--space-4);
            cursor: pointer;
            transition: all 0.2s;
        }

        .ticket-option:hover {
            background-color: hsl(var(--accent) / 0.5);
        }

        .ticket-option.sold-out {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: hsl(var(--muted) / 0.2);
        }

        .ticket-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--space-2);
        }

        .ticket-type {
            font-weight: 600;
        }

        .ticket-price {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .price-current {
            font-size: var(--font-size-lg);
            font-weight: bold;
            color: hsl(var(--primary));
        }

        .price-original {
            font-size: var(--font-size-sm);
            color: hsl(var(--muted-foreground));
            text-decoration: line-through;
        }

        .ticket-benefits {
            list-style: none;
        }

        .ticket-benefits li {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: var(--font-size-sm);
            color: hsl(var(--muted-foreground));
            margin-bottom: var(--space-1);
        }

        .benefit-dot {
            width: 4px;
            height: 4px;
            background-color: hsl(var(--primary));
            border-radius: 50%;
        }

        .sold-out-badge {
            padding: var(--space-1) var(--space-2);
            background-color: hsl(var(--secondary));
            color: hsl(var(--secondary-foreground));
            border-radius: var(--radius);
            font-size: var(--font-size-xs);
        }

        .separator {
            height: 1px;
            background-color: hsl(var(--border));
            margin: var(--space-6) 0;
        }

        .cancellation-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            margin-top: var(--space-4);
            font-size: var(--font-size-sm);
            color: hsl(var(--muted-foreground));
        }

        /* Related Events */
        .related-events {
            margin-top: var(--space-16);
        }

        .related-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--space-8);
        }

        .related-title {
            font-size: var(--font-size-3xl);
            font-weight: bold;
        }

        .related-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--space-6);
        }

        /* Event Card */
        .event-card {
            background-color: hsl(var(--card));
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            border: 1px solid hsl(var(--border));
            transition: all 0.3s;
            cursor: pointer;
        }

        .event-card:hover {
            box-shadow: var(--card-shadow-hover);
            transform: translateY(-4px);
        }

        .event-image-wrapper {
            position: relative;
            overflow: hidden;
        }

        .event-image {
            width: 100%;
            height: 192px;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .event-card:hover .event-image {
            transform: scale(1.05);
        }

        .event-content {
            padding: var(--space-4);
        }

        .event-title {
            font-size: var(--font-size-lg);
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: var(--space-3);
        }

        .event-details {
            margin-bottom: var(--space-3);
        }

        .event-detail {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: var(--font-size-sm);
            color: hsl(var(--muted-foreground));
            margin-bottom: var(--space-2);
        }

        .event-detail-icon {
            width: var(--space-4);
            height: var(--space-4);
            color: hsl(var(--primary));
            flex-shrink: 0;
        }

        .event-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: var(--space-2);
        }

        .event-price {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        /* Icons */
        .icon {
            width: var(--space-4);
            height: var(--space-4);
        }

        @media (min-width: 768px) {
            .mobile-menu-btn {
                display: none;
            }
            .container {
                padding: 0 1.5rem;
            }

            .info-cards {
                grid-template-columns: 1fr;
            }

            .ticket-card{
                padding: var(--space-6);
            }

            .related-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-image {
                height: 400px;
            }
        }

        @media (min-width: 1024px) {
            .content-grid {
                grid-template-columns: 2fr 1fr;
            }

            .related-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .event-header h1 {
                font-size: var(--font-size-4xl);
            }
        }

        /* Countdown Timer */
        .countdown-container {
            padding: var(--space-6);
            background: linear-gradient(135deg, hsl(var(--primary) / 0.05) 0%, hsl(var(--accent)) 100%);
            border: 1px solid hsl(var(--primary) / 0.2);
            border-radius: var(--radius-lg);
        }

        .countdown-title {
            font-size: var(--font-size-lg);
            font-weight: var(--font-weight-semibold);
            color: hsl(var(--primary));
            text-align: center;
            margin-bottom: var(--space-4);
        }

        .countdown-timer {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--space-3);
        }

        .countdown-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: var(--space-3);
            background: hsl(var(--card));
            border: 1px solid hsl(var(--border));
            border-radius: var(--radius);
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .countdown-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow-hover);
        }

        .countdown-number {
            font-size: var(--font-size-2xl);
            font-weight: var(--font-weight-bold);
            color: hsl(var(--primary));
            line-height: 1;
            margin-bottom: var(--space-1);
        }

        .countdown-label {
            font-size: var(--font-size-xs);
            font-weight: var(--font-weight-medium);
            color: hsl(var(--muted-foreground));
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        @media (max-width: 640px) {
            .countdown-timer {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--space-2);
            }
            
            .countdown-item {
                padding: var(--space-2);
            }
            
            .countdown-number {
                font-size: var(--font-size-xl);
            }
            
            .countdown-label {
                font-size: 0.625rem;
            }
        }
    </style>

<?php if (have_posts()) : while (have_posts()) : the_post(); 
    // Get event data using EventFormatter
    $event = get_post();
    $formatted_event = EventFormatter::format_event_data($event);
    
    // Extract formatted data
    $event_datetime = $formatted_event['datetime'];
    $event_location = $formatted_event['location'];
    $event_price = $formatted_event['price'];
    $banner_url = $formatted_event['banner_url'];
    $category_name = $formatted_event['category'];
    $formatted_date = $formatted_event['formatted_date'];
    $formatted_time = $formatted_event['formatted_time'];
    $formatted_price = $formatted_event['formatted_price'];
    $formatted_datetime_full = $formatted_event['formatted_datetime_full'];
    $formatted_datetime_iso = $formatted_event['formatted_datetime_iso'];
?>

<!-- Main Content -->
<main class="container">
    <div class="main-content">
        <div class="content-grid">
            <!-- Main Column -->
            <div class="main-column">
                <!-- Hero Image -->
                <div class="hero-image-container">
                    <img src="<?php echo esc_url($banner_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="hero-image">
                    
                    <!-- Hero Controls -->
                    <div class="hero-controls">
                        <div class="hero-controls-content">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="back-btn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m15 18-6-6 6-6"/>
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Event Info -->
                <div class="event-info">
                <!-- Event Header -->
                <div class="event-header">
                    <h1><?php the_title(); ?></h1>
                </div>
                
                <!-- Event Description -->
                <div class="content-section">

                    <div class="section-content">
                        <?php 
                        $content = get_the_content();
                        if ($content) {
                            echo apply_filters('the_content', $content);
                        } else {
                            echo '<p>Deskripsi event akan segera tersedia. Pantau terus untuk informasi lebih lanjut!</p>';
                        }
                        ?>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar (Ticket Booking) -->
            <div class="sidebar">
                <div class="ticket-card">
                    <!-- Date & Time Card -->
                     <div class="info-cards">
                    <div class="info-card">
                        <div class="info-card-content">
                            <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <div class="info-text">
                                <h3>Tanggal & Waktu</h3>
                                <p>
                                    <?php if ($formatted_datetime_full): ?>
                                        <time datetime="<?php echo esc_attr($formatted_datetime_iso); ?>">
                                            <?php echo esc_html($formatted_datetime_full); ?>
                                        </time>
                                    <?php else: ?>
                                        Tanggal akan segera diumumkan
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Location Card -->
                    <div class="info-card">
                        <div class="info-card-content">
                            <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <div class="info-text">
                                <h3>Lokasi</h3>
                                <p><?php echo $event_location ? esc_html($event_location) : 'Lokasi akan segera diumumkan'; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Price Card -->
                    <div class="info-card">
                        <div class="info-card-content">
                            <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="1" x2="12" y2="23"/>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                            <div class="info-text">
                                <h3>Harga Tiket</h3>
                                <p><?php echo $formatted_price ? esc_html($formatted_price) : 'Gratis'; ?></p>
                            </div>
                        </div>
                    </div>
                     </div>

                    <!-- Countdown Timer -->
                    <div class="countdown-container">
                        <h3 class="countdown-title">Event Dimulai Dalam:</h3>
                        <div class="countdown-timer" id="countdown-timer">
                            <div class="countdown-item">
                                <span class="countdown-number" id="days">00</span>
                                <span class="countdown-label">Hari</span>
                            </div>
                            <div class="countdown-item">
                                <span class="countdown-number" id="hours">00</span>
                                <span class="countdown-label">Jam</span>
                            </div>
                            <div class="countdown-item">
                                <span class="countdown-number" id="minutes">00</span>
                                <span class="countdown-label">Menit</span>
                            </div>
                            <div class="countdown-item">
                                <span class="countdown-number" id="seconds">00</span>
                                <span class="countdown-label">Detik</span>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn btn-primary btn-lg" style="width: 100%; margin-bottom: 16px;" onclick="openWhatsApp('<?php echo esc_js(get_the_title()); ?>', '<?php echo esc_js($formatted_date); ?>', '<?php echo esc_js($event_location); ?>');">
                        Beli Tiket Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Share event function
function shareEvent() {
    if (navigator.share) {
        navigator.share({
            title: '<?php echo esc_js(get_the_title()); ?>',
            text: '<?php echo esc_js(get_the_excerpt() ?: "Jangan lewatkan event menarik ini!"); ?>',
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Link event telah disalin ke clipboard!');
        });
    }
}

<?php
// Build structured data array
$structured_data = array(
    "@context" => "https://schema.org",
    "@type" => "Event",
    "name" => get_the_title(),
    "description" => get_the_excerpt() ?: get_the_content(),
    "image" => $banner_url,
    "url" => get_permalink()
);

if ($formatted_datetime_iso) {
    $structured_data["startDate"] = $formatted_datetime_iso;
}

if ($event_location) {
    $structured_data["location"] = array(
        "@type" => "Place",
        "name" => $event_location
    );
}
?>

// Add structured data for SEO
const eventData = <?php echo json_encode($structured_data); ?>;

// Add structured data to page
const script = document.createElement('script');
script.type = 'application/ld+json';
script.textContent = JSON.stringify(eventData);
document.head.appendChild(script);

// Countdown Timer Functionality
function initCountdown() {
    // Get event date from PHP
    const eventDateString = '<?php echo esc_js($formatted_datetime_iso); ?>';
    
    if (!eventDateString) {
        // If no event date, hide countdown
        const countdownContainer = document.querySelector('.countdown-container');
        if (countdownContainer) {
            countdownContainer.style.display = 'none';
        }
        return;
    }
    
    const eventDate = new Date(eventDateString).getTime();
    
    // Update countdown every second
    const countdownInterval = setInterval(function() {
        const now = new Date().getTime();
        const distance = eventDate - now;
        
        // Calculate time units
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Update DOM elements
        const daysElement = document.getElementById('days');
        const hoursElement = document.getElementById('hours');
        const minutesElement = document.getElementById('minutes');
        const secondsElement = document.getElementById('seconds');
        
        if (daysElement) daysElement.textContent = days.toString().padStart(2, '0');
        if (hoursElement) hoursElement.textContent = hours.toString().padStart(2, '0');
        if (minutesElement) minutesElement.textContent = minutes.toString().padStart(2, '0');
        if (secondsElement) secondsElement.textContent = seconds.toString().padStart(2, '0');
        
        // If countdown is finished
        if (distance < 0) {
            clearInterval(countdownInterval);
            
            // Update countdown title
            const countdownTitle = document.querySelector('.countdown-title');
            if (countdownTitle) {
                countdownTitle.textContent = 'Event Telah Dimulai!';
                countdownTitle.style.color = 'hsl(var(--primary))';
            }
            
            // Set all numbers to 00
            if (daysElement) daysElement.textContent = '00';
            if (hoursElement) hoursElement.textContent = '00';
            if (minutesElement) minutesElement.textContent = '00';
            if (secondsElement) secondsElement.textContent = '00';
        }
    }, 1000);
}

// Initialize countdown when page loads
document.addEventListener('DOMContentLoaded', initCountdown);
</script>

<?php endwhile; endif; ?>

<?php get_footer(); ?>