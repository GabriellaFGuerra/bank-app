<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <i class="fas fa-plus-circle mr-2"></i> {{ __('New Transaction') }}
        </h2>
    </x-slot>
    <div class="p-4 mx-auto max-w-lg">
        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <input hidden name="sender_id" value="{{ Auth::id() }}" />
            <div class="mb-4 mt-4">
                <x-input-label for="type" :value="__('Type')" class="flex items-center">
                    <i class="fas fa-exchange-alt mr-2 text-gray-500"></i>
                </x-input-label>
                <select id="type" name="type"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm transition duration-150 ease-in-out">
                    <option value="">Select a transaction type</option>
                    <option value="deposit">Deposit</option>
                    <option value="transfer">Transfer</option>
                    <option value="withdraw">Withdraw</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            <div class="mb-4 mt-4">
                <x-input-label for="amount" :value="__('Amount')" class="flex items-center">
                    <i class="fas fa-dollar-sign mr-2 text-gray-500"></i>
                </x-input-label>
                <x-text-input id="amount" class="block mt-1 w-full" type="number" step="0.01" name="amount"
                    :value="old('amount')" required autofocus autocomplete="amount" />
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            </div>
            <div class="mb-4 mt-4" id="receiverDiv" style="display: none;">
                <x-input-label for="receiver" :value="__('Receiver')" class="flex items-center">
                    <i class="fas fa-user mr-2 text-gray-500"></i>
                </x-input-label>
                <select id="receiver" name="receiver_id"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm transition duration-150 ease-in-out"
                    :value="old('receiver_id')" required disabled>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('receiver')" class="mt-2" />
            </div>

            <input type="hidden" name="receiver_id" id="receiver_input" value="{{ Auth::id() }}" />

            <div class="mb-4 mt-4">
                <x-primary-button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 flex items-center">
                    <i class="fas fa-paper-plane mr-2"></i> Submit
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('type').addEventListener('change', function() {
            if (this.value == 'withdraw') {
                document.getElementById('receiverDiv').style.display = 'none';
                document.getElementById('receiver').disabled = true;
                document.getElementById('receiver_input').disabled = false;
            } else {
                document.getElementById('receiverDiv').style.display = 'block';
                if (this.value == 'transfer') {
                    document.getElementById('receiver').disabled = false;
                    document.getElementById('receiver_input').disabled = true;
                } else {
                    document.getElementById('receiver').disabled = true;
                    document.getElementById('receiver_input').disabled = false;
                }
            }
        });
    </script>
</x-app-layout>
