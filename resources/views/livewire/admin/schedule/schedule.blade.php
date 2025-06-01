<div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Manajemen Jadwal Ruangan</h2>
        <flux:button wire:click="openModal" variant="primary">Tambah Jadwal</flux:button>
    </div>

    <!-- Tabel Jadwal -->
    <div class="flex flex-col mt-6">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Ruangan</th>
                                <th
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Kegiatan</th>
                                <th
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Jenis</th>
                                <th
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Hari/Tanggal</th>
                                <th
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Waktu</th>
                                <th
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Detail</th>
                                <th
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @forelse ($schedules as $schedule)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                        {{ $schedule->room->room_number ?? "-" }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $schedule->activity_name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 capitalize">
                                        {{ $schedule->schedule_type }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                        @if ($schedule->schedule_type === "booking")
                                            {{ \Carbon\Carbon::parse($schedule->date)->translatedFormat("l, d M Y") }}
                                        @else
                                            {{ $schedule->day_of_week }} (Semester {{ ucfirst($schedule->semester) }})
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format("H:i") }} -
                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format("H:i") }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                        @if ($schedule->schedule_type === "booking")
                                            Peminjam: {{ $schedule->booked_by ?? "-" }}
                                        @else
                                            Dosen: {{ $schedule->lecturer }}<br>
                                            Kelas: {{ $schedule->class_name }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-end text-sm font-medium space-x-2">
                                        <button wire:click="edit({{ $schedule->id }})" type="button"
                                            class="inline-flex items-center gap-x-2 text-sm font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400">
                                            Edit
                                        </button>
                                        <button wire:click="confirmDelete({{ $schedule->id }})" type="button"
                                            class="inline-flex items-center gap-x-2 text-sm font-semibold text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-400">
                                        Belum ada jadwal
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Jadwal -->
    <flux:modal name="schedule-form" class="w-full max-w-2xl">
        <div class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                {{ $schedule_id ? "Edit Jadwal" : "Tambah Jadwal" }}
            </h2>

            <form wire:submit.prevent="{{ $schedule_id ? "update" : "store" }}" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Ruangan</label>
                    <select wire:model="room_id" class="w-full border-gray-300 dark:bg-gray-700 rounded-md">
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->building }} - {{ $room->room_number }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <flux:input label="Nama Kegiatan" placeholder="Masukkan nama kegiatan" wire:model.defer="activity_name"
                    required />

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Jenis Jadwal</label>
                    <select wire:model="schedule_type" class="w-full border-gray-300 dark:bg-gray-700 rounded-md">
                        <option value="booking">Booking</option>
                        <option value="academic">Akademik</option>
                    </select>
                </div>

                @if ($schedule_type === "booking")
                    <flux:input type="date" label="Tanggal" wire:model.defer="date" required />
                    <flux:input label="Peminjam" placeholder="Nama peminjam" wire:model.defer="booked_by" required />
                @else
                    <flux:input label="Semester" placeholder="Semester" wire:model.defer="semester" required />
                    <flux:input label="Hari" placeholder="Contoh: Senin" wire:model.defer="day_of_week" required />
                    <flux:input label="Dosen" placeholder="Nama dosen" wire:model.defer="lecturer" required />
                    <flux:input label="Kelas" placeholder="Nama kelas" wire:model.defer="class_name" required />
                @endif

                <div class="grid grid-cols-2 gap-4">
                    <flux:input type="time" label="Jam Mulai" wire:model.defer="start_time" required />
                    <flux:input type="time" label="Jam Selesai" wire:model.defer="end_time" required />
                </div>

                <div class="flex justify-end space-x-2">
                    <flux:button type="button" variant="subtle" wire:click="cancel">Batal</flux:button>
                    <flux:button type="submit" variant="primary">
                        {{ $schedule_id ? "Perbarui" : "Tambah" }}
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Modal Konfirmasi Hapus -->
    <flux:modal name="confirm-delete" class="w-full max-w-md">
        <div class="space-y-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Konfirmasi Hapus</h2>
            <p class="text-gray-700 dark:text-gray-300">Apakah Anda yakin ingin menghapus jadwal ini? Tindakan ini tidak
                dapat dibatalkan.</p>

            <div class="flex justify-end space-x-2">
                <flux:button type="button" variant="subtle"
                    wire:click="$dispatch('close-modal', { name: 'confirm-delete' })">Batal</flux:button>
                <flux:button type="button" variant="danger" wire:click="deleteSchedule">Hapus</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
