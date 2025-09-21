<!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="EVENT Logo" style="height: 42px; width: auto; object-fit: contain; margin-bottom: 16px;">
                <p class="footer-description">
                    Connecting people through amazing events and unforgettable experiences.
                </p>
                <p class="footer-copyright">&copy; 2024 EventHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        let selectedCategory = '';
        let selectedDate = '';
        let searchTimeout = null;

        // AJAX function to filter events
        function filterEventsAjax() {
            const searchTerm = document.getElementById('searchInput') ? document.getElementById('searchInput').value : '';
            const location = document.getElementById('locationInput') ? document.getElementById('locationInput').value : '';
            
            // Show loading state
            const eventsGrid = document.getElementById('eventsGrid');
            eventsGrid.innerHTML = '<div class="loading-message"><p>Memuat events...</p></div>';
            
            // Prepare AJAX data
            const formData = new FormData();
            formData.append('action', 'search_events');
            formData.append('search_term', searchTerm);
            formData.append('location', location);
            formData.append('category', selectedCategory);
            formData.append('date_filter', selectedDate);
            
            // Send AJAX request
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderEvents(data.data);
                } else {
                    eventsGrid.innerHTML = '<div class="no-events-message"><p>Terjadi kesalahan saat memuat events.</p></div>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                eventsGrid.innerHTML = '<div class="no-events-message"><p>Terjadi kesalahan saat memuat events.</p></div>';
            });
        }

        // Render events from AJAX response
        function renderEvents(events) {
            const eventsGrid = document.getElementById('eventsGrid');
            
            if (events.length === 0) {
                eventsGrid.innerHTML = '<div class="no-events-message"><p>Tidak ada event yang sesuai dengan filter.</p></div>';
                return;
            }
            
            let eventsHtml = '';
            events.forEach(event => {
                eventsHtml += `
                    <div class="event-card" 
                         data-category="${event.category}" 
                         data-title="${event.title}" 
                         data-venue="${event.location}" 
                         data-location="${event.location}">
                        
                        <div class="event-image-wrapper">
                            <img src="${event.banner_url}" alt="${event.title}" class="event-image">
                            ${event.category ? `<div class="event-badge badge-category">${event.category}</div>` : ''}
                        </div>
                        
                        <div class="event-content">
                            <h3 class="event-title">${event.title}</h3>
                            
                            <div class="event-details">
                                <div class="event-detail">
                                    <svg class="event-detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span>${event.formatted_date}</span>
                                    ${event.formatted_time ? `
                                    <svg class="event-detail-icon icon-spacing" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12,6 12,12 16,14"></polyline>
                                    </svg>
                                    <span>${event.formatted_time}</span>
                                    ` : ''}
                                </div>
                                
                                <div class="event-detail">
                                    <svg class="event-detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <span>${event.location}</span>
                                </div>
                            </div>
                            
                            <div class="event-footer">
                                <div class="event-price">
                                    <span class="price-current">${event.formatted_price || 'Gratis'}</span>
                                </div>
                                
                                <button class="btn btn-primary btn-sm" onclick="event.stopPropagation();">
                                    Get Tickets
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            eventsGrid.innerHTML = eventsHtml;
        }

        // Search with debounce
        function filterEvents() {
            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }
            searchTimeout = setTimeout(filterEventsAjax, 300);
        }

        // Category filter
        function filterByCategory(category) {
            selectedCategory = category;
            
            // Update button states
            const categoryButtons = document.querySelectorAll('.category-btn');
            categoryButtons.forEach(btn => {
                btn.classList.remove('btn-primary', 'active');
                btn.classList.add('btn-outline');
            });
            
            // Set active button
            if (category === '') {
                // "All Categories" button
                const allBtn = document.querySelector('.category-btn[data-category=""]');
                if (allBtn) {
                    allBtn.classList.remove('btn-outline');
                    allBtn.classList.add('btn-primary', 'active');
                }
            } else {
                // Specific category button
                const activeBtn = document.querySelector(`.category-btn[data-category="${category}"]`);
                if (activeBtn) {
                    activeBtn.classList.remove('btn-outline');
                    activeBtn.classList.add('btn-primary', 'active');
                }
            }
            
            filterEventsAjax();
        }
        
        // Dropdown functionality
        function toggleDropdown(selectId) {
            const selectElement = document.getElementById(selectId);
            const trigger = selectElement.querySelector('.select-trigger');
            const content = selectElement.querySelector('.select-content');
            
            // Close other dropdowns
            document.querySelectorAll('.select-content.open').forEach(dropdown => {
                if (dropdown !== content) {
                    dropdown.classList.remove('open');
                    dropdown.parentElement.querySelector('.select-trigger').classList.remove('open');
                }
            });
            
            // Toggle current dropdown
            trigger.classList.toggle('open');
            content.classList.toggle('open');
        }

        // Select date function
        function selectDate(value) {
            const dateLabels = {
                'today': 'Today',
                'tomorrow': 'Tomorrow',
                'this-week': 'This Week',
                'this-weekend': 'This Weekend',
                'next-week': 'Next Week',
                'this-month': 'This Month',
                'any-date': 'Any Date'
            };
            
            // Update global selectedDate variable
            selectedDate = value;
            
            const dateSelectText = document.getElementById('dateSelectText');
            dateSelectText.textContent = dateLabels[value] || 'Date';
            
            // Add selected class to change color from placeholder to normal text
            if (value && dateLabels[value]) {
                dateSelectText.classList.add('selected');
            } else {
                dateSelectText.classList.remove('selected');
            }
            
            // Close dropdown
            const selectElement = document.getElementById('dateSelect');
            const trigger = selectElement.querySelector('.select-trigger');
            const content = selectElement.querySelector('.select-content');
            trigger.classList.remove('open');
            content.classList.remove('open');
            
            // Trigger filter events
            filterEventsAjax();
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.select')) {
                document.querySelectorAll('.select-content.open').forEach(dropdown => {
                    dropdown.classList.remove('open');
                    dropdown.parentElement.querySelector('.select-trigger').classList.remove('open');
                });
            }
        });

        // Mobile Navigation Functions
        function toggleMobileMenu() {
            const mobileNav = document.getElementById('mobileNav');
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            
            mobileNav.classList.toggle('open');
            mobileMenuBtn.classList.toggle('active');
            
            // Prevent body scroll when menu is open
            if (mobileNav.classList.contains('open')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        function closeMobileMenu() {
            const mobileNav = document.getElementById('mobileNav');
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            
            mobileNav.classList.remove('open');
            mobileMenuBtn.classList.remove('active');
            document.body.style.overflow = '';
        }





        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Add search event listener
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', filterEvents);
            }
            
            // Add location search event listener
            const locationInput = document.getElementById('locationInput');
            if (locationInput) {
                locationInput.addEventListener('input', filterEvents);
            }
            
            // Initialize category buttons
            const categoryButtons = document.querySelectorAll('.category-btn');
            categoryButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const category = this.getAttribute('data-category') || '';
                    filterByCategory(category);
                });
            });
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Mobile menu event listeners (optimized)
            document.addEventListener('click', function(event) {
                const mobileNav = document.getElementById('mobileNav');
                const mobileNavContent = document.querySelector('.mobile-nav-content');
                
                if (mobileNav && mobileNav.classList.contains('open') && 
                    !mobileNavContent.contains(event.target) && 
                    !event.target.closest('.mobile-menu-btn')) {
                    closeMobileMenu();
                }
            });
            
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeMobileMenu();
                }
            });
            
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    closeMobileMenu();
                }
            });
        });
    </script>
    
    <?php wp_footer(); ?>
</body>
</html>