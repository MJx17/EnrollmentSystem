<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Amando') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <div class="app">
        <!-- Navbar -->
        @include('partials.navbar')

        <!-- Sidebar -->
        @include('partials.sidebar')
    </div>

    <!-- Main Content -->
    <div id="main-content" class="transition-all duration-300 p-4">
        {{ $slot }} <!-- This is where your page-specific content goes -->
        
        <!-- Insert the Livewire component for the dual listbox here -->
   
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarToggleButton = document.getElementById('sidebar-toggle-button');
            const sidebarCloseButton = document.getElementById('sidebar-close-button');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            // Toggle sidebar visibility
            sidebarToggleButton.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                mainContent.classList.toggle('ml-64'); // Add margin when sidebar is open
            });

            sidebarCloseButton.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                mainContent.classList.remove('ml-64'); // Remove margin when sidebar is closed
            });

            // Close sidebar when clicking outside
            sidebar.addEventListener('click', (event) => {
                if (event.target === sidebar) {
                    sidebar.classList.add('-translate-x-full');
                    mainContent.classList.remove('ml-64'); // Remove margin when sidebar is closed
                }
            });
        });
    </script>   
<style>
    .swal-progress-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: #facc15; /* Yellow */
        animation: progressFade 6s linear forwards;
        border-bottom-left-radius: 8px; /* Match toast border radius */
        border-bottom-right-radius: 8px;
    }

    @keyframes progressFade {
        from { width: 100%; }
        to { width: 0%; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function showToast(type, title, background, iconColor, progressBarColor) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: type,
                title: title,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 6000,
                timerProgressBar: true,
                background: background,
                color: '#333', // Dark text for better readability
                iconColor: iconColor,
                showClass: { popup: 'animate__animated animate__fadeInRight' },
                hideClass: { popup: 'animate__animated animate__fadeOutRight' },
                customClass: { popup: 'custom-toast' },
                didRender: () => {
                    const swalPopup = document.querySelector('.swal2-popup');
                    if (swalPopup) {
                        const progressBar = document.createElement('div');
                        progressBar.classList.add('swal-progress-bar');
                        progressBar.style.background = progressBarColor; // Set progress bar color
                        swalPopup.appendChild(progressBar);
                    }
                }
            });
        }

        // Example of session data embedded in the HTML
        const sessionData = {
            success: "{{ session('success') }}",
            error: "{{ session('error') }}",
            warning: "{{ session('warning') }}",
            updated: "{{ session('updated') }}",
            deleted: "{{ session('deleted') }}"
        };

        if (sessionData.success) {
            showToast('success', `🎉 ${sessionData.success}`, '#d1fae5', '#047857', '#6ee7b7');
        }

        if (sessionData.error) {
            showToast('error', `❌ ${sessionData.error}`, '#fee2e2', '#dc2626', '#f87171');
        }

        if (sessionData.warning) {
            showToast('warning', `⚠️ ${sessionData.warning}`, '#fef9c3', '#b45309', '#facc15');
        }

        if (sessionData.updated) {
            showToast('info', `✏️ ${sessionData.updated}`, '#dbeafe', '#1e40af', '#93c5fd');
        }

        if (sessionData.deleted) {
            showToast('error', `🗑️ ${sessionData.deleted}`, '#fde2e4', '#9b2226', '#ff6b6b');
        }
    });
</script>

<script>
    // General confirmation function for delete actions
    function confirmDelete(formId) {
        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>




@include('sweetalert::alert')


</body>
</html>
