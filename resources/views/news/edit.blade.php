@extends('layouts.admin')

@section('page-title', 'Edit News')
@section('page-subtitle', 'Update announcement details')

@section('content')
<form method="POST" action="{{ route('news.update', $news) }}" class="space-y-6" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <!-- Content Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="space-y-4">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Title <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $news->title) }}"
                            placeholder="Enter news headline"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent font-medium text-lg"
                            required>
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Excerpt</label>
                        <textarea name="excerpt" placeholder="Short summary (optional)" rows="2"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm">{{ old('excerpt', $news->excerpt) }}</textarea>
                    </div>

                    <!-- Editor -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Content</label>
                        <textarea id="editor" name="content" required
                            placeholder="Write the announcement details here..."
                            class="w-full h-96 border border-gray-300 rounded-lg">{{ old('content', $news->content) }}</textarea>
                        @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-smooth font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update News
                </button>
                <a href="{{ route('news.index') }}"
                    class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-smooth font-medium text-gray-700">
                    Cancel
                </a>
                <a href="{{ route('news.preview', $news) }}" target="_blank"
                    class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-smooth font-medium text-gray-700">
                    Preview
                </a>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Publishing Options -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Publishing</h3>

                <div class="space-y-3">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_published"
                            class="w-5 h-5 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" value="1" {{ old('is_published', $news->is_published) ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-700">Publish immediately</span>
                    </label>

                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Publish At (Optional)</label>
                        <input type="datetime-local" name="published_at"
                            value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\\TH:i') : '') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>

                    @if($news->published_at)
                    <p class="text-xs text-green-600 mt-2">
                        Currently published since {{ $news->published_at->format('M d, Y') }}
                    </p>
                    @endif
                </div>
            </div>

            <!-- Featured Image -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-sm font-bold text-gray-900 mb-2">Featured Image</h3>
                @if($news->image_path)
                <img src="{{ str_starts_with($news->image_path, 'resources/img') ? url($news->image_path) : Storage::url($news->image_path) }}" alt="{{ $news->title }}"
                    class="w-full h-40 object-cover rounded-lg mb-3">
                @endif

                <input type="file" name="image" accept="image/*"
                    class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-sm font-bold text-gray-900 mb-2">SEO / URL</h3>
                <div class="space-y-2">
                    <label class="text-xs text-gray-500">Custom Slug (Optional)</label>
                    <input type="text" name="slug" value="{{ old('slug', $news->slug) }}" placeholder="custom-slug"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>
        </div>
    </div>
</form>

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
            image_advtab: true,
            image_caption: true,
            image_dimensions: true,
            automatic_uploads: true,
            images_upload_credentials: true,
            images_upload_handler: function(blobInfo, progress) {
                return new Promise(function(resolve, reject) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '{{ route("news.editor-upload") }}');
                    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    xhr.upload.onprogress = function(e) {
                        progress(e.loaded / e.total * 100);
                    };

                    xhr.onload = function() {
                        if (xhr.status < 200 || xhr.status >= 300) {
                            reject('HTTP Error: ' + xhr.status);
                            return;
                        }

                        let json;
                        try {
                            json = JSON.parse(xhr.responseText);
                        } catch (e) {
                            reject('Invalid JSON: ' + xhr.responseText);
                            return;
                        }

                        if (!json || typeof json.location !== 'string') {
                            reject('Invalid response: ' + xhr.responseText);
                            return;
                        }

                        resolve(json.location);
                    };

                    xhr.onerror = function() {
                        reject('Image upload failed due to a XHR transport error.');
                    };

                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    xhr.send(formData);
                });
            },
            menubar: false,
            branding: false,
            promotion: false,
            setup: function(editor) {
                editor.on('change keyup', function() {
                    editor.save();
                });
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form[action="{{ route("news.update", $news) }}"]');
        if (!form) return;

        form.addEventListener('submit', function() {
            if (window.tinymce) {
                tinymce.triggerSave();
            }
        });
    });
</script>
@endpush
@endsection