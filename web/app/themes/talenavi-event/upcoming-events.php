<?php
/**
 * Template Name: Upcoming Events
 * 
 * Template untuk menampilkan upcoming events menggunakan shortcode
 */

get_header(); ?>

<main class="main-content">
    <div class="container">
        <!-- Upcoming Events Section -->
        <section class="upcoming-events-section">
            <div class="section-header">
                <h2 class="section-title">Event Terdekat</h2>
                <p class="section-description">Temukan event-event menarik yang akan segera berlangsung</p>
            </div>
            
            <!-- Shortcode untuk menampilkan upcoming events -->
            <?php echo do_shortcode('[upcoming_events limit="6" show_excerpt="true" show_date="true" show_location="true" show_price="true"]'); ?>
        </section>
    </div>
</main>

<style>
/* Hero Section */
.hero-section {
    background: var(--hero-gradient);
    color: white;
    padding: 4rem 0;
    text-align: center;
    margin-bottom: 3rem;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 1rem;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.25rem;
    opacity: 0.9;
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .hero-section {
        padding: 2rem 0;
    }
}

/* Section Styling */
.upcoming-events-section {
    margin-top: 2rem;
    margin-bottom: 4rem;
}

.section-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 600;
    color: hsl(var(--foreground));
    margin-bottom: 0.5rem;
}

.section-description {
    font-size: 1.125rem;
    color: hsl(var(--muted-foreground));
    max-width: 600px;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .section-title {
        font-size: 2rem;
    }
    
    .section-description {
        font-size: 1rem;
    }
}

/* CTA Section */
.cta-section {
    background: hsl(var(--muted));
    border-radius: var(--radius);
    padding: 3rem 2rem;
    text-align: center;
    margin-bottom: 3rem;
}

.cta-content {
    max-width: 600px;
    margin: 0 auto;
}

.cta-title {
    font-size: 2rem;
    font-weight: 600;
    color: hsl(var(--foreground));
    margin-bottom: 1rem;
}

.cta-description {
    font-size: 1.125rem;
    color: hsl(var(--muted-foreground));
    margin-bottom: 2rem;
}

.cta-button {
    background: hsl(var(--primary));
    color: hsl(var(--primary-foreground));
    border: none;
    padding: 1rem 2rem;
    border-radius: var(--radius);
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-block;
}

.cta-button:hover {
    background: hsl(var(--primary) / 0.9);
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .cta-section {
        padding: 2rem 1rem;
    }
    
    .cta-title {
        font-size: 1.5rem;
    }
    
    .cta-description {
        font-size: 1rem;
    }
    
    .cta-button {
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
    }
}

</style>

<?php get_footer(); ?>