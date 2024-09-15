<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Bank App</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href
="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased text-gray-200 bg-gray-900" x-data="{ open: false }">

    <!-- Navbar -->
    <header class="sticky top-0 z-10 text-gray-200 bg-gray-800" x-data="{ open: false }">
        <div class="container flex flex-col items-center px-6 py-4 mx-auto lg:flex-row lg:justify-between">
            <div class="flex justify-between items-center w-full">
                <a href="/" class="text-3xl font-bold text-blue-400">MyBank</a>

                <!-- Mobile menu button -->
                <button class="lg:hidden focus:outline-none" @click="open = !open" aria-label="Toggle Navigation">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Navigation links -->
            <nav class="mt-4 w-full lg:flex lg:items-center lg:w-auto lg:mt-0"
                x-show="open || window.innerWidth >= 1024" @click.away="open = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300" x-transition:leave
                -start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90">
                <ul class="space-y-4 w-full lg:flex lg:space-x-6 lg:w-auto lg:space-y-0">
                    <li><a href="#" class="text-gray-200 hover:text-blue-400">Home</a></li>
                    <li><a href="#" class="text-gray-200 hover:text-blue-400">About</a></li>
                    <li><a href="#" class="text-gray-200 hover:text-blue-400">Services</a></li>
                    <li><a href="#" class="text-gray-200 hover:text-blue-400">Contact</a></li>
                </ul>

                <div class="mt-4 space-x-4 lg:flex lg:ml-6 lg:mt-0">
                    <a href="/login"
                        class="px-6 py-3 text-white bg-blue-600 rounded-full border border-gray-200 hover:bg-blue-700">Login</a>
                    <a href="/register"
                        class="px-6 py-3 text-blue-600 rounded-full border border-blue-600 hover:bg-blue-600 hover:text-white">Register</a>
                </div>
            </nav>
        </div>
    </header>




    <!-- Hero Section -->
    <section class="relative h-screen bg-center bg-cover"
        style="background-image: url('https://images.unsplash.com/photo-1483478550801-ceba5fe50e8e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container flex relative z-10 flex-col justify-center items-center px-6 mx-auto h-full text-white">
            <h1 class="text-5xl font-bold leading-tight text-center">Banking for the Modern World</h1>
            <p class="mt-4 text-xl text-center">Simple, Secure, and Seamless Financial Solutions.</p>
            <div class="flex mt-10 space-x-4">
                <a href="/login" class="px-8 py-4 text-lg font-bold bg-blue-600 rounded-full hover:bg-blue-700">Get
                    Started</a>
                <a href="/learn-more"
                    class="px-8 py-4 text-lg font-bold rounded-full border border-white hover:bg-white hover:text-gray-900">Learn
                    More</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 text-gray-200 bg-gray-800">
        <div class="container px-6 mx-auto">
            <h2 class="mb-12 text-3xl font-bold text-center">Features That Empower You</h2>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-8 bg-gray-700 rounded-lg shadow-md hover:shadow-lg">
                    <i class="mb-4 text-5xl text-blue-400 fas fa-mobile-alt"></i>
                    <h3 class="mb-2 text-xl font-bold">Mobile Banking</h3>

                    <p class="text-gray-300">Manage your accounts on the go with our intuitive mobile app.</p>
                </div>
                <div class="p-8 bg-gray-700 rounded-lg shadow-md hover:shadow-lg">
                    <i class="mb-4 text-5xl text-blue-400 fas fa-shield-alt"></i>
                    <h3 class="mb-2 text-xl font-bold">Secure Transactions</h3>
                    <p class="text-gray-300">Your security is our priority. We use advanced encryption to protect your
                        information.</p>
                </div>
                <div class="p-8 bg-gray-700 rounded-lg shadow-md hover:shadow-lg">
                    <i class="mb-4 text-5xl text-blue-400 fas fa-chart-line"></i>
                    <h3 class="mb-2 text-xl font-bold">Financial Insights</h3>
                    <p class="text-gray-300">Track your spending, set budgets, and achieve your financial goals with our
                        powerful tools.</p>
                </div>
                <div class="p-8 bg-gray-700 rounded-lg shadow-md hover:shadow-lg">
                    <i class="mb-4 text-5xl text-blue-400 fas fa-comments"></i>
                    <h3 class="mb-2 text-xl font-bold">24/7 Support</h3>
                    <p class="text-gray-300">Our dedicated support team is available around the clock to assist you.</p>
                </div>
                <div class="p-8 bg-gray-700 rounded-lg shadow-md hover:shadow-lg">
                    <i class="mb-4 text-5xl text-blue-400 fas fa-credit-card"></i>
                    <h3 class="mb-2 text-xl font-bold">Personalized Cards</h3>
                    <p class="text-gray-300">Choose the card that fits your lifestyle and enjoy exclusive benefits.</p>
                </div>
                <div class="p-8 bg-gray-700 rounded-lg shadow-md hover:shadow-lg">
                    <i class="mb-4 text-5xl text-blue-400 fas fa-piggy-bank"></i>
                    <h3 class="mb-2 text-xl font-bold">Savings Goals</h3>
                    <p class="text-gray-300">Reach your savings milestones with our easy-to-use savings tools.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 text-white bg-blue-900">
        <div class="container px-6 mx-auto text-center">
            <h2 class="text-3xl font-bold">Ready to Experience the Future of Banking?</h2>
            <p class="mt-4 text-lg">Join MyBank today and unlock your financial potential.</p>
            <a href="/register"
                class="inline-block px-8 py-4 mt-8 font-bold text-blue-600 bg-white rounded-full hover:bg-gray-200">Open
                an
                Account</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 text-gray-400 bg-black">
        <div class="container px-6 mx-auto text-center">
            <p>&copy; <span id="year"></span> MyBank. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>

</html>
