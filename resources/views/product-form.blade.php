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
                    <a class="bg-blue-500 text-gray-800 dark:text-gray-200 py-2 px-4 rounded-full w-full hover:bg-blue-600" href="{{ route('dashboard') }}">All items</a>
                </li>
                <li class="mb-2">
                    <a class="bg-blue-500 text-gray-800 dark:text-gray-200 py-2 px-4 rounded-full w-full hover:bg-blue-600" href="{{ route('product.form') }}">Add items</a>
                </li>
                <li class="mb-2">
                    <a class="bg-blue-500 text-gray-800 dark:text-gray-200 py-2 px-4 rounded-full w-full hover:bg-blue-600" href="{{ route('purchased') }}">Purchased items</a>
                </li>
                <li class="mb-2">
                    <a class="bg-blue-500 text-gray-800 dark:text-gray-200 py-2 px-4 rounded-full w-full hover:bg-blue-600" href="{{ route('sold') }}">Sold items</a>
                </li>
                <!-- Add more buttons as needed -->
            </ul>
        </div>  

        <!-- Form -->
        <div class="w-3/4 p-4 bg-white dark:bg-gray-900">
            <form method="post" action="{{ route('product.add') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <h2 class="text-xl font-medium dark:text-gray-200 mb-6"><b>Add Product</b></h2>
                </div>
                <div class="mb-6">
                    @if(session('success'))
                        <div class="alert alert-success bg-blue-200 dark:bg-blue-600 text-blue-900 dark:text-blue-200 p-2 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium dark:text-white">Product Name</label>
                    <input type="text" id="name" name="name" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400">
                    @error('name')
                        <p class="dark:text-white text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="description" class="block mb-2 text-sm font-medium dark:text-white">Product Description</label>
                    <textarea id="description" name="description" rows="2" class="block p-2.5 w-full text-sm bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Product description here..."></textarea>
                    @error('description')
                        <p class="dark:text-white text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="quantity" class="block mb-2 text-sm font-medium dark:text-white">Quantity</label>
                    <input type="text" id="quantity" name="quantity" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400">
                    @error('quantity')
                        <p class="dark:text-white text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="picture" class="block mb-2 text-sm font-medium dark:text-white">Picture</label>
                    <input class="block w-full text-sm dark:text-gray-400 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 focus:outline-none dark:placeholder-gray-400" id="file_input" name="picture" type="file">
                    @error('picture')
                        <p class="dark:text-white text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="price" class="block mb-2 text-sm font-medium dark:text-white">Price</label>
                    <input type="text" id="price" name="price" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400">
                    @error('price')
                        <p class="dark:text-white text-sm">{{ $message }}</p>
                    @enderror
                </div>
                
                <button type="submit" class="bg-blue hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 dark:text-white">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
