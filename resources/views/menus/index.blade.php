@extends('layouts.admin')

@section('page-title', 'Navigation Menus')
@section('page-subtitle', 'Manage your website navigation menus')

@section('content')
    <div class="space-y-6">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-900 text-white text-xs font-semibold uppercase tracking-wider rounded-full mb-2">
                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span>
                    Admin Panel
                </span>
                <h2 class="text-4xl font-bold text-gray-900">Navigation Menus</h2>
            </div>
            <form method="POST" action="{{ route('logout') }}" onsubmit="event.preventDefault(); openLogoutModal(this);">
                @csrf
                <button type="submit"
                    class="sign_out_btn text-sm text-red-600 hover:text-red-700 font-medium transition-smooth bg-red-50 hover:bg-red-100 px-4 py-2 rounded-lg">
                    Sign Out
                </button>
            </form>
        </div>

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Menu Structure</h3>
                <p class="text-sm text-gray-500 mt-1">Organize and manage your website navigation</p>
            </div>
            <a href="{{ route('menus.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-smooth font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Menu Item
            </a>
        </div>

        <!-- Drag & Drop Menu Builder -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div id="sortable-menu" class="space-y-2">
                @forelse($menus as $menu)
                    <div class="menu-item bg-gray-50 p-4 rounded-lg border-2 border-gray-200 hover:border-emerald-300 cursor-move group transition-smooth"
                        draggable="true" data-menu-id="{{ $menu->id }}" ondragstart="handleDragStart(event)"
                        ondragover="handleDragOver(event)" ondrop="handleDrop(event)">

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4 flex-1">
                                <svg class="w-5 h-5 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M10 6a2 2 0 11-4 0 2 2 0 014 0zM14 6a2 2 0 11-4 0 2 2 0 014 0zM10 12a2 2 0 11-4 0 2 2 0 014 0zM14 12a2 2 0 11-4 0 2 2 0 014 0zM10 18a2 2 0 11-4 0 2 2 0 014 0zM14 18a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>

                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">{{ $menu->label }}</h4>
                                    @if($menu->url)
                                        <p class="text-xs text-gray-500 mt-1">{{ $menu->url }}</p>
                                    @endif
                                    @if($menu->children->count() > 0)
                                        <p class="text-xs text-emerald-600 mt-1">{{ $menu->children->count() }} submenu item(s)</p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">
                                    {{ $menu->is_visible ? '👁 Visible' : '👁️‍🗨 Hidden' }}
                                </span>

                                <a href="{{ route('menus.edit', $menu) }}"
                                    class="p-2 text-gray-600 hover:bg-white rounded-lg transition-smooth">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>

                                <form method="POST" action="{{ route('menus.destroy', $menu) }}" class="inline"
                                    onsubmit="return confirm('Delete this menu item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-smooth">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                            </path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">No menu items</h3>
                        <p class="text-gray-500 mt-2">Create your first menu item to get started.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Save Button -->
        <button onclick="saveMenuOrder()"
            class="inline-flex items-center gap-2 px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-smooth font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Save Menu Order
        </button>
    </div>

    @push('scripts')
        <script>
            function handleDragStart(e) {
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/html', e.currentTarget);
                e.currentTarget.style.opacity = '0.5';
            }

            function handleDragOver(e) {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';
            }

            function handleDrop(e) {
                e.preventDefault();
                const dragged = document.querySelector('[style*="opacity: 0.5"]');
                if (dragged !== e.currentTarget) {
                    e.currentTarget.parentNode.insertBefore(dragged, e.currentTarget);
                }
                dragged.style.opacity = '1';
            }

            function saveMenuOrder() {
                const menuItems = Array.from(document.querySelectorAll('[data-menu-id]')).map((el, index) => ({
                    id: el.dataset.menuId,
                    display_order: index
                }));

                fetch('{{ route('menus.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: menuItems })
                })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        }
                        throw new Error('Network response was not ok');
                    })
                    .then(data => {
                        showNotification('Menu order saved successfully!', 'success');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Error saving menu order', 'error');
                    });
            }
        </script>
    @endpush
@endsection