<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl dark:text-gray-200 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="flex bg-white dark:bg-gray-800">
        <div class="2xl:container 2xl:mx-auto lg:py-16 lg:px-20 md:py-12 md:px-6 py-9 px-4">
            <div class="flex lg:flex-row-reverse flex-col gap-8">
                <!-- Description Div -->
                <div class="w-full lg:w-6/12">
                    <h2 class="font-semibold lg:text-4xl text-3xl lg:leading-9 leading-7 mt-4 dark:text-white">{{ $item->name }}</h2>
                    <p class="font-normal text-base leading-6 mt-7 dark:text-gray-300">{{ $item->description }}</p>
                    <p class="font-semibold lg:text-2xl text-xl lg:leading-6 leading-5 mt-6 dark:text-white">$ {{ $item->price }}</p>

                    @auth
                        <!-- Hidden Form -->
                        <form action="{{ route('shop.buy') }}" method="POST">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <button type="submit" class="focus:outline-none focus:ring-2 hover:bg-black hover:text-white focus:ring-offset-2 focus:ring-gray-800 font-medium text-base leading-4 w-full py-5 lg:mt-12 mt-6 dark:text-white"
                                @if ($item->seller_id === Auth::id())
                                    disabled
                                @endif
                            >
                                @if ($item->seller_id === Auth::id())
                                    Already Owned
                                @else
                                    Buy now
                                @endif
                            </button>
                        </form>
                    @endauth

                    @guest
                        <div class="w-full text-center py-8">
                            <div class="max-w-lg mx-auto p-4 bg-gray-200 dark:bg-gray-800 rounded-lg">
                                <p class="text-lg text-gray-700 dark:text-gray-300">
                                    Please log in to your account to make a purchase and enjoy all the features.
                                </p>
                            </div>
                        </div>
                    @endguest
                    
                    <a href="{{ route('shop') }}" class="focus:outline-none focus:ring-2 hover:bg-black hover:text-white focus:ring-offset-2 focus:ring-gray-800 font-medium text-base leading-4 w-full py-5 lg:mt-12 mt-6 dark:text-white">Back to shop</a>
                </div>
          
                <!-- Preview Images Div For larger Screen-->
                <div class="w-full lg:w-6/12 lg:pl-8 flex lg:flex-row flex-col lg:gap-8 sm:gap-6 gap-4">
                    <!-- Image Container -->
                    <div class="w-full">
                        <img src="{{ asset("uploads/$item->picture") }}" alt="{{ $item->name }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
