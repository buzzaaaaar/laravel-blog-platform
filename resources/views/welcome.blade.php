<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogHub - Where Ideas Come to Life</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/three@0.132.2/build/three.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        @import 'tailwindcss/base';
        @import 'tailwindcss/components';
        @import 'tailwindcss/utilities';

        canvas {
            display: block;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .gradient-text {
            background: linear-gradient(90deg, #6366F1 0%, #A855F7 50%, #EC4899 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #6366F1 0%, #A855F7 50%, #EC4899 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .shape-blur {
            filter: blur(60px);
            opacity: 0.15;
        }
    </style>
</head>

<body class="antialiased text-gray-800 bg-white">
    <div id="root">
        <!-- Hero Section -->
        <section class="relative flex items-center justify-center w-full min-h-screen overflow-hidden">
            <!-- Animated background -->
            <canvas id="heroCanvas" class="absolute inset-0 w-full h-full -z-10"></canvas>

            <!-- Gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-white/80 via-white/50 to-white -z-10"></div>

            <!-- Floating shapes -->
            <div class="absolute inset-0 overflow-hidden -z-20">
                <div class="absolute w-64 h-64 bg-indigo-500 rounded-full -left-20 -top-20 shape-blur"></div>
                <div class="absolute bg-purple-500 rounded-full -right-20 -bottom-20 w-96 h-96 shape-blur"></div>
                <div class="absolute w-48 h-48 bg-pink-500 rounded-full right-1/4 top-1/3 shape-blur"></div>
            </div>

            <div class="container z-10 px-6 mx-auto">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="mb-6 font-serif text-5xl font-bold tracking-tight text-gray-900 md:text-7xl">
                        Where <span class="gradient-text">Ideas</span> Come to Life
                    </h1>
                    <p class="max-w-2xl mx-auto mb-10 text-xl leading-relaxed text-gray-600 md:text-2xl">
                        <span class="font-semibold gradient-text">BlogHub</span> is the modern platform for writers,
                        thinkers, and creators to share their stories with the world.
                    </p>
                    <div class="flex flex-col justify-center gap-4 sm:flex-row">
                        <a href="{{ route('register') }}"
                            class="px-8 py-4 font-bold text-white transition-all rounded-lg gradient-bg hover:shadow-lg hover:shadow-indigo-500/30">
                            Get Started
                        </a>
                        <button id="learnMoreBtn"
                            class="px-8 py-4 font-bold text-indigo-600 transition-all bg-white border-2 border-indigo-600 rounded-lg hover:bg-indigo-50">
                            Learn More
                        </button>
                    </div>
                </div>
            </div>

            <!-- Scroll indicator -->
            <div class="absolute transform -translate-x-1/2 bottom-8 left-1/2 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-indigo-600 lucide lucide-chevron-down">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="relative py-24 overflow-hidden bg-gray-50">
            <!-- Floating shapes -->
            <div class="absolute inset-0 overflow-hidden -z-10">
                <div class="absolute w-32 h-32 bg-indigo-100 rounded-full left-1/4 top-1/4 shape-blur"></div>
                <div class="absolute w-40 h-40 bg-purple-100 rounded-full right-1/3 bottom-1/4 shape-blur"></div>
            </div>

            <div class="container px-6 mx-auto">
                <div class="mb-20 text-center">
                    <span
                        class="inline-block px-3 py-1 mb-4 text-sm font-semibold tracking-wider text-indigo-600 uppercase bg-indigo-100 rounded-full">
                        Why Choose BlogHub?
                    </span>
                    <h2 class="mb-6 font-serif text-3xl font-bold text-gray-900 md:text-4xl">
                        Designed for creative minds
                    </h2>
                    <p class="max-w-2xl mx-auto text-xl text-gray-600">
                        Everything you need to create, share, and grow your audience.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Feature 1 -->
                    <div class="p-8 transition-all bg-white rounded-xl card-hover">
                        <div class="flex items-center justify-center w-16 h-16 mb-6 rounded-lg gradient-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-white lucide lucide-pen-tool">
                                <path d="m12 19 7-7 3 3-7 7-3-3z"></path>
                                <path d="m18 13-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
                                <path d="m2 2 7.586 7.586"></path>
                                <circle cx="11" cy="11" r="2"></circle>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">
                            Powerful Editor
                        </h3>
                        <p class="text-gray-600">Write beautiful content with our intuitive and feature-rich editor
                            designed for bloggers.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-8 transition-all bg-white rounded-xl card-hover">
                        <div class="flex items-center justify-center w-16 h-16 mb-6 rounded-lg gradient-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-white lucide lucide-users">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">
                            Community Engagement
                        </h3>
                        <p class="text-gray-600">Connect with readers through comments, likes, and shares to build a
                            loyal audience.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-8 transition-all bg-white rounded-xl card-hover">
                        <div class="flex items-center justify-center w-16 h-16 mb-6 rounded-lg gradient-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-white lucide lucide-trending-up">
                                <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                                <polyline points="16 7 22 7 22 13"></polyline>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">
                            Analytics Dashboard
                        </h3>
                        <p class="text-gray-600">Track your performance with detailed analytics on views, engagement,
                            and audience demographics.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="p-8 transition-all bg-white rounded-xl card-hover">
                        <div class="flex items-center justify-center w-16 h-16 mb-6 rounded-lg gradient-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-white lucide lucide-shield">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">
                            Secure Platform
                        </h3>
                        <p class="text-gray-600">Rest easy knowing your content is protected with enterprise-grade
                            security features.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-24 bg-white">
            <div class="container px-6 mx-auto">
                <div class="mb-20 text-center">
                    <span
                        class="inline-block px-3 py-1 mb-4 text-sm font-semibold tracking-wider text-indigo-600 uppercase bg-indigo-100 rounded-full">
                        Testimonials
                    </span>
                    <h2 class="mb-6 font-serif text-3xl font-bold text-gray-900 md:text-4xl">
                        What our creators say
                    </h2>
                    <p class="max-w-2xl mx-auto text-xl text-gray-600">
                        Join thousands of satisfied content creators who've found success with BlogHub.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <!-- Testimonial 1 -->
                    <div class="p-8 transition-all bg-gray-50 rounded-xl card-hover">
                        <div class="flex items-center mb-6">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=256&q=80"
                                alt="Sarah Johnson" class="object-cover mr-4 rounded-full w-14 h-14">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">
                                    Sarah Johnson
                                </h4>
                                <p class="text-gray-600">Travel Blogger</p>
                            </div>
                        </div>
                        <p class="text-gray-700">"BlogHub transformed my writing career. I went from zero to over 10,000
                            subscribers in just 6 months! The platform made it so easy to focus on my content while
                            handling all the technical details."</p>
                        <div class="flex mt-4 text-yellow-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="p-8 transition-all bg-gray-50 rounded-xl card-hover">
                        <div class="flex items-center mb-6">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=256&q=80"
                                alt="Michael Chen" class="object-cover mr-4 rounded-full w-14 h-14">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">
                                    Michael Chen
                                </h4>
                                <p class="text-gray-600">Tech Writer</p>
                            </div>
                        </div>
                        <p class="text-gray-700">"The analytics tools helped me understand my audience better and create
                            content they truly love. My engagement rates have doubled since switching to BlogHub."</p>
                        <div class="flex mt-4 text-yellow-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="p-8 transition-all bg-gray-50 rounded-xl card-hover">
                        <div class="flex items-center mb-6">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=256&q=80"
                                alt="Emma Rodriguez" class="object-cover mr-4 rounded-full w-14 h-14">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">
                                    Emma Rodriguez
                                </h4>
                                <p class="text-gray-600">Food Blogger</p>
                            </div>
                        </div>
                        <p class="text-gray-700">"The community I've built through BlogHub has opened up amazing
                            opportunities I never thought possible. I've been featured in magazines and even landed a
                            cookbook deal!"</p>
                        <div class="flex mt-4 text-yellow-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="pt-20 pb-12 text-white bg-gray-900">
            <div class="container px-6 mx-auto">
                <div class="grid grid-cols-1 gap-12 mb-12 md:grid-cols-2 lg:grid-cols-5">
                    <div class="lg:col-span-2">
                        <h2 class="mb-4 font-serif text-2xl font-bold">BlogHub</h2>
                        <p class="max-w-md mb-6 text-gray-400">
                            The modern platform for writers, thinkers, and creators to share their stories with the
                            world.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="p-2 text-gray-400 transition-colors bg-gray-800 rounded-full hover:text-white hover:bg-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-facebook">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                                <span class="sr-only">Facebook</span>
                            </a>
                            <a href="#"
                                class="p-2 text-gray-400 transition-colors bg-gray-800 rounded-full hover:text-white hover:bg-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-twitter">
                                    <path
                                        d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z">
                                    </path>
                                </svg>
                                <span class="sr-only">Twitter</span>
                            </a>
                            <a href="#"
                                class="p-2 text-gray-400 transition-colors bg-gray-800 rounded-full hover:text-white hover:bg-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-instagram">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                </svg>
                                <span class="sr-only">Instagram</span>
                            </a>
                            <a href="#"
                                class="p-2 text-gray-400 transition-colors bg-gray-800 rounded-full hover:text-white hover:bg-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-youtube">
                                    <path
                                        d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17">
                                    </path>
                                    <path d="m10 15 5-3-5-3z"></path>
                                </svg>
                                <span class="sr-only">YouTube</span>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="mb-4 text-lg font-semibold">Product</h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="#" class="text-gray-400 transition-colors hover:text-white">
                                    Features
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-400 transition-colors hover:text-white">
                                    Pricing
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-400 transition-colors hover:text-white">
                                    Integrations
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-400 transition-colors hover:text-white">
                                    Changelog
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="mb-4 text-lg font-semibold">Resources</h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="#" class="text-gray-400 transition-colors hover:text-white">
                                    Documentation
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-400 transition-colors hover:text-white">
                                    Tutorials
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-400 transition-colors hover:text-white">
                                    Blog
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-400 transition-colors hover:text-white">
                                    Community
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="mb-4 text-lg font-semibold">Company</h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="#" class="text-gray-400 transition-colors hover:text-white">
                                    About
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-400 transition-colors hover:text-white">
                                    Careers
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-400 transition-colors hover:text-white">
                                    Contact
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-400 transition-colors hover:text-white">
                                    Press
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="pt-8 border-t border-gray-800">
                    <div class="flex flex-col items-center justify-between md:flex-row">
                        <p class="mb-4 text-sm text-gray-400 md:mb-0">
                            © <span id="currentYear"></span> BlogHub. All rights reserved.
                        </p>
                        <div class="flex space-x-6">
                            <a href="#" class="text-sm text-gray-400 transition-colors hover:text-white">
                                Privacy Policy
                            </a>
                            <a href="#" class="text-sm text-gray-400 transition-colors hover:text-white">
                                Terms of Service
                            </a>
                            <a href="#" class="text-sm text-gray-400 transition-colors hover:text-white">
                                Cookie Policy
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Set current year in footer
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        // Canvas animation for hero section
        const canvas = document.getElementById("heroCanvas");
        const ctx = canvas.getContext("2d");

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();

        // Create floating particles
        const particles = [];
        const particleCount = window.innerWidth < 768 ? 8 : 10;
        const colors = [
        'rgba(99, 102, 241, 0.7)',
        'rgba(59, 130, 246, 0.7)',
        'rgba(16, 185, 129, 0.7)',
        'rgba(234, 179, 8, 0.7)',
        'rgba(239, 68, 68, 0.7)',
        'rgba(168, 85, 247, 0.7)',
        ];

        for (let i = 0; i < particleCount; i++) {
            particles.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            size: Math.random() * 100 + 50,
            speedX: (Math.random() - 0.5) * 0.8,
            speedY: (Math.random() - 0.5) * 0.8,
            color: colors[Math.floor(Math.random() * colors.length)]
        });

        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            particles.forEach(particle => {
                ctx.beginPath();
                ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
                ctx.fillStyle = particle.color;
                ctx.shadowBlur = 8;
                ctx.fill();
                ctx.shadowBlur = 0;

                // Move particles
                particle.x += particle.speedX;
                particle.y += particle.speedY;

                // Reset particles that go off screen
                if (particle.x < 0 || particle.x > canvas.width) particle.speedX *= -1;
                if (particle.y < 0 || particle.y > canvas.height) particle.speedY *= -1;
            });

            requestAnimationFrame(animateParticles);
        }

        animateParticles();

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Animate elements when they come into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeIn');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.card-hover').forEach(card => {
            observer.observe(card);
        });
    </script>

    <script>
        document.getElementById('learnMoreBtn').addEventListener('click', function() {
            document.getElementById('features').scrollIntoView({ behavior: 'smooth' });
        });
    </script>
</body>

</html>
