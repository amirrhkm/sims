<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMS Homepage - Smart Inventory Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Header -->
    <header x-data="{ isOpen: false }" class="bg-blue-600 text-white py-4 sticky top-0 z-50 shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-2xl font-bold flex items-center">
                <i class="fas fa-boxes mr-2"></i> SIMS
            </h1>
            
            <button @click="isOpen = !isOpen" class="md:hidden">
                <i class="fas" :class="isOpen ? 'fa-times' : 'fa-bars'"></i>
            </button>
            
            <nav class="hidden md:flex space-x-6 items-center">
                <a href="#features" class="hover:text-blue-200 transition">Features</a>
                <a href="#demo" class="hover:text-blue-200 transition">Demo</a>
                <a href="#contact" class="hover:text-blue-200 transition">Contact</a>
                <a href="login.php" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition">Login</a>
            </nav>
        </div>
        
        <div x-show="isOpen" x-cloak x-transition class="md:hidden">
            <nav class="flex flex-col space-y-4 px-6 py-4 bg-blue-700">
                <a href="#features" class="hover:text-blue-200 transition">Features</a>
                <a href="#demo" class="hover:text-blue-200 transition">Demo</a>
                <a href="#contact" class="hover:text-blue-200 transition">Contact</a>
                <a href="login.php" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition text-center">Login</a>
            </nav>
        </div>
    </header>

    <!-- Hero Banner -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-24">
        <div class="container mx-auto text-center px-6">
            <h1 class="text-5xl font-bold mb-6 leading-tight">Transform Your Inventory Management</h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Streamline your supply chain with real-time tracking, intelligent forecasting, and powerful analytics.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-12">
                <a href="#demo" class="bg-white text-blue-600 px-8 py-3 rounded-lg hover:bg-blue-50 transition font-semibold">
                    <i class="fas fa-play-circle mr-2"></i> Watch Demo
                </a>
                <a href="login.php" class="bg-blue-500 text-white px-8 py-3 rounded-lg hover:bg-blue-400 transition font-semibold">
                    <i class="fas fa-rocket mr-2"></i> Get Started Free
                </a>
            </div>
            <div class="flex flex-wrap justify-center items-center gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold">1000+</div>
                    <div class="text-blue-200">Active Users</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold">99.9%</div>
                    <div class="text-blue-200">Uptime</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold">24/7</div>
                    <div class="text-blue-200">Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-16">Powerful Features for Modern Businesses</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="group hover:transform hover:scale-105 transition duration-300">
                    <div class="text-center p-8 rounded-xl bg-gray-50 hover:bg-blue-50 transition h-full">
                        <div class="text-blue-600 text-4xl mb-4 group-hover:scale-110 transition">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Real-time Analytics</h3>
                        <p class="text-gray-600">Get instant insights into your inventory levels, sales trends, and supply chain performance.</p>
                    </div>
                </div>
                <div class="group hover:transform hover:scale-105 transition duration-300">
                    <div class="text-center p-8 rounded-xl bg-gray-50 hover:bg-blue-50 transition h-full">
                        <div class="text-blue-600 text-4xl mb-4 group-hover:scale-110 transition">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">AI-Powered Forecasting</h3>
                        <p class="text-gray-600">Leverage machine learning to predict inventory needs and optimize stock levels automatically.</p>
                    </div>
                </div>
                <div class="group hover:transform hover:scale-105 transition duration-300">
                    <div class="text-center p-8 rounded-xl bg-gray-50 hover:bg-blue-50 transition h-full">
                        <div class="text-blue-600 text-4xl mb-4 group-hover:scale-110 transition">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Mobile-First Design</h3>
                        <p class="text-gray-600">Manage your inventory on the go with our powerful mobile application.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Section -->
    <section id="demo" class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-3xl font-bold mb-6">Stay Updated with SIMS</h3>
                    <p class="text-gray-600 mb-8">
                        Get exclusive access to product updates, industry insights, and inventory management tips.
                    </p>
                    <form x-data="{ email: '', submitted: false }" @submit.prevent="submitted = true" class="space-y-4">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <input type="email" x-model="email" placeholder="Enter your email" required
                                class="flex-1 p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            <button type="submit" 
                                class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition whitespace-nowrap">
                                <i class="fas fa-paper-plane mr-2"></i> Subscribe
                            </button>
                        </div>
                        <p x-show="submitted" x-cloak x-transition class="text-green-600">
                            <i class="fas fa-check-circle mr-2"></i> Thanks for subscribing! We'll be in touch soon.
                        </p>
                    </form>
                </div>
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg transform rotate-2"></div>
                    <iframe class="relative w-full aspect-video rounded-lg shadow-lg" 
                        src="https://www.youtube.com/embed/PohSjXM5AW0" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Proof -->
    <section id="contact" class="py-24 bg-blue-600 text-white">
        <div class="container mx-auto text-center px-6">
            <h3 class="text-2xl font-semibold mb-4">Say Hi & Get in Touch</h3>
            <p class="mb-6">Silent winds whisper through ancient forests, as distant mountains dream beneath the endless sky.</p>
            <div class="flex justify-center space-x-6 text-2xl">
                <a href="#" class="hover:text-blue-300"><i class="fa fa-twitter"></i></a>
                <a href="#" class="hover:text-blue-300"><i class="fa fa-facebook"></i></a>
                <a href="#" class="hover:text-blue-300"><i class="fa fa-pinterest"></i></a>
                <a href="#" class="hover:text-blue-300"><i class="fa fa-google-plus"></i></a>
                <a href="#" class="hover:text-blue-300"><i class="fa fa-linkedin"></i></a>
                <a href="#" class="hover:text-blue-300"><i class="fa fa-youtube"></i></a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <h4 class="text-white text-lg font-semibold mb-4">About SIMS</h4>
                    <p class="text-sm">Leading the future of inventory management with innovative solutions for modern businesses.</p>
                </div>
                <div>
                    <h4 class="text-white text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition">API Reference</a></li>
                        <li><a href="#" class="hover:text-white transition">Status</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Community</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-lg font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center">
                <p>&copy; 2024 SIMS. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
