<div class="p-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Ruangan</h1>
            <p class="text-gray-600 dark:text-gray-300">Daftar ruangan yang tersedia</p>
        </div>
        <flux:modal.trigger name="room-form">
            <button type="button"
                class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 shadow-sm transition">
                + Tambah Ruangan
            </button>
        </flux:modal.trigger>
    </div>

    <!-- Table -->
    <div class="flex flex-col mb-6">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden shadow-md sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Gedung</th>
                                <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Lantai</th>
                                <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Nomor</th>
                                <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Jenis</th>
                                <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @forelse ($rooms as $room)
                                <tr wire:key="room-{{ $room->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $room->building }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $room->floor }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $room->room_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 capitalize">{{ $room->room_type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium space-x-2">
                                        <button wire:click="edit({{ $room->id }})" type="button"
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400">
                                            Edit
                                        </button>
                                        <button wire:click="confirmDelete({{ $room->id }})" type="button"
                                            class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-300">
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

    <!-- Modal Form Tambah/Edit -->
    <flux:modal name="room-form" class="w-full max-w-md">
        <div class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                {{ $isEdit ? 'Edit Ruangan' : 'Tambah Ruangan' }}
            </h2>

            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
                <flux:input label="Gedung" placeholder="Masukkan gedung" wire:model.defer="building" required />
                <flux:input label="Lantai" type="number" placeholder="Masukkan lantai" wire:model.defer="floor" required />
                <flux:input label="Nomor Ruangan" placeholder="Masukkan nomor" wire:model.defer="room_number" required />

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Jenis Ruangan</label>
                    <flux:dropdown class="w-full">
                        <flux:button icon:trailing="chevron-down">
                            {{ match($room_type) {
                                'kelas' => 'Kelas',
                                'lab' => 'Laboratorium',
                                'meeting' => 'Ruang Rapat',
                                default => '-- Pilih --',
                            } }}
                        </flux:button>

                        <flux:menu>
                            <flux:menu.radio.group>
                                <flux:menu.radio value="kelas" wire:click="$set('room_type', 'kelas')">Kelas</flux:menu.radio>
                                <flux:menu.radio value="lab" wire:click="$set('room_type', 'lab')">Laboratorium</flux:menu.radio>
                                <flux:menu.radio value="meeting" wire:click="$set('room_type', 'meeting')">Ruang Rapat</flux:menu.radio>
                            </flux:menu.radio.group>
                        </flux:menu>
                    </flux:dropdown>
                    @error('room_type') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <flux:button type="button" variant="subtle" wire:click="cancel">Batal</flux:button>
                    <flux:button type="submit" variant="primary">
                        {{ $isEdit ? 'Perbarui' : 'Tambah' }}
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
                <flux:button type="button" variant="subtle" wire:click="$dispatch('close-modal', { name: 'confirm-delete' })">Batal</flux:button>
                <flux:button type="button" variant="danger" wire:click="deleteRoom">Hapus</flux:button>
            </div>
        </div>
    </flux:modal>

</div>
