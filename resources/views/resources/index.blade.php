@extends('layouts.app')

@section('page-title', 'Resource Links')
@section('page-subtitle', 'Manage library resource links')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200 flex items-center justify-between">
        <h3 class="text-lg font-bold text-gray-900">Resource Links</h3>
        <a href="{{ route('resources.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-smooth font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Resource
        </a>
    </div>
    
    <div class="divide-y divide-gray-200">
        @forelse($resources as $resource)
            <div class="p-6 hover:bg-gray-50 transition-smooth">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-900">{{ $resource->title }}</h4>
                        @if($resource->description)
                            <p class="text-sm text-gray-600 mt-1">{{ $resource->description }}</p>
                        @endif
                        <div class="flex items-center gap-4 mt-2">
                            <a href="{{ $resource->url }}" target="{{ $resource->is_external ? '_blank' : '_self' }}" class="text-sm text-emerald-600 hover:text-emerald-700">
                                {{ $resource->url }}
                            </a>
                            @if($resource->category)
                                <span class="text-xs text-gray-500">{{ $resource->category }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($resource->is_active)
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">Active</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded">Inactive</span>
                        @endif
                        <a href="{{ route('resources.edit', $resource) }}" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('resources.destroy', $resource) }}" class="inline" onsubmit="return confirm('Delete this resource?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <p class="text-gray-500">No resources yet. <a href="{{ route('resources.create') }}" class="text-emerald-600 hover:text-emerald-700">Add one</a></p>
            </div>
        @endforelse
    </div>
    
    @if($resources->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $resources->links() }}
        </div>
    @endif
</div>
@endsection

