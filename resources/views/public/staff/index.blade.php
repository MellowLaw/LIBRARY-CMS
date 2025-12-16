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
                        phone: '{{ addslashes($staff->phone) }}',
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
            <div class="relative transform overflow-hidden rounded-[40px] bg-[#efeae4] text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl border border-[#e5dcd6]">
                
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
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <!-- Left Column: Image & Contact -->
                        <div class="w-full md:w-1/3 flex flex-col items-center flex-shrink-0">
                            <!-- Modal Image -->
                            <div class="relative mb-6">
                                <img id="modalImage" src="" alt="Staff Image" class="w-48 h-48 rounded-full object-cover shadow-lg border-4 border-white hidden">
                                <div id="modalInitials" class="w-48 h-48 rounded-full bg-primary-bg text-primary-accent flex items-center justify-center text-6xl font-bold border-4 border-white shadow-lg hidden"></div>
                            </div>

                            <!-- Contact Info Stack -->
                            <div class="flex flex-col gap-3 w-full">
                                <div id="modalEmailContainer" class="flex items-center gap-3 text-gray-600 bg-white px-4 py-3 rounded-xl shadow-sm border border-gray-100 w-full">
                                    <div class="bg-primary-bg p-2 rounded-full text-primary-accent shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div class="flex flex-col overflow-hidden">
                                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Email</span>
                                        <a id="modalEmail" href="" class="hover:text-primary-accent transition-colors font-medium truncate"></a>
                                    </div>
                                </div>
                                
                                <div id="modalPhoneContainer" class="flex items-center gap-3 text-gray-600 bg-white px-4 py-3 rounded-xl shadow-sm border border-gray-100 w-full hidden">
                                    <div class="bg-primary-bg p-2 rounded-full text-primary-accent shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <div class="flex flex-col overflow-hidden">
                                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Phone</span>
                                        <span id="modalPhone" class="font-medium truncate"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Info -->
                        <div class="w-full md:w-2/3 flex flex-col text-left">
                            <h3 id="modalName" class="text-4xl font-bold text-primary-text mb-2 font-heading leading-tight"></h3>
                            <p id="modalPosition" class="text-primary-accent text-xl font-medium mb-6"></p>
                            
                            <div class="bg-white/50 rounded-2xl p-6 h-full border border-white/50">
                                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-primary-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Biography
                                </h4>
                                <p id="modalBio" class="text-gray-700 leading-relaxed text-base whitespace-pre-line"></p>
                            </div>
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
            const modalPhone = document.getElementById('modalPhone');
            const modalPhoneContainer = document.getElementById('modalPhoneContainer');

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

            if (staff.phone) {
                modalPhone.textContent = staff.phone;
                modalPhoneContainer.classList.remove('hidden');
                modalPhoneContainer.style.display = 'flex';
            } else {
                modalPhoneContainer.classList.add('hidden');
                modalPhoneContainer.style.display = 'none';
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