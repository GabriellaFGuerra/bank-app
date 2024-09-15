<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            <i class="mr-2 fas fa-plus-circle"></i> {{ __('New Transaction') }}
        </h2>
    </x-slot>
    <div class="p-4 mx-auto max-w-lg">
        @if ($errors->any())
        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg border-l-4 border-red-500 shadow-lg">
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

    @if (session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg border-l-4 border-green-500 shadow-lg">
            <div class="flex items-center">
                <i class="mr-2 text-green-500 fas fa-check-circle"></i>
                <p class="text-lg font-semibold">Success!</p>
            </div>
            <p class="mt-2 text-sm">{{ session('success') }}</p>
        </div>
    @endif


        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <input hidden name="sender_id" value="{{ Auth::id() }}" />
            <div class="mt-4 mb-4">
                <x-input-label for="type" :value="__('Type')" class="flex items-center">
                    <i class="mr-2 text-gray-500 fas fa-exchange-alt"></i>
                </x-input-label>
                <select id="type" name="type"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm transition duration-150 ease-in-out dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                    <option value="{{ $type }}">{{ Str::title($type) }}</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            <div class="mt-4 mb-4">
                <x-input-label for="amount" :value="__('Amount')" class="flex items-center">
                    <i class="mr-2 text-gray-500 fas fa-dollar-sign"></i>
                </x-input-label>
                <x-text-input id="amount" class="block mt-1 w-full" type="number" step="0.01" name="amount"
                    :value="old('amount')" required autofocus autocomplete="amount" />
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            </div>
            <div class="mt-4 mb-4" id="receiverDiv" style="display: none;">
                <x-input-label for="receiver" :value="__('Receiver')" class="flex items-center">
                    <i class="mr-2 text-gray-500 fas fa-user"></i>
                </x-input-label>
                <select id="receiver" name="receiver_id"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm transition duration-150 ease-in-out dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                    :value="old('receiver_id')" required disabled>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('receiver')" class="mt-2" />
            </div>

            <input type="hidden" name="receiver_id" id="receiver_input" value="{{ Auth::id() }}" />

            <div class="mt-4 mb-4">
                <x-primary-button type="submit"
                    class="flex items-center px-4 py-2 font-semibold text-white bg-blue-500 rounded-md transition duration-300 hover:bg-blue-600">
                    <i class="mr-2 fas fa-paper-plane"></i> Submit
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>
        if (document.getElementById('type').value == 'withdraw' || document.getElementById('type').value == 'deposit') {
            document.getElementById('receiverDiv').style.display = 'none';
            document.getElementById('receiver').disabled = true;
            document.getElementById('receiver_input').disabled = false;
        } else {
            document.getElementById('receiverDiv').style.display = 'block';
            if (document.getElementById('type').value == 'transfer') {
                document.getElementById('receiver').disabled = false;
                document.getElementById('receiver_input').disabled = true;
            }
        }
    </script>
</x-app-layout>
