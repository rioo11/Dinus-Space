<div class="p-6">
    <!-- Judul dan tombol tambah -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Ruangan</h1>
            <p class="text-gray-600 dark:text-gray-300">Daftar ruangan yang tersedia</p>
        </div>

        <!-- Trigger Modal untuk tombol Tambah Ruangan -->
        <flux:modal.trigger name="room-form">
            <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm transition">
                + Tambah Ruangan
            </button>
        </flux:modal.trigger>
    </div>

    <!-- Flash Message -->
    @if (session()->has("message"))
        <div class="bg-green-500 text-white p-3 rounded mb-4 shadow">
            {{ session("message") }}
        </div>
    @endif

    <!-- Tabel -->
    <div class="overflow-x-auto shadow-md sm:rounded-lg mb-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">Gedung</th>
                    <th class="px-6 py-3">Lantai</th>
                    <th class="px-6 py-3">Nomor</th>
                    <th class="px-6 py-3">Jenis</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rooms as $room)
                    <tr wire:key="room-{{ $room->id }}"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="px-6 py-4">{{ $room->building }}</td>
                        <td class="px-6 py-4">{{ $room->floor }}</td>
                        <td class="px-6 py-4">{{ $room->room_number }}</td>
                        <td class="px-6 py-4 capitalize">{{ $room->room_type }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <button wire:click="edit({{ $room->id }})" type="button"
                                class="text-blue-600 hover:underline dark:text-blue-400">Edit</button>

                            <button wire:click="confirmDelete({{ $room->id }})" type="button"
                                class="text-red-600 hover:underline dark:text-red-400">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                            Tidak ada ruangan tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Form Tambah/Edit Ruangan -->
    <flux:modal name="room-form" class="w-full max-w-md">
        <div class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                {{ $isEdit ? "Edit Ruangan" : "Tambah Ruangan" }}
            </h2>

            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
                <flux:input label="Gedung" placeholder="Masukkan gedung" wire:model.defer="building" required />

                <flux:input label="Lantai" type="number" placeholder="Masukkan lantai" wire:model.defer="floor" required />

                <flux:input label="Nomor Ruangan" placeholder="Masukkan nomor" wire:model.defer="room_number" required />

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Jenis Ruangan</label>
                    <select wire:model.defer="room_type"
                        class="w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        <option value="">-- Pilih --</option>
                        <option value="kelas">Kelas</option>
                        <option value="lab">Laboratorium</option>
                        <option value="meeting">Ruang Rapat</option>
                    </select>
                    @error("room_type")
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <flux:button type="button" variant="subtle" wire:click="cancel">Batal</flux:button>
                    <flux:button type="submit" variant="primary">
                        {{ $isEdit ? "Perbarui" : "Tambah" }}
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Modal Konfirmasi Hapus -->
    <flux:modal name="confirm-delete" class="w-full max-w-md">
        <div class="space-y-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Konfirmasi Hapus</h2>
            <p class="text-gray-700 dark:text-gray-300">Apakah Anda yakin ingin menghapus ruangan ini? Tindakan ini tidak dapat dibatalkan.</p>

            <div class="flex justify-end space-x-2">
                <flux:button type="button" variant="subtle"
                    wire:click="$dispatch('close-modal', { name: 'confirm-delete' })">Batal</flux:button>
                <flux:button type="button" variant="danger" wire:click="deleteRoom">Hapus</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
