<div class="p-6">

    <!-- Judul dan tombol tambah -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Ruangan</h1>
            <p class="text-gray-600 dark:text-gray-300">Daftar ruangan yang tersedia</p>
        </div>

        <!-- Trigger Modal untuk tombol Tambah Ruangan -->
        <flux:modal.trigger name="room-form">
            <button type="button"
                class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 shadow-sm transition">
                + Tambah Ruangan
            </button>
        </flux:modal.trigger>
    </div>

    <!-- Judul dan tombol tambah -->
    <div class="flex flex-col mb-6">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden shadow-md sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Gedung
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Lantai
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Nomor
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Jenis
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @forelse ($rooms as $room)
                                <tr wire:key="room-{{ $room->id }}">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $room->building }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        {{ $room->floor }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        {{ $room->room_number }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 capitalize">
                                        {{ $room->room_type }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium space-x-2">
                                        <button wire:click="edit({{ $room->id }})" type="button"
                                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-hidden dark:text-blue-500 dark:hover:text-blue-400">
                                            Edit
                                        </button>
                                        <button wire:click="confirmDelete({{ $room->id }})" type="button"
                                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-hidden dark:text-red-500 dark:hover:text-red-400">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-300">
                                        Tidak ada ruangan tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah/Edit Ruangan -->
    <flux:modal name="room-form" class="w-full max-w-md">
        <div class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                {{ $isEdit ? "Edit Ruangan" : "Tambah Ruangan" }}
            </h2>

            <form wire:submit.prevent="{{ $isEdit ? "update" : "store" }}" class="space-y-4">
                <flux:input label="Gedung" placeholder="Masukkan gedung" wire:model.defer="building" required />

                <flux:input label="Lantai" type="number" placeholder="Masukkan lantai" wire:model.defer="floor"
                    required />

                <flux:input label="Nomor Ruangan" placeholder="Masukkan nomor" wire:model.defer="room_number"
                    required />

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
            <p class="text-gray-700 dark:text-gray-300">Apakah Anda yakin ingin menghapus ruangan ini? Tindakan ini
                tidak dapat dibatalkan.</p>

            <div class="flex justify-end space-x-2">
                <flux:button type="button" variant="subtle"
                    wire:click="$dispatch('close-modal', { name: 'confirm-delete' })">Batal</flux:button>
                <flux:button type="button" variant="danger" wire:click="deleteRoom">Hapus</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
