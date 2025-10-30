@extends('layouts.app')

@section('title', __('messages.shop_categories'))

@section('content')
@php use Illuminate\Support\Str; @endphp
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">{{ __('messages.shop_categories') }}</h1>
        <a href="{{ route('admin.shop-categories.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            {{ __('messages.new_shop_category') }}
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($categories as $category)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">{{ __('messages.no_image') }}</span>
                </div>
            @endif
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2">{{ $category->name }}</h3>
                @if($category->description)
                    <p class="text-gray-600 mb-2">{{ Str::limit($category->description, 100) }}</p>
                @endif
                <p class="text-sm text-gray-500 mb-4">{{ __('messages.shops') }}: {{ $category->shops_count }}</p>
                <div class="flex gap-2">
                    <a href="{{ route('admin.shop-categories.edit', $category) }}" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-center">
                        {{ __('messages.edit') }}
                    </a>
                    <form action="{{ route('admin.shop-categories.destroy', $category) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('{{ __('messages.delete_confirm') }}')">
                            {{ __('messages.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $categories->links() }}
    </div>
</div>
@endsection




