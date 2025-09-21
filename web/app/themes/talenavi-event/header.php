<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <link rel="icon" href="./public/favicon.ico">
    <?php wp_head(); ?>
    <style>
        /* CSS Variables - Design System */
        :root {
            /* Colors */
            --background: 0 0% 99%;
            --foreground: 222.2 84% 4.9%;
            --card: 0 0% 100%;
            --card-foreground: 222.2 84% 4.9%;
            --primary: 174 72% 45%;
            --primary-foreground: 0 0% 100%;
            --secondary: 220 14% 96%;
            --secondary-foreground: 222.2 47.4% 11.2%;
            --muted: 220 14% 96%;
            --muted-foreground: 215.4 16.3% 46.9%;
            --accent: 174 72% 96%;
            --accent-foreground: 174 72% 45%;
            --border: 220 13% 91%;
            --input: 220 13% 91%;
            --ring: 174 72% 45%;
            --hero-gradient: linear-gradient(135deg, hsl(174 72% 45%) 0%, hsl(164 82% 55%) 100%);
            --card-shadow: 0 4px 24px -6px hsl(174 72% 45% / 0.1);
            --card-shadow-hover: 0 8px 32px -8px hsl(174 72% 45% / 0.15);
            
            /* Typography Scale - Mobile First */
            --font-size-xs: 0.75rem;    /* 12px */
            --font-size-sm: 0.875rem;   /* 14px */
            --font-size-base: 1rem;     /* 16px */
            --font-size-lg: 1.125rem;   /* 18px */
            --font-size-xl: 1.25rem;    /* 20px */
            --font-size-2xl: 1.5rem;    /* 24px */
            --font-size-3xl: 1.875rem;  /* 30px */
            --font-size-4xl: 2.25rem;   /* 36px */
            --font-size-5xl: 3rem;      /* 48px */
            --font-size-6xl: 3.75rem;   /* 60px */
            
            /* Line Heights */
            --line-height-tight: 1.25;
            --line-height-snug: 1.375;
            --line-height-normal: 1.5;
            --line-height-relaxed: 1.625;
            --line-height-loose: 2;
            
            /* Font Weights */
            --font-weight-normal: 400;
            --font-weight-medium: 500;
            --font-weight-semibold: 600;
            --font-weight-bold: 700;
            
            /* Spacing Scale - 8px Grid System */
            --space-1: 0.25rem;   /* 4px */
            --space-2: 0.5rem;    /* 8px */
            --space-3: 0.75rem;   /* 12px */
            --space-4: 1rem;      /* 16px */
            --space-5: 1.25rem;   /* 20px */
            --space-6: 1.5rem;    /* 24px */
            --space-7: 1.75rem;   /* 28px */
            --space-8: 2rem;      /* 32px */
            --space-10: 2.5rem;   /* 40px */
            --space-12: 3rem;     /* 48px */
            --space-16: 4rem;     /* 64px */
            --space-18: 4.5rem;   /* 72px */
            --space-20: 5rem;     /* 80px */
            --space-24: 6rem;     /* 96px */
            --space-28: 7rem;     /* 112px */
            --space-32: 8rem;     /* 128px */
            --space-36: 9rem;     /* 144px */
            --space-38: 9.5rem;   /* 152px */
            --space-40: 10rem;    /* 160px */
            --space-48: 12rem;    /* 192px */
            
            /* Negative Spacing */
            --space-16-negative: -4rem;  /* -64px */
            
            /* Border Radius */
            --radius-sm: 0.25rem;
            --radius: 0.5rem;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
            --radius-full: 9999px;
            
            /* Container Widths */
            --container-sm: 640px;
            --container-md: 768px;
            --container-lg: 1024px;
            --container-xl: 1280px;
            --container-2xl: 1536px;
            
            /* Max Widths */
            --max-width-2xl: 42rem;   /* 672px */
            --max-width-3xl: 48rem;   /* 768px */
            --max-width-4xl: 56rem;   /* 896px */
            
            /* Breakpoints */
            --breakpoint-sm: 640px;
            --breakpoint-md: 768px;
            --breakpoint-lg: 1024px;
            --breakpoint-xl: 1280px;
            --breakpoint-2xl: 1536px;

            /* Overlay Colors */
            --overlay-dark: rgba(0, 0, 0, 0.7);
            --overlay-medium: rgba(0, 0, 0, 0.5);
            --overlay-light: rgba(0, 0, 0, 0.3);
            --ripple-effect: rgba(255, 255, 255, 0.3);
            --shadow-light: rgba(0, 0, 0, 0.1);
            --shadow-medium: rgba(0, 0, 0, 0.06);

            /* Gradient Colors */
            --gradient-teal: #2dd4bf;
            --gradient-emerald: #34d399;
        }

        /* Responsive Typography Variables */
        @media (min-width: 768px) {
            :root {
                --font-size-3xl: 2rem;      /* 32px */
                --font-size-4xl: 2.5rem;    /* 40px */
                --font-size-5xl: 3.5rem;    /* 56px */
                --font-size-6xl: 4rem;      /* 64px */
            }
        }

        @media (min-width: 1024px) {
            :root {
                --font-size-4xl: 3rem;      /* 48px */
                --font-size-5xl: 4rem;      /* 64px */
                --font-size-6xl: 4.5rem;    /* 72px */
            }
        }

        @media (min-width: 1280px) {
            :root {
                --font-size-5xl: 4.5rem;    /* 72px */
                --font-size-6xl: 5rem;      /* 80px */
            }
        }

        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: hsl(var(--background));
            color: hsl(var(--foreground));
            font-size: var(--font-size-base);
            line-height: var(--line-height-relaxed);
        }

        /* Utility Classes */
        .container {
            max-width: var(--container-xl);
            margin: 0 auto;
            padding: 0 var(--space-4);
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .justify-center {
            justify-content: center;
        }

        .gap-2 {
            gap: var(--space-2);
        }

        .gap-3 {
            gap: var(--space-4);
        }

        .gap-4 {
            gap: var(--space-4);
        }

        .gap-6 {
            gap: var(--space-6);
        }

        .gap-8 {
            gap: var(--space-8);
        }

        .grid {
            display: grid;
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        .grid-cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .hidden {
            display: none;
        }

        /* Navigation */
        .nav {
            border-bottom: 1px solid hsl(var(--border) / 0.5);
            background-color: hsl(var(--background) / 0.8);
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .nav-content {
            height: var(--space-16);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: var(--space-8);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .logo-icon {
            width: var(--space-8);
            height: var(--space-8);
            background: var(--hero-gradient);
            border-radius: var(--space-2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .logo-text {
            font-size: var(--font-size-xl);
            font-weight: bold;
            color: hsl(var(--foreground));
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: var(--space-6);
        }

        .nav-link {
            color: hsl(var(--muted-foreground));
            text-decoration: none;
            transition: color 0.2s;
            font-size: var(--font-size-base);
        }

        .nav-link:hover,
        .nav-link.active {
            color: hsl(var(--primary));
        }

        .nav-buttons {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: var(--space-11);
            height: var(--space-11);
            min-width: 44px;
            min-height: 44px;
            background: none;
            border: none;
            cursor: pointer;
            padding: var(--space-2);
            border-radius: var(--radius);
            transition: background-color 0.2s ease;
        }

        .mobile-menu-btn:hover {
            background: hsl(var(--muted));
        }

        .hamburger-line {
            width: var(--space-5);
            height: 2px;
            background: hsl(var(--foreground));
            margin: 2px 0;
            transition: all 0.3s ease;
            border-radius: 1px;
        }

        .mobile-menu-btn.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .mobile-menu-btn.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-btn.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        /* Mobile Navigation */
        .mobile-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: hsl(var(--background) / 0.95);
            backdrop-filter: blur(10px);
            z-index: 100;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-nav.open {
            transform: translateX(0);
        }

        .mobile-nav-content {
            display: flex;
            flex-direction: column;
            height: 100%;
            padding: 0 var(--space-4) var(--space-4) var(--space-4);
        }

        .mobile-nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: var(--space-16);
            padding: 0;
            border-bottom: 1px solid hsl(var(--border));
            margin-bottom: var(--space-8);
            line-height: 1 !important;
        }

        .mobile-nav-header .logo {
            margin: 0;
            padding: 0;
            line-height: 1;
        }

        .mobile-nav-header .logo-text {
            line-height: 1 !important;
        }

        .mobile-nav-header * {
            line-height: 1 !important;
        }

        .mobile-close-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: var(--space-11);
            height: var(--space-11);
            min-width: 44px;
            min-height: 44px;
            background: none;
            border: none;
            cursor: pointer;
            padding: var(--space-2);
            border-radius: var(--radius);
            transition: background-color 0.2s ease;
        }

        .mobile-close-btn:hover {
            background: hsl(var(--muted));
        }

        .mobile-close-btn .icon {
            width: var(--space-6);
            height: var(--space-6);
        }

        .mobile-nav-links {
            display: flex;
            flex-direction: column;
            gap: var(--space-2);
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-4);
            color: hsl(var(--foreground));
            text-decoration: none;
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
            font-weight: var(--font-weight-medium);
            font-size: var(--font-size-base);
        }

        .mobile-nav-link:hover {
            background: hsl(var(--muted));
            color: hsl(var(--primary));
        }

        .mobile-nav-link.active {
            background: hsl(var(--primary) / 0.1);
            color: hsl(var(--primary));
        }

        .mobile-nav-footer {
            padding: var(--space-8) 0 var(--space-4);
            border-top: 1px solid hsl(var(--border));
        }

        .mobile-nav-buttons {
            display: flex;
            gap: var(--space-4);
            flex-direction: column;
        }

        .mobile-nav-buttons .btn {
            justify-content: center;
        }

        /* Buttons */
        .btn {
            padding: var(--space-3) var(--space-6);
            min-height: 44px;
            border-radius: var(--radius);
            border: none;
            cursor: pointer;
            font-size: var(--font-size-sm);
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            outline: none;
            user-select: none;
        }

        .btn:focus-visible {
            ring: 2px solid hsl(var(--ring));
            ring-offset: 2px;
        }

        .btn:active {
            transform: translateY(1px);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .btn-primary {
            background-color: hsl(var(--primary));
            color: hsl(var(--primary-foreground));
            box-shadow: 0 2px 8px hsl(var(--primary) / 0.2);
        }

        .btn-primary:hover:not(:disabled) {
            background-color: hsl(var(--primary) / 0.9);
            box-shadow: 0 4px 12px hsl(var(--primary) / 0.3);
            transform: translateY(-2px);
        }

        .btn-primary:active:not(:disabled) {
            transform: translateY(0);
            box-shadow: 0 2px 4px hsl(var(--primary) / 0.2);
        }

        .btn-outline {
            background-color: transparent;
            color: hsl(var(--foreground));
            border: 1px solid hsl(var(--border));
            box-shadow: 0 1px 3px hsl(0 0% 0% / 0.1);
        }

        .btn-outline:hover:not(:disabled) {
            background-color: hsl(var(--accent));
            border-color: hsl(var(--primary) / 0.5);
            box-shadow: 0 2px 8px hsl(0 0% 0% / 0.15);
            transform: translateY(-1px);
        }

        .btn-outline:active:not(:disabled) {
            transform: translateY(0);
            box-shadow: 0 1px 2px hsl(0 0% 0% / 0.1);
        }

        .btn-sm {
            padding: var(--space-2) var(--space-4);
            min-height: 40px;
            font-size: var(--font-size-xs);
        }

        .btn-lg {
            padding: var(--space-3) var(--space-8);
            min-height: 48px;
            font-size: var(--font-size-base);
        }

        /* Button ripple effect */
        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: var(--ripple-effect);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:active::before {
            width: 300px;
            height: 300px;
        }

        /* Hero Section */
        .hero {
            position: relative;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, var(--overlay-dark), var(--overlay-medium), var(--overlay-light));
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            position: relative;
            padding: var(--space-12) 0rem var(--space-28);
            max-width: var(--max-width-3xl);
            text-align: center;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-block;
            padding: var(--space-1) var(--space-4);
            background-color: hsl(var(--primary) / 0.2);
            color: hsl(var(--primary));
            border: 1px solid hsl(var(--primary) / 0.3);
            border-radius: var(--radius);
            font-size: var(--font-size-sm);
            margin-bottom: var(--space-6);
        }

        .hero-title {
            font-size: var(--font-size-4xl);
            font-weight: var(--font-weight-bold);
            color: white;
            margin-bottom: var(--space-5);
            line-height: var(--line-height-tight);
            max-width: var(--max-width-2xl);
            margin-left: auto;
            margin-right: auto;
        }
        .hero-gradient-text {
            background: linear-gradient(to right, var(--gradient-teal), var(--gradient-emerald));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-description {
            font-size: var(--font-size-lg);
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: var(--space-8);
            line-height: var(--line-height-relaxed);
        }

        .hero-buttons {
            display: flex;
            flex-direction: column;
            gap: var(--space-4);
            align-items: center;
        }

        /* Search Section */
        .search-section {
            position: relative;
            margin-top: var(--space-16-negative);
            padding: 0 0 var(--space-4);
            z-index: 10;
        }

        .search-card {
            background-color: hsl(var(--card));
            border-radius: var(--space-4);
            padding: var(--space-4);
            box-shadow: var(--card-shadow);
            border: 1px solid hsl(var(--border) / 0.5);
        }

        .search-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--space-3);
        }

        .search-input-wrapper {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: var(--space-3);
            top: 50%;
            transform: translateY(-50%);
            color: hsl(var(--muted-foreground));
            width: var(--space-4);
            height: var(--space-4);
        }

        .search-input {
            width: 100%;
            padding: var(--space-3) var(--space-3) var(--space-3) var(--space-10);
            height: var(--space-12);
            border: 1px solid hsl(var(--border) / 0.5);
            border-radius: var(--radius);
            background-color: hsl(var(--background));
            font-size: var(--font-size-sm);
            color: hsl(var(--foreground));
        }

        .search-input::placeholder {
            color: hsl(var(--muted-foreground));
        }

        .search-input:focus {
            outline: none;
            border-color: hsl(var(--primary));
            box-shadow: 0 0 0 2px hsl(var(--ring) / 0.2);
        }

        .select {
            position: relative;
            width: 100%;
        }

        .select-trigger {
            width: 100%;
            height: var(--space-12);
            padding: var(--space-3);
            border: 1px solid hsl(var(--border) / 0.5);
            border-radius: var(--radius);
            background-color: hsl(var(--background));
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: var(--space-3);
            color: hsl(var(--foreground));
            justify-content: space-between;
            font-size: var(--font-size-sm);
        }

        .select-trigger #dateSelectText {
            width: 100%;
            color: hsl(var(--muted-foreground));
        }

        .select-trigger #dateSelectText.selected {
            color: hsl(var(--foreground));
        }

        .select-trigger .icon {
            color: hsl(var(--muted-foreground));
        }

        .select-trigger:hover {
            border-color: hsl(var(--primary));
        }

        .select-trigger.open {
            border-color: hsl(var(--primary));
            box-shadow: 0 0 0 2px hsl(var(--primary) / 0.2);
        }

        .select-arrow {
            width: 16px;
            height: 16px;
            transition: transform 0.2s ease;
        }

        .select-trigger.open .select-arrow {
            transform: rotate(180deg);
        }

        .select-content {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: hsl(var(--background));
            border: 1px solid hsl(var(--border));
            border-radius: var(--space-2);
            box-shadow: 0 4px 6px -1px var(--shadow-light), 0 2px 4px -1px var(--shadow-medium);
            z-index: 50;
            margin-top: var(--space-1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
        }

        .select-content.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .select-item {
            padding: var(--space-3) var(--space-4);
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid hsl(var(--border));
            font-size: var(--font-size-sm);
            color: hsl(var(--foreground));
        }

        .select-item:last-child {
            border-bottom: none;
        }

        .select-item:hover {
            background: hsl(var(--muted));
        }

        .select-item:first-child {
            border-top-left-radius: var(--space-2);
            border-top-right-radius: var(--space-2);
        }

        .select-item:last-child {
            border-bottom-left-radius: var(--space-2);
            border-bottom-right-radius: var(--space-2);
        }

        .search-categories {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: var(--space-4);
            padding-top: var(--space-4);
            border-top: 1px solid hsl(var(--border) / 0.5);
            flex-wrap: wrap;
            gap: var(--space-4);
        }

        .categories-left {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            flex-wrap: wrap;
        }

        .category-buttons {
            display: flex;
            gap: var(--space-2) var(--space-2);
            flex-wrap: wrap;
        }

        /* Stats Section */
        .stats-section {
            padding: var(--space-8) 0;
            border-bottom: 1px solid hsl(var(--border) / 0.5);
        }

        .stats-grid {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: var(--space-6);
            text-align: center;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .stat-icon {
            width: var(--space-5);
            height: var(--space-5);
            color: hsl(var(--primary));
        }

        .stat-text {
            font-size: var(--font-size-sm);
            color: hsl(var(--muted-foreground));
        }

        /* Events Section */
        .events-section {
            padding: var(--space-12) 0;
        }

        .events-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--space-12);
            flex-wrap: wrap;
            gap: var(--space-6);
        }

        .events-title {
            font-size: var(--font-size-3xl);
            font-weight: var(--font-weight-bold);
            color: hsl(var(--foreground));
            margin-bottom: var(--space-2);
        }

        .events-subtitle {
            color: hsl(var(--muted-foreground));
            font-size: var(--font-size-base);
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--space-6);
        }

        /* Event Card */
        .event-card {
            background-color: hsl(var(--card));
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            border: 1px solid hsl(var(--border) / 0.5);
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
            height: var(--space-48);
            object-fit: cover;
            transition: transform 0.3s;
        }

        .event-card:hover .event-image {
            transform: scale(1.05);
        }

        .event-badge {
            position: absolute;
            top: var(--space-3);
            padding: var(--space-1) var(--space-2);
            border-radius: var(--radius);
            font-size: var(--font-size-xs);
            font-weight: 500;
        }

        .badge-popular {
            left: var(--space-3);
            background-color: hsl(var(--primary));
            color: hsl(var(--primary-foreground));
        }

        .badge-category {
            right: var(--space-3);
            background-color: hsl(var(--background) / 0.9);
            backdrop-filter: blur(12px);
            color: hsl(var(--foreground));
        }

        .event-content {
            padding: var(--space-4);
        }

        .event-title {
            font-size: var(--font-size-lg);
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: var(--space-3);
            transition: color 0.2s;
        }

        .event-card:hover .event-title {
            color: hsl(var(--primary));
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
            flex-direction: column;
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

        /* Footer */
        .footer {
            background-color: hsl(var(--muted) / 0.5);
            border-top: 1px solid hsl(var(--border) / 0.5);
            padding: var(--space-16) 0;
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        /* Utility classes to replace inline styles */
        .logo-spacing {
            margin-bottom: var(--space-4);
        }

        .footer-description {
            font-size: var(--font-size-sm);
            color: hsl(var(--muted-foreground));
            margin-bottom: var(--space-6);
        }

        .footer-copyright {
            font-size: var(--font-size-sm);
            color: hsl(var(--muted-foreground));
        }

        .categories-label {
            font-size: var(--font-size-sm);
            color: hsl(var(--muted-foreground));
        }

        .icon-spacing {
            margin-left: var(--space-2);
        }

        /* Icons */
        .icon {
            width: var(--space-4);
            height: var(--space-4);
        }

        .search-input-wrapper .icon {
            position: absolute;
            left: var(--space-3);
            top: 50%;
            transform: translateY(-50%);
            color: hsl(var(--muted-foreground));
        }

        /* Responsive */
        @media (max-width: 767px) {
            .nav-links {
                display: none;
            }
            .nav-buttons {
                display: none;
            }
            .mobile-menu-btn {
                display: flex;
            }
            .search-card {
                border-radius: var(--space-3);
            }
        }

        @media (min-width: 768px) {
            .container {
                padding: 0 1.5rem;
            }

            .hidden-md {
                display: none;
            }

            .flex-md {
                display: flex;
            }

            .btn-lg {
                padding: var(--space-4) var(--space-8);
            }

            .grid-cols-md-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .grid-cols-md-4 {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }

            .search-grid {
                gap: var(--space-4);
                grid-template-columns: 1fr 1fr 1fr;
            }

            .hero-badge{
                padding: var(--space-2) var(--space-4);
            }

            .hero-buttons {
                flex-direction: row;
                align-items: center;
                justify-content: center;
            }

            .hero-title {
                font-size: var(--font-size-6xl);
            }

            .search-categories {
                flex-wrap: nowrap;
            }

            .mobile-menu-btn {
                display: none;
            }

            .hero-content {
                padding: var(--space-16) var(--space-4) var(--space-24);
            }

            .search-card{
              padding: var(--space-6);
            }

            .stats-grid {
                gap: var(--space-8);
            }

            .footer {
                padding: var(--space-20) 0;
            }
        }

        @media (min-width: 900px) and (max-width: 1023px) {
            .container {
                padding: 0 var(--space-5);
            }

            .hero-content {
                padding: var(--space-18) var(--space-6) var(--space-28);
                max-width: var(--max-width-3xl);
            }

            .hero-title {
                font-size: var(--font-size-4xl);
            }
        }

        @media (min-width: 1024px) and (max-width: 1199px) {
            .container {
                padding: 0 var(--space-6);
            }

            .hero-content {
                padding: var(--space-20) var(--space-8) var(--space-32);
                max-width: var(--max-width-4xl);
            }

            .hero-title {
                font-size: var(--font-size-5xl);
            }
        }

        @media (min-width: 1200px) {
            .container {
                padding: 0 var(--space-8);
            }

            .grid-cols-lg-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .hero-content {
                padding: var(--space-24) 0rem var(--space-40);
            }

            .hero-title {
                font-size: var(--font-size-6xl);
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="nav">
        <div class="container">
            <div class="nav-content">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="EVENT Logo" style="height: 48px; width: auto; object-fit: contain;">
                <div class="nav-links">
                    <a href="#" class="nav-link active">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9,22 9,12 15,12 15,22"></polyline>
                        </svg>
                        Browse Events
                    </a>
                    <a href="#" class="nav-link">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        Upcoming Events
                    </a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Toggle mobile menu">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>
        
        <!-- Mobile Navigation Menu -->
        <div class="mobile-nav" id="mobileNav">
            <div class="mobile-nav-content">
                <div class="mobile-nav-header">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="EVENT Logo" style="height: 42px; width: auto; object-fit: contain;">
                    <button class="mobile-close-btn" onclick="toggleMobileMenu()" aria-label="Close mobile menu">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                
                <div class="mobile-nav-links">
                    <a href="#" class="mobile-nav-link active" onclick="closeMobileMenu()">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9,22 9,12 15,12 15,22"></polyline>
                        </svg>
                        Browse Events
                    </a>
                    <a href="#" class="mobile-nav-link" onclick="closeMobileMenu()">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        Upcoming Events
                    </a>
                </div>
            </div>
        </div>
    </nav>