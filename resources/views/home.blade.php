@extends('layouts.app')

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif; /* Example font-family */
            margin: 0;
            padding: 0;
            background-color: #f8f8f8; /* Background color */
        }

        .service-solution, .service-item {
            transition: transform 0.3s ease, opacity 0.3s ease; /* Smooth transition for transform and opacity */
        }

        /* Initial state for service items */
        .service-item {
            opacity: 0; /* Start invisible */
            transform: translateY(20px); /* Move down initially */
        }

        /* Animation on scroll */
        .scroll-animated {
            opacity: 1; /* Fade in */
            transform: translateY(0); /* Move to original position */
        }

        /* Hover effect */
        .service-item:hover {
            transform: scale(1.05); /* Scale up on hover */
        }

        .service-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 20px 0;
        }

        .service-item {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            width: 250px; /* Fixed width for service items */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .service-item:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #282c34; /* Footer background */
            color: white; /* Footer text color */
        }

        .service-solution {
            text-align: center;
            padding: 50px 20px;
            background-color: #007bff; /* Blue background for solution section */
            color: white; /* White text for solution section */
        }

        h2 {
            margin: 20px 0;
        }

        h3 {
            margin: 10px 0;
        }

        p {
            margin: 5px 0;
        }
    </style>
</head>

<body>

@include('layouts.navbar')

<main>
    <section class="service-solution">
        <h2>Your Laundry Solution</h2>
        <p>We provide high-quality laundry services with timely delivery.</p>
        <p>Enjoy clean clothes without the hassle.</p>
    </section>

    <section>
        <h2>Our Services</h2>
        <div class="service-list">
            <div class="service-item">
                <h3>Wash and Fold</h3>
                <p>Clean, fold, and ready to go. A perfect solution for your weekly laundry.</p>
            </div>
            <div class="service-item">
                <h3>Dry Cleaning</h3>
                <p>Gentle and professional dry cleaning for your special garments.</p>
            </div>
            <div class="service-item">
                <h3>Ironing</h3>
                <p>Neatly pressed clothes for a crisp and professional look.</p>
            </div>
            <div class="service-item">
                <h3>Express Service</h3>
                <p>Need it fast? Our express service delivers within 24 hours.</p>
            </div>
        </div>
    </section>
</main>

<footer>
    <p>&copy; {{ date('Y') }} Laundry Service. All rights reserved.</p>
</footer>

<script>
    // Your JavaScript code for smooth scrolling and animation
    document.addEventListener("DOMContentLoaded", function() {
        const serviceItems = document.querySelectorAll('.service-item');

        // Function to check if an element is in the viewport
        const isInViewport = (element) => {
            const rect = element.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        };

        // Function to add animation class
        const animateOnScroll = () => {
            serviceItems.forEach(item => {
                if (isInViewport(item)) {
                    item.classList.add('scroll-animated');
                }
            });
        };

        // Initial check
        animateOnScroll();

        // Check on scroll
        window.addEventListener('scroll', animateOnScroll);
    });
</script>

</body>
</html>
