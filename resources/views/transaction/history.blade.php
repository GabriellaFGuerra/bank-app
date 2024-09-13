<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaction History') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-4" x-data="transactionHistory()">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Transaction History</h1>
        <div class="mb-4">
            <label for="date" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Select
                Date</label>
            <input type="date" id="date" x-model="date"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                @change="fetchTransactionHistory" />
        </div>
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            @click="fetchTransactionHistory">
            Get transaction History
        </button>

        <div x-show="loading" class="mt-3">
            <span class="text-gray-700 dark:text-gray-300">Loading...</span>
        </div>
        <div x-show="!loading && balance" class="mt-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Balance on <span
                    x-text="new Intl.DateTimeFormat('pt-BR').format(new Date(date))"></span>:</h2>
            <p x-text="balance ? balance.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) : ''"
                class="text-gray-700 dark:text-gray-300 mt-2"></p>
        </div>


        <div x-show="!loading && transactionHistory" class="mt-3">
            <template x-if="transactionHistory">
                <table class="min-w-full divide-y
                    divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Sender
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Receiver
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Amount
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        <template x-for="transaction in transactionHistory" :key="transaction.id">
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"
                                    x-text="transaction.id"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"
                                    x-text="transaction.sender.name"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"
                                    x-text="transaction.receiver.name"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"
                                    x-text="transaction.amount.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"
                                    x-text="new Intl.DateTimeFormat('pt-BR').format(new Date(transaction.date))"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </template>
        </div>
        <div x-show="!loading && !transactionHistory" class="mt-3">
            <p class="text-gray-700 dark:text-gray-300">No transaction history available for this date.</p>
        </div>
    </div>
</x-app-layout>

<script>
    function transactionHistory() {
        return {
            date: new Date().toISOString().split('T')[0],
            transactionHistory: null,
            loading: false,
            balance: null, // Use balance consistently

            fetchTransactionHistory() {
                this.loading = true;
                this.transactionHistory = null;

                axios.get('/api/transaction/history', {
                        params: {
                            date: this.date
                        }
                    })
                    .then(response => {
                        this.transactionHistory = response.data.transactions;
                        this.fetchBalance();
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Failed to load transaction history');
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },

            fetchBalance() {
                axios.get('/api/balance/history', {
                        params: {
                            date: this.date
                        }
                    })
                    .then(response => {
                        this.balance = response.data.balance; // Assign to balance
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Failed to load balance');
                    });
            }
        }
    }
</script>
