@extends('layouts.public')

@section('title', 'Our Staff')

@section('content')
    <div class="bg-[#efeae4] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="title_card fade-in-up">
                Meet our <span class="italic" style="color: #ec3412;">Team.</span>
            </h4>
                <p class="mt-4 text-xl text-slate-500">Dedicated professionals serving our community.</p>
            </div>

            <div class="flex flex-wrap justify-center gap-6">
                @forelse($staffMembers as $staff)
                    <div onclick="openStaffModal({
                        name: '{{ addslashes($staff->name) }}',
                        position: '{{ addslashes($staff->position) }}',
                        email: '{{ addslashes($staff->email) }}',
                        bio: '{{ addslashes($staff->bio) }}',
                        image: '{{ $staff->profile_image ? asset('storage/' . $staff->profile_image) : '' }}',
                        initials: '{{ substr($staff->name, 0, 1) }}'
                    })" 
                    class="home-card text-center items-center w-full sm:w-72 cursor-pointer hover:scale-105 transition-transform duration-300">
                        <div class="w-24 h-24 mb-6 relative mx-auto">
                            @if($staff->profile_image)
                                <img src="{{ asset('storage/' . $staff->profile_image) }}" class="w-full h-full object-cover rounded-full shadow-md pointer-events-none" alt="{{ $staff->name }}">
                            @else
                                <div class="w-full h-full bg-primary-bg text-primary-accent flex items-center justify-center rounded-full text-2xl font-bold border border-primary-accent/20">
                                    {{ substr($staff->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <h3 class="font-bold text-lg text-primary-text mb-1 pointer-events-none">{{ $staff->name }}</h3>
                        <p class="text-primary-accent text-sm font-medium mb-3 pointer-events-none">{{ $staff->position }}</p>
                        @if($staff->bio)
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2 pointer-events-none">{{ $staff->bio }}</p>
                        @endif
                         @if($staff->email)
                            <div class="text-gray-400 hover:text-primary-accent transition-colors pointer-events-none">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="w-full text-center py-12">
                        <p class="text-gray-500 text-lg">No staff profiles found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Staff Detail Modal -->
    <div id="staffModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm" onclick="closeStaffModal()"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-[40px] bg-[#efeae4] text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-[#e5dcd6]">
                
                <!-- Close Button -->
                <div class="absolute top-4 right-4 z-10">
                    <button type="button" onclick="closeStaffModal()" class="rounded-full bg-white/50 p-2 hover:bg-white/80 transition-colors text-gray-500 hover:text-gray-800">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="px-8 py-10">
                    <div class="flex flex-col items-center">
                        <!-- Modal Image -->
                        <div class="relative mb-6">
                            <img id="modalImage" src="" alt="Staff Image" class="w-40 h-40 rounded-full object-cover shadow-lg border-4 border-white hidden">
                            <div id="modalInitials" class="w-40 h-40 rounded-full bg-primary-bg text-primary-accent flex items-center justify-center text-5xl font-bold border-4 border-white shadow-lg hidden"></div>
                        </div>

                        <!-- Modal Content -->
                        <h3 id="modalName" class="text-3xl font-bold text-primary-text mb-2 text-center font-heading"></h3>
                        <p id="modalPosition" class="text-primary-accent text-lg font-medium mb-6 text-center"></p>
                        
                        <div class="w-full bg-white/50 rounded-2xl p-6 mb-6">
                            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Biography</h4>
                            <p id="modalBio" class="text-gray-700 leading-relaxed text-sm whitespace-pre-line"></p>
                        </div>

                        <div id="modalEmailContainer" class="flex items-center gap-2 text-gray-600 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                            <svg class="w-5 h-5 text-primary-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <a id="modalEmail" href="" class="hover:text-primary-accent transition-colors font-medium"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openStaffModal(staff) {
            const modal = document.getElementById('staffModal');
            const modalImage = document.getElementById('modalImage');
            const modalInitials = document.getElementById('modalInitials');
            const modalName = document.getElementById('modalName');
            const modalPosition = document.getElementById('modalPosition');
            const modalBio = document.getElementById('modalBio');
            const modalEmail = document.getElementById('modalEmail');
            const modalEmailContainer = document.getElementById('modalEmailContainer');

            // Populate Data
            modalName.textContent = staff.name;
            modalPosition.textContent = staff.position;
            modalBio.textContent = staff.bio || 'No biography available.';
            
            if (staff.image) {
                modalImage.src = staff.image;
                modalImage.classList.remove('hidden');
                modalInitials.classList.add('hidden');
            } else {
                modalInitials.textContent = staff.initials;
                modalInitials.classList.remove('hidden');
                modalImage.classList.add('hidden');
            }

            if (staff.email) {
                modalEmail.textContent = staff.email;
                modalEmail.href = 'mailto:' + staff.email;
                modalEmailContainer.style.display = 'flex';
            } else {
                modalEmailContainer.style.display = 'none';
            }

            // Show Modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeStaffModal() {
            const modal = document.getElementById('staffModal');
            modal.classList.add('hidden');
            document.body.style.overflow = ''; // Restore scrolling
        }

        // Close on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeStaffModal();
            }
        });
    </script>
@endsection