<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Manajemen Jadwal Ruangan</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form Input Jadwal -->
    <form wire:submit.prevent="{{ $schedule_id ? 'update' : 'store' }}" class="mb-6 bg-white p-4 rounded shadow">
        <div class="mb-4">
            <label for="room_id" class="block font-medium mb-1">Ruangan</label>
            <select wire:model="room_id" id="room_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Ruangan --</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->building }} - Lantai {{ $room->floor }} - {{ $room->room_number }}</option>
                @endforeach
            </select>
            @error('room_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="activity_name" class="block font-medium mb-1">Nama Kegiatan</label>
            <input type="text" id="activity_name" wire:model="activity_name" class="w-full border rounded px-3 py-2" />
            @error('activity_name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="schedule_type" class="block font-medium mb-1">Tipe Jadwal</label>
            <select id="schedule_type" wire:model="schedule_type" class="w-full border rounded px-3 py-2">
                <option value="academic">Akademik</option>
                <option value="booking">Booking</option>
            </select>
            @error('schedule_type') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        @if ($schedule_type === 'academic')
            <div class="mb-4">
                <label for="semester" class="block font-medium mb-1">Semester</label>
                <select id="semester" wire:model="semester" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Semester --</option>
                    <option value="ganjil">Ganjil</option>
                    <option value="genap">Genap</option>
                </select>
                @error('semester') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="day_of_week" class="block font-medium mb-1">Hari</label>
                <select id="day_of_week" wire:model="day_of_week" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Hari --</option>
                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                    <option>Kamis</option>
                    <option>Jumat</option>
                    <option>Sabtu</option>
                    <option>Minggu</option>
                </select>
                @error('day_of_week') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="lecturer" class="block font-medium mb-1">Dosen</label>
                <input type="text" id="lecturer" wire:model="lecturer" class="w-full border rounded px-3 py-2" />
                @error('lecturer') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="class_name" class="block font-medium mb-1">Kelas</label>
                <input type="text" id="class_name" wire:model="class_name" class="w-full border rounded px-3 py-2" />
                @error('class_name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        @else
            <div class="mb-4">
                <label for="date" class="block font-medium mb-1">Tanggal Booking</label>
                <input type="date" id="date" wire:model="date" class="w-full border rounded px-3 py-2" />
                @error('date') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="booked_by" class="block font-medium mb-1">Pemesan</label>
                <input type="text" id="booked_by" wire:model="booked_by" class="w-full border rounded px-3 py-2" />
                @error('booked_by') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        @endif

        <div class="mb-4">
            <label for="start_time" class="block font-medium mb-1">Waktu Mulai</label>
            <input type="time" id="start_time" wire:model="start_time" class="w-full border rounded px-3 py-2" />
            @error('start_time') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="end_time" class="block font-medium mb-1">Waktu Selesai</label>
            <input type="time" id="end_time" wire:model="end_time" class="w-full border rounded px-3 py-2" />
            @error('end_time') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ $schedule_id ? 'Update Jadwal' : 'Tambah Jadwal' }}
        </button>
        @if ($schedule_id)
            <button type="button" wire:click="resetInput" class="ml-2 bg-gray-600 text-white px-4 py-2 rounded">Batal</button>
        @endif
    </form>

    <!-- List Jadwal -->
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-2 py-1">Ruangan</th>
                <th class="border border-gray-300 px-2 py-1">Kegiatan</th>
                <th class="border border-gray-300 px-2 py-1">Tipe</th>
                <th class="border border-gray-300 px-2 py-1">Semester</th>
                <th class="border border-gray-300 px-2 py-1">Hari / Tanggal</th>
                <th class="border border-gray-300 px-2 py-1">Waktu</th>
                <th class="border border-gray-300 px-2 py-1">Dosen / Pemesan</th>
                <th class="border border-gray-300 px-2 py-1">Kelas</th>
                <th class="border border-gray-300 px-2 py-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($schedules as $schedule)
                <tr>
                    <td class="border border-gray-300 px-2 py-1">
                        {{ $schedule->room->building }} - Lantai {{ $schedule->room->floor }} - {{ $schedule->room->room_number }}
                    </td>
                    <td class="border border-gray-300 px-2 py-1">{{ $schedule->activity_name }}</td>
                    <td class="border border-gray-300 px-2 py-1 capitalize">{{ $schedule->schedule_type }}</td>
                    <td class="border border-gray-300 px-2 py-1">{{ $schedule->semester ?? '-' }}</td>
                    <td class="border border-gray-300 px-2 py-1">
                        {{ $schedule->schedule_type === 'academic' ? $schedule->day_of_week : $schedule->date }}
                    </td>
                    <td class="border border-gray-300 px-2 py-1">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                    <td class="border border-gray-300 px-2 py-1">
                        {{ $schedule->schedule_type === 'academic' ? $schedule->lecturer : $schedule->booked_by }}
                    </td>
                    <td class="border border-gray-300 px-2 py-1">{{ $schedule->class_name ?? '-' }}</td>
                    <td class="border border-gray-300 px-2 py-1">
                        <button wire:click="edit({{ $schedule->id }})" class="bg-yellow-400 px-2 py-1 rounded text-white">Edit</button>
                        <button wire:click="delete({{ $schedule->id }})" class="bg-red-600 px-2 py-1 rounded text-white" onclick="confirm('Yakin ingin hapus?') || event.stopImmediatePropagation()">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center p-4">Belum ada jadwal</td></tr>
            @endforelse
        </tbody>
    </table>
</div>


