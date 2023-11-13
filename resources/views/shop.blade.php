<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl dark:text-gray-200 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Left Sidebar with Filters -->
        <div class="w-1/4 p-4 border-r dark:border-gray-600">
            <!-- Filter options and search bar can be placed here -->
            <h2 class="text-lg font-semibold mb-2 dark:text-white">Filters</h2>
            
            <!-- Filter by Name -->
            <form action="{{ route('shop.filter') }}" method="GET">
                <label for="name" class="block mb-2 text-sm font-medium dark:text-white">Filter by Name</label>
                <input type="text" id="name" name="name" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            
                <!-- Filter by Price -->
                <label for="min_price" class="block mb-2 text-sm font-medium dark:text-white">Min Price</label>
                <input type="number" id="min_price" name="min_price" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            
                <label for="max_price" class="block mt-2 text-sm font-medium dark:text-white">Max Price</label>
                <input type="number" id="max_price" name="max_price" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-2 dark:text-white">Filter</button>
            </form>
        </div>
    
        <!-- Right Content Area with Product Cards -->
        <div class="w-3/4 p-4">
            <h1 class="text-2xl font-semibold mb-4 dark:text-white">Shop Products</h1>
            <div class="mb-6">
                @if(session('success'))
                    <div class="alert alert-success mb-6 dark:text-white">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Product Cards -->
                @if(count($items) === 0)
                    <p>No items found. All items for sale will appear here</p>
                @else
                    @foreach ($items as $item)
                        <div class="bg-dark border rounded-lg overflow-hidden shadow-lg" style="max-width: 300px;">
                            <img src="{{ asset("uploads/$item->picture") }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h2 class="text-lg font-semibold dark:text-white">Name: {{ $item->name }}</h2>
                                <p class="text-white-600 dark:text-white">Price: ${{ $item->price }}</p>
                            </div>
                            <div class="p-4">
                                <a href="{{ route('shop.item', ['id' => $item->id]) }}" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:text-white">View Details</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
