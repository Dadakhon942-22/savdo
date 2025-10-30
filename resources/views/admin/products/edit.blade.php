@extends('layouts.app')

@section('title', __('messages.edit') . ' ' . __('messages.products'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">{{ __('messages.edit') }} {{ __('messages.products') }}</h1>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.name') }} *</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $product->name) }}" class="w-full border rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.category') }} *</label>
                <select name="category_id" id="category_id" required class="w-full border rounded px-4 py-2">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.description') }}</label>
                <textarea name="description" id="description" rows="4" class="w-full border rounded px-4 py-2">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.price') }} ({{ __('messages.currency') }}) *</label>
                    <input type="number" name="price" id="price" required step="0.01" value="{{ old('price', $product->price) }}" class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.stock') }} *</label>
                    <input type="number" name="stock" id="stock" required value="{{ old('stock', $product->stock) }}" class="w-full border rounded px-4 py-2">
                </div>
            </div>

            <!-- Chegirma maydonlari -->
            <div class="mb-4 p-4 bg-gradient-to-r from-accent-50 to-orange-50 dark:from-accent-900/20 dark:to-orange-900/20 rounded-lg border border-accent-200 dark:border-accent-700">
                <h3 class="text-lg font-semibold text-accent-700 dark:text-accent-300 mb-4">🔥 Aksiya (Chegirma)</h3>
                
                <div class="mb-3">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_on_sale" id="is_on_sale" value="1" {{ old('is_on_sale', $product->is_on_sale) ? 'checked' : '' }} class="rounded text-accent-600 focus:ring-accent-500">
                        <span class="ml-2 text-sm font-semibold text-gray-800 dark:text-gray-200">Mahsulotni aksiyaga qo'yish</span>
                    </label>
                </div>

                <div id="discount_section" style="display: {{ old('is_on_sale', $product->is_on_sale) ? 'block' : 'none' }};">
                    <label for="discount_percentage" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Chegirma foizi (%)</label>
                    <input type="number" name="discount_percentage" id="discount_percentage" min="0" max="99" step="0.01" value="{{ old('discount_percentage', $product->discount_percentage) }}" class="w-full md:w-1/2 border border-gray-300 dark:border-gray-600 rounded px-4 py-2 focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 font-medium">Masalan: 10, 25, 50 va h.k.</p>
                </div>
            </div>

            <script>
                document.getElementById('is_on_sale').addEventListener('change', function() {
                    document.getElementById('discount_section').style.display = this.checked ? 'block' : 'none';
                    if (!this.checked) {
                        document.getElementById('discount_percentage').value = 0;
                    }
                });
            </script>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.current_image') }}</label>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-32 w-32 object-cover rounded mb-2">
                @else
                    <p class="text-gray-500">{{ __('messages.no_image') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.new_image') }}</label>
                <input type="file" name="image" id="image" accept="image/*" class="w-full border rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="rounded">
                    <span class="ml-2 text-sm text-gray-700">{{ __('messages.active') }}</span>
                </label>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    {{ __('messages.save') }}
                </button>
                <a href="{{ route('admin.products.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                    {{ __('messages.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
