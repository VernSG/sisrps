<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Selamat datang, Admin!</h3>
                    
                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Total Users -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <div class="flex items-center">
                                <div class="p-2 bg-blue-600 rounded-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-1a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-2xl font-bold text-blue-600">{{ $totalUsers }}</h4>
                                    <p class="text-blue-800">Total Users</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Mahasiswa -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-600 rounded-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-2xl font-bold text-green-600">{{ $totalMahasiswa }}</h4>
                                    <p class="text-green-800">Total Mahasiswa</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Dosen -->
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                            <div class="flex items-center">
                                <div class="p-2 bg-purple-600 rounded-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-2xl font-bold text-purple-600">{{ $totalDosen }}</h4>
                                    <p class="text-purple-800">Total Dosen</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Mata Kuliah -->
                        <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                            <div class="flex items-center">
                                <div class="p-2 bg-orange-600 rounded-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-2xl font-bold text-orange-600">{{ $totalMatkul }}</h4>
                                    <p class="text-orange-800">Total Mata Kuliah</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-semibold mb-4">Quick Actions</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <a href="{{ route('admin.users.index') }}" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <h5 class="font-semibold text-gray-800">Manage Users</h5>
                                <p class="text-sm text-gray-600">Tambah, edit, atau hapus pengguna</p>
                            </a>
                            <a href="{{ route('admin.dosen-matkul.index') }}" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <h5 class="font-semibold text-gray-800">Assign Dosen</h5>
                                <p class="text-sm text-gray-600">Kelola assignment dosen ke mata kuliah</p>
                            </a>
                            <a href="#" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <h5 class="font-semibold text-gray-800">System Settings</h5>
                                <p class="text-sm text-gray-600">Konfigurasi sistem SIAKAD</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>