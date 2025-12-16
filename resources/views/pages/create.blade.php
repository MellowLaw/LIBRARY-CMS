@extends('layouts.app')

@section('page-title', 'Create Page')
@section('page-subtitle', 'Add a new page to your library website')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <form method="POST" action="{{ route('pages.store') }}" class="space-y-6">
                @csrf

                <!-- Basic Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Page Information</h3>

                    <div class="space-y-4">
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Page Title <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter page title"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Slug <span
                                    class="text-red-500">*</span></label>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-600 text-sm">/</span>
                                <input type="text" name="slug" value="{{ old('slug') }}" placeholder="page-slug"
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm"
                                    required>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Auto-generated from title or enter manually</p>
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Meta Description -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Meta Description</label>
                            <textarea name="meta_description" placeholder="Brief description for SEO (160 characters max)"
                                rows="2" maxlength="160"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm">{{ old('meta_description') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Used for search engine listings</p>
                            @error('meta_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Content Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Page Content</h3>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Content</label>
                        <textarea id="editor" name="content"
                            class="w-full h-96 border border-gray-300 rounded-lg">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-smooth font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Create Page
                    </button>
                    <a href="{{ route('pages.index') }}"
                        class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-smooth font-medium text-gray-700">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Publishing Options -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Publishing</h3>

                <div class="space-y-3">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_published" class="w-5 h-5 rounded border-gray-300">
                        <span class="text-sm font-medium text-gray-700">Publish immediately</span>
                    </label>

                    <div class="pt-3 border-t border-gray-200">
                        <label class="block text-xs font-semibold text-gray-600 mb-2">Or schedule for later</label>
                        <input type="datetime-local" name="scheduled_at"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>
            </div>

            <!-- Help Card -->
            <div class="bg-blue-50 rounded-xl border border-blue-200 p-6">
                <h4 class="text-sm font-bold text-blue-900 mb-2">💡 Tips</h4>
                <ul class="text-xs text-blue-800 space-y-2">
                    <li>• Use clear, descriptive titles</li>
                    <li>• Make slug URL-friendly</li>
                    <li>• Add meta description for SEO</li>
                    <li>• Use the editor toolbar for formatting</li>
                </ul>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            if (window.tinymce) {
                tinymce.init({
                    selector: '#editor',
                    base_url: 'https://cdn.jsdelivr.net/npm/tinymce@6.8.6',
                    suffix: '.min',
                    height: 400,
                    plugins: 'link image code media table lists',
                    toolbar: 'undo redo | blocks | fontfamily fontsize | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | removeformat | code',
                    font_family_formats: 'Inter=Inter,sans-serif; Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; Georgia=georgia,palatino,serif; Tahoma=tahoma,arial,helvetica,sans-serif; Times New Roman=times new roman,times,serif; Verdana=verdana,geneva,sans-serif',
                    font_size_formats: '12px 14px 16px 18px 20px 24px 30px 36px 48px',
                    content_style: 'body { font-family: Inter, sans-serif; font-size: 16px; }',
                    menubar: false,
                    branding: false,
                    promotion: false,
                    setup: function (editor) {
                        // Auto-save on change
                        editor.on('change keyup', function () {
                            editor.save();
                        });
                    }
                });
            }

            // Ensure content is saved before form submission
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.querySelector('form');
                if (form) {
                    form.addEventListener('submit', function () {
                        if (window.tinymce) {
                            tinymce.triggerSave();
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection