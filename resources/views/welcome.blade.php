<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.
css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .gradient-background {
            background: linear-gradient(to right, #007bff, #00c853);
            /* Example gradient, customize as needed */
        }

        .custom-shadow {
            box-shadow: 0 4px 6px -6px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<body class="gradient-background">

    <header class="py-6">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="text-white text-2xl font-bold">Bank App</div>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="#" class="text-white hover:text-gray-300">Features</a></li>
                    <li><a href="#" class="text-white hover:text-gray-300">Security</a></li>
                    <li><a href="#" class="text-white hover:text-gray-300">Contact</a></li>
                    <li><a href="#"
                            class="bg-white text-blue-500 px-4 py-2 rounded-full hover:bg-gray-100">Login</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-center md:text-left mb-8 md:mb-0">
                <h1 class="text-white text-4xl md:text-5xl font-bold mb-4">Banking Made Simple</h1>
                <p class="text-white text-lg mb-6">Manage your finances with ease, anytime, anywhere.</p>
                <button class="bg-white text-blue-500 font-bold py-3 px-6 rounded-full hover:bg-gray-100">Get
                    Started</button>
            </div>
            <div class="md:w-1/2">
                <img src="https://source.unsplash.com/random/600x400/?banking,finance" alt="Banking"
                    class="rounded-lg custom-shadow">
            </div>
        </div>

        <section class="py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg p-6 custom-shadow">
                    <i class="fas fa-mobile-alt text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Mobile Banking</h3>
                    <p class="text-gray-600">Access your accounts and make transactions on the go.</p>
                </div>
                <div class="bg-white rounded-lg p-6 custom-shadow">
                    <i class="fas fa-shield-alt text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Secure Transactions</h3>
                    <p class="text-gray-600">Your financial data is protected with advanced security measures
                    </p>
                </div>
                <div class="bg-white rounded-lg p-6 custom-shadow">
                    <i class="fas fa-chart-line text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Track Your Finances</h3>
                    <p class="text-gray-600">Monitor your spending, set budgets, and achieve your financial goals.</p>
                </div>
            </div>
        </section>

        <section class="py-12">
            <div class="text-center">
                <h2 class="text-white text-3xl font-bold mb-4">Ready to experience the future of banking?</h2>
                <button class="bg-white text-blue-500 font-bold py-3 px-6 rounded-full hover:bg-gray-100">Open an
                    Account</button>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-white py-4">
        <div class="container mx-auto px-4">
            <p class="text-center">&copy; 2023 Bank App. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
