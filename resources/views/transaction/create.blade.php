<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Transaction') }}
        </h2>
    </x-slot>

    <div class="p-4 mx-auto max-w-lg rounded-sm shadow-md">
        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <input hidden name="sender_id" value="{{ Auth::id() }}" />

            <div class="mb-4 mt-1">
                <x-input-label for="type" :value="__('Type')" />
                <select id="type" name="type"
                    class="block mt-1 w-full order-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Select a transaction type</option>
                    <option value="deposit">Deposit</option>
                    <option value="transfer">Transfer</option>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </select>
            </div>
            <div class="mb-4 mt-1">
                <x-input-label for="amount" :value="__('Amount')" />
                <x-text-input id="amount" class="block mt-1 w-full" type="number" step="0.01" name="amount"
                    :value="old('amount')" required autofocus autocomplete="amount" />
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            </div>

            <script>
                if (document.getElementById('type'))
                    document.getElementById('type').addEventListener('change', function() {
                        if (this.value == 'transfer') {
                            document.getElementById('receiver').disabled = false;
                            document.getElementById('receiver_input').disabled = true;
                        } else {
                            document.getElementById('receiver').disabled = true;
                            document.getElementById('receiver_input').disabled = false;
                        }
                    });
            </script>
            <input hidden name="receiver_id" id="receiver_input" value="{{ Auth::id() }}" disabled/>
            <div class="mb-4 mt-1">
                <x-input-label for="receiver" :value="__('Receiver')" />
                <select id="receiver"
                    class="block mt-1 w-full order-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    name="receiver_id" :value="old('receiver_id')" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('receiver')" class="mt-2" />
            </div>

            <div class="mb-4 mt-1">
                <x-primary-button type="submit">Submit</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
