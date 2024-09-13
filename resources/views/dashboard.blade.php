<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Account Balance Card --}}
                <div class="bg-gradient-to-br from-indigo-500 to-blue-500 rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold text-white mb-2">Account Balance</h3>
                    <p class="text-4xl font-bold text-white">R$ {{ Auth::user()->balance->value }}</p>
                </div>

                {{-- Quick Actions Cards --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg col-span-1 md:col-span-2 lg:col-span-1 p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('transaction.create') }}" class="bg-green-100 hover:bg-green-200 text-green-800 dark:bg-green-600 dark:hover:bg-green-700 dark:text-green-100 font-semibold py-3 px-4 rounded-lg transition duration-300">
                            Transfer
                        </a>
                        <a href="{{ route('transaction.create') }}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 dark:text-blue-100 font-semibold py-3 px-4 rounded-lg transition duration-300">
                            Deposit
                        </a>
                        <a href="{{ route('transaction.create') }}" class="bg-red-100 hover:bg-red-200 text-red-800 dark:bg-red-600 dark:hover:bg-red-700 dark:text-red-100 font-semibold py-3 px-4 rounded-lg transition duration-300">
                            Withdraw
                        </a>
                        <a href="{{ route('transaction.history') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white dark:bg-yellow-600 dark:hover:bg-yellow-700 font-bold py-3 px-4 rounded-lg transition duration-300">
                            History
                        </a>
                    </div>
                </div>

                {{-- Recent Transactions --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Recent Transactions</h3>
                    <div class="border-t border-gray-200 dark:border-gray-700">
                        <dl>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Transaction Type</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">Deposit</dd>
                            </div>
                            <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Amount</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">R$ 100.00</dd>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">2023-11-27</dd>
                            </div>
                        </dl>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
