<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 p-4 bg-gray-200 dark:bg-gray-800">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Sidebar</h2>
            <ul>
                <li class="mb-2">
                    <a class="bg-blue-500 text-gray-800 dark:text-gray-200 py-2 px-4 rounded-full w-full hover:bg-blue-600 hover:text-white transition duration-300 ease-in-out transform hover:scale-105" href="{{ route('dashboard') }}">All items</a>
                </li>
                <li class="mb-2">
                    <a class="bg-blue-500 text-gray-800 dark:text-gray-200 py-2 px-4 rounded-full w-full hover:bg-blue-600 hover:text-white transition duration-300 ease-in-out transform hover:scale-105" href="{{ route('product.form') }}">Add items</a>
                </li>
                <li class="mb-2">
                    <a class="bg-blue-500 text-gray-800 dark:text-gray-200 py-2 px-4 rounded-full w-full hover:bg-blue-600 hover:text-white transition duration-300 ease-in-out transform hover:scale-105" href="{{ route('purchased') }}">Purchased items</a>
                </li>
                <li class="mb-2">
                    <a class="bg-blue-500 text-gray-800 dark:text-gray-200 py-2 px-4 rounded-full w-full hover:bg-blue-600 hover:text-white transition duration-300 ease-in-out transform hover:scale-105" href="{{ route('sold') }}">Sold items</a>
                </li>
                <!-- Add more buttons as needed -->
            </ul>
        </div>

        <div class="container mx-auto p-4 text-gray-800 dark:text-white">
            <h1 class="text-2xl font-bold mb-4"><b>Items List</b></h1>
            <div class="mb-6">
                @if(session('success'))
                    <div class="alert alert-success bg-blue-200 dark:bg-blue-600 text-blue-900 dark:text-blue-200 mb-6 p-2 rounded">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            @if(count($items)===0)
                <p>No items found. All your items will appear here</p>
            @else
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Name</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Description</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Quantity</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Price</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Date created</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Picture</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Status</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Edit</th>
                            <th class="border border-gray-300 dark:border-gray-700 p-2">Delete</th>
                            <!-- Add more table headers for other item attributes -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-700 p-2">{{ $item->name }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2">{{ $item->description }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2">{{ $item->quantity }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2">{{ $item->price }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2">{{ $item->created_at }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2">
                                    <img style="width: 150px; height: 150px;" src="{{ asset("uploads/$item->picture") }}" alt="{{ $item->name }}">
                                </td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2">
                                    @if ($item->is_sold)
                                        <p class="text-green-600 dark:text-green-300">Sold</p>
                                    @else
                                        <p class="text-blue-600 dark:text-blue-300">Unsold</p>
                                    @endif
                                </td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2"><a href="{{ route('product.edit', ['id' => $item->id]) }}" class="text-blue-600 dark:text-blue-300 hover:underline">Edit</a></td>
                                <td class="border border-gray-300 dark:border-gray-700 p-2"><a href="{{ route('product.destroy', $item->id) }}" class="text-red-600 dark:text-red-300 hover:underline">Delete</a></td>
                                <!-- Add more table cells for other item attributes -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
