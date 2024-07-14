<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products ' . (isset($product) ? 'Edit Product' : 'Create Product')) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200">
                    <form method="POST" action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if (isset($product))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-label for="image" :value="__('Image')" />
                                <x-input id="image" class="block mt-1 w-full" type="file" name="image" />
                                @if (isset($product) && $product->image)
                                    <img src="{{ asset( 'assets/img/bg-img/'.$product->image) }}" alt="{{ $product->name }}" class="mt-2 w-32 h-32 object-cover">
                                @endif
                            </div>

                            <div>
                                <x-label for="name" :value="__('Name')" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', isset($product) ? $product->name : '') }}" required />
                            </div>

                            <div>
                                <x-label for="price" :value="__('Price')" />
                                <x-input id="price" class="block mt-1 w-full" type="text" name="price" value="{{ old('price', isset($product) ? $product->price : '') }}" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    {{ __('Save') }}
                                </x-button>
                                <a href="{{ route('products.index') }}" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>