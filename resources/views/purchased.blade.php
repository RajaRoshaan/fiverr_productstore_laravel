<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 p-4 bg-gray-200 dark:bg-gray-800">
            <h2 class="text-xl font-semibold dark:text-gray-200 mb-4">Sidebar</h2>
            <ul>
                <li class="mb-2">
                    <a class="bg-blue-500 dark:text-gray-200 py-2 px-4 rounded-full w-full hover:bg-blue-600" href="{{ route('dashboard') }}">All items</a>
                </li>
                <li class="mb-2">
                    <a class="bg-blue-500 dark:text-gray-200 py-2 px-4 rounded-full w-full hover:bg-blue-600" href="{{ route('product.form') }}">Add items</a>
                </li>
                <li class="mb-2">
                    <a class="bg-blue-500 dark:text-gray-200 py-2 px-4 rounded-full w-full hover:bg-blue-600" href="{{ route('purchased') }}">Purchased items</a>
                </li>
                <li class="mb-2">
                    <a class="bg-blue-500 dark:text-gray-200 py-2 px-4 rounded-full w-full hover:bg-blue-600" href="{{ route('sold') }}">Sold items</a>
                </li>
                <!-- Add more buttons as needed -->
            </ul>
        </div>  

        <div class="container mx-auto p-4 text-gray-800 dark:text-white">
            <h1 class="text-2xl font-bold mb-4"><b>Purchased Items</b></h1>
            <div class="mb-6">
                @if(session('success'))
                    <div class="alert alert-success mb-6">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            @if(count($transactions) === 0)
                <p>No transactions found. All your transactions will appear here.</p>
            @else
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Seller</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Item name</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Quantity</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Price</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Purchase date</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Picture</th>
                            <!-- Add more table headers for other item attributes -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-700 p-2">{{ $transaction->seller->name }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2">{{ $transaction->item->name }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2">{{ $transaction->item->quantity }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2">{{ $transaction->item->price }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2">{{ $transaction->created_at }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2"><img style="width:300px;height:300px;" src="{{ asset('uploads/' . $transaction->item->picture) }}" alt="{{ $transaction->item->picture }}"></td>
                                <!-- Add more table cells for other item attributes -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
