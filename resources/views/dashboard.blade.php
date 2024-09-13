<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Account Balance Card --}}
                <div class="bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg shadow-lg p-6">
                    <div class="flex items-center">
                        <i class="fas fa-wallet text-white text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold text-white">Account Balance</h3>
                    </div>
                    <p class="text-3xl font-bold text-white mt-2">R$ {{ Auth::user()->balance->value }}</p>
                </div>
                {{-- Quick Actions Cards --}}
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 col-span-2 lg:col-span-1">
                    <h3 class="text-lg font-semibold mb-4 text-white flex items-center">
                        <i class="fas fa-bolt text-yellow-400 mr-2"></i> Quick Actions
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('transaction.create') }}"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 inline-flex items-center">
                            <i class="fas fa-exchange-alt mr-2"></i>
                            Transfer
                        </a>
                        <a href="{{ route('transaction.create') }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 inline-flex items-center">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Deposit
                        </a>
                        <a href="{{ route('transaction.create') }}"
                            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 inline-flex items-center">
                            <i class="fas fa-minus-circle mr-2"></i>
                            Withdraw
                        </a>
                        <a href="{{ route('transaction.history') }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 inline-flex items-center">
                            <i class="fas fa-history mr-2"></i>
                            History
                        </a>
                    </div>
                </div>
                {{-- Recent Transactions --}}
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 col-span-2 lg:col-span-2">
                    <h3 class="text-lg font-bold mb-4 text-white flex items-center">
                        <i class="fas fa-clock text-gray-400 mr-2"></i> Recent Transactions
                    </h3>
                    <div class="border-t border-gray-600">
                        <dl>
                            @foreach (Auth::user()->sentTransactions->slice(0, 2) as $transaction)
                                <div class="py-4 border-b border-gray-700 flex items-center">
                                    <div class="w-1/4">
                                        <dt class="text-sm font-medium text-gray-400">Type</dt>
                                        <dd class="mt-1 text-sm text-white">{{ Str::title($transaction->type) }}</dd>
                                    </div>
                                    <div class="w-1/4">
                                        <dt class="text-sm font-medium text-gray-400">Amount</dt>
                                        <dd class="mt-1 text-sm text-white">R$ {{ $transaction->amount }}</dd>
                                    </div>
                                    <div class="w-1/2">
                                        <dt class="text-sm font-medium text-gray-400">Date</dt>
                                        <dd class="mt-1 text-sm text-white">{{ \Carbon\Carbon::parse($transaction->date)->toDayDateTimeString() }}</dd>
                                    </div>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
