<div class="mb-6">
    <h3 class="text-lg font-bold mb-2">Ajukan Pemesanan Ruangan</h3>

    @if ($successMessage)
        <div class="p-2 bg-green-100 border border-green-300 text-green-800 rounded mb-2">
            {{ $successMessage }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-3">
        <div>
            <label class="block">Ruangan</label>
            <select wire:model="room_id" class="border rounded w-full p-2">
                <option value="">-- Pilih --</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->building }} - {{ $room->room_number }}</option>
                @endforeach
            </select>
            @error('room_id') <small class="text-red-600">{{ $message }}</small> @enderror
        </div>

        <div>
            <label class="block">Nama Kegiatan</label>
            <input type="text" wire:model="activity_name" class="border rounded w-full p-2" />
            @error('activity_name') <small class="text-red-600">{{ $message }}</small> @enderror
        </div>

        <div>
            <label class="block">Tanggal</label>
            <input type="date" wire:model="date" class="border rounded w-full p-2" />
            @error('date') <small class="text-red-600">{{ $message }}</small> @enderror
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block">Jam Mulai</label>
                <input type="time" wire:model="start_time" class="border rounded w-full p-2" />
                @error('start_time') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>
            <div>
                <label class="block">Jam Selesai</label>
                <input type="time" wire:model="end_time" class="border rounded w-full p-2" />
                @error('end_time') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Ajukan
        </button>
    </form>
</div>
