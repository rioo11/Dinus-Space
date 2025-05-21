<div class="relative mb-6 w-full">
    <!-- Judul -->
    <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ __("Ruangan") }}</h1>
    <h2 class="text-xl text-gray-600 dark:text-gray-300">{{ __("Daftar ruangan yang tersedia") }}</h2>
    <hr class="border-t-2 border-gray-200 dark:border-gray-600 my-4" />

    <!-- Flash Message -->
    @if (session()->has("message"))
        <div class="bg-green-500 text-white p-3 rounded mb-4 shadow">
            {{ session("message") }}
        </div>
    @endif

    <!-- Tabel Daftar Ruangan -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-6">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">{{ __("Gedung") }}</th>
                    <th scope="col" class="px-6 py-3">{{ __("Lantai") }}</th>
                    <th scope="col" class="px-6 py-3">{{ __("Nomor Ruangan") }}</th>
                    <th scope="col" class="px-6 py-3">{{ __("Jenis Ruangan") }}</th>
                    <th scope="col" class="px-6 py-3">{{ __("Aksi") }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rooms as $room)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $room->building }}
                        </th>
                        <td class="px-6 py-4">{{ $room->floor }}</td>
                        <td class="px-6 py-4">{{ $room->room_number }}</td>
                        <td class="px-6 py-4 capitalize">{{ $room->room_type }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <button wire:click="edit({{ $room->id }})"
                                class="font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                {{ __("Edit") }}
                            </button>
                            <button wire:click="delete({{ $room->id }})"
                                class="font-medium text-red-600 dark:text-red-400 hover:underline">
                                {{ __("Hapus") }}
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                            {{ __("Tidak ada ruangan tersedia.") }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Form Tambah/Edit Ruangan -->
    <div class="mb-6">
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-2">
            {{ $isEdit ? __("Edit Ruangan") : __("Tambah Ruangan") }}
        </h3>
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                <!-- Gedung -->
                <div class="mb-4">
                    <label for="building" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        {{ __("Gedung") }}
                    </label>
                    <input type="text" id="building" wire:model="building"
                        class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                    @error("building")
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Lantai -->
                <div class="mb-4">
                    <label for="floor" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        {{ __("Lantai") }}
                    </label>
                    <input type="number" id="floor" wire:model="floor"
                        class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                    @error("floor")
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nomor Ruangan -->
                <div class="mb-4">
                    <label for="room_number" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        {{ __("Nomor Ruangan") }}
                    </label>
                    <input type="text" id="room_number" wire:model="room_number"
                        class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                    @error("room_number")
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jenis Ruangan -->
                <div class="mb-4">
                    <label for="room_type" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        {{ __("Jenis Ruangan") }}
                    </label>
                    <select id="room_type" wire:model="room_type"
                        class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                        <option value="kelas">{{ __("Kelas") }}</option>
                        <option value="lab">{{ __("Laboratorium") }}</option>
                        <option value="meeting">{{ __("Ruang Rapat") }}</option>
                    </select>
                    @error("room_type")
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <button type="submit"
                    class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition">
                    {{ $isEdit ? __("Perbarui") : __("Tambah") }}
                </button>
            </form>
        </div>
    </div>
</div>
