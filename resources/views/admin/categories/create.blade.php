@extends('layouts.app')

@section('title', __('messages.new_category'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">{{ __('messages.new_category') }}</h1>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.name') }} *</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}" class="w-full border rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.description') }}</label>
                <textarea name="description" id="description" rows="4" class="w-full border rounded px-4 py-2">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.image') }}</label>
                <input type="file" name="image" id="image" accept="image/*" class="w-full border rounded px-4 py-2">
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    {{ __('messages.save') }}
                </button>
                <a href="{{ route('admin.categories.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                    {{ __('messages.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
