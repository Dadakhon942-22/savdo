@extends('layouts.app')

@section('title', __('messages.edit_shop'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">{{ __('messages.edit_shop') }}</h1>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="{{ route('admin.shops.update', $shop) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.shop_owner') }} *</label>
                <select name="user_id" id="user_id" required class="w-full border rounded px-4 py-2 @error('user_id') border-red-500 @enderror">
                    <option value="">{{ __('messages.select_seller') }}</option>
                    @foreach($sellers as $seller)
                        <option value="{{ $seller->id }}" {{ old('user_id', $shop->user_id) == $seller->id ? 'selected' : '' }}>{{ $seller->name }} ({{ $seller->email }})</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="shop_category_id" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.shop_category') }} *</label>
                <select name="shop_category_id" id="shop_category_id" required class="w-full border rounded px-4 py-2 @error('shop_category_id') border-red-500 @enderror">
                    <option value="">{{ __('messages.select_shop_category') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('shop_category_id', $shop->shop_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('shop_category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.shop_name') }} *</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $shop->name) }}" class="w-full border rounded px-4 py-2 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.description') }}</label>
                <textarea name="description" id="description" rows="4" class="w-full border rounded px-4 py-2 @error('description') border-red-500 @enderror">{{ old('description', $shop->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.phone') }}</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $shop->phone) }}" class="w-full border rounded px-4 py-2 @error('phone') border-red-500 @enderror" placeholder="+998901234567">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.address') }}</label>
                <textarea name="address" id="address" rows="3" class="w-full border rounded px-4 py-2 @error('address') border-red-500 @enderror">{{ old('address', $shop->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if($shop->logo)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.current_image') }}</label>
                    <img src="{{ asset('storage/' . $shop->logo) }}" alt="{{ $shop->name }}" class="w-32 h-32 object-cover rounded">
                </div>
            @endif

            <div class="mb-4">
                <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.new_image') }}</label>
                <input type="file" name="logo" id="logo" accept="image/*" class="w-full border rounded px-4 py-2 @error('logo') border-red-500 @enderror">
                @error('logo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $shop->is_active) ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm font-medium text-gray-700">{{ __('messages.active') }}</span>
                </label>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    {{ __('messages.update') }}
                </button>
                <a href="{{ route('admin.shops.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                    {{ __('messages.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection





