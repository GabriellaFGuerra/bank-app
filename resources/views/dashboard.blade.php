<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="p-4 mb-4 text-red-700 bg-red-300 rounded-lg border-l-4 border-red-500 shadow-lg">
                <div class="flex items-center">
                    <i class="mr-2 text-red-500 fas fa-exclamation-circle"></i>
                    <p class="text-lg font-semibold">Whoops! Something went wrong.</p>
                </div>
                <ul class="mt-2 ml-6 text-sm list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                {{-- Account Balance Card --}}
                <div class="p-6 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <i class="mr-3 text-2xl text-white fas fa-wallet"></i>
                        <h3 class="text-lg font-semibold text-white">Account Balance</h3>
                    </div>
                    <p class="mt-2 text-3xl font-bold text-white">R$ {{ Auth::user()->balance->value }}</p>
                </div>

                {{-- Quick Actions Cards --}}
                <div class="col-span-2 p-6 bg-gray-800 rounded-lg shadow-lg lg:col-span-1">
                    <h3 class="flex items-center mb-4 text-lg font-semibold text-white">
                        <i class="mr-2 text-yellow-400 fas fa-bolt"></i> Quick Actions
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('transaction.create', ['type' => 'transfer']) }}"
                            class="inline-flex items-center px-4 py-3 font-semibold text-white bg-green-500 rounded-lg transition duration-300 hover:bg-green-600">
                            <i class="mr-2 fas fa-exchange-alt"></i>
                            Transfer
                        </a>
                        <a href="{{ route('transaction.create', ['type' => 'deposit']) }}"
                            class="inline-flex items-center px-4 py-3 font-semibold text-white bg-blue-500 rounded-lg transition duration-300 hover:bg-blue-600">
                            <i class="mr-2 fas fa-plus-circle"></i>
                            Deposit
                        </a>
                        <a href="{{ route('transaction.create', ['type' => 'withdraw']) }}"
                            class="inline-flex items-center px-4 py-3 font-semibold text-white bg-red-500 rounded-lg transition duration-300 hover:bg-red-600">
                            <i class="mr-2 fas fa-minus-circle"></i>
                            Withdraw
                        </a>
                        <a href="{{ route('transaction.history') }}"
                            class="inline-flex items-center px-4 py-3 font-semibold text-white bg-yellow-500 rounded-lg transition duration-300 hover:bg-yellow-600">
                            <i class="mr-2 fas fa-history"></i>
                            History
                        </a>
                    </div>
                </div>

                {{-- Recent Transactions --}}
                <div class="col-span-2 p-6 bg-gray-800 rounded-lg shadow-lg lg:col-span-2">
                    <h3 class="flex items-center mb-4 text-lg font-bold text-white">
                        <i class="mr-2 text-gray-400 fas fa-clock"></i> Recent Transactions
                    </h3>
                    <div class="border-t border-gray-600">
                        <dl>
                            @forelse (Auth::user()->sentTransactions->sortByDesc('created_at')->take(2) as $transaction)
                                <div class="flex items-center py-4 border-b border-gray-700">
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
                                        <dd class="mt-1 text-sm text-white">
                                            {{ \Carbon\Carbon::parse($transaction->date)->toDayDateTimeString() }}
                                        </dd>
                                    </div>
                                </div>
                            @empty
                                <div class="py-4 text-sm text-gray-400">
                                    No recent transactions available.
                                </div>
                            @endforelse
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
