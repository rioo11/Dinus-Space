<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Daftar Pemesanan Ruangan</h2>

    <table class="w-full table-auto border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-1">User</th>
                <th class="border px-2 py-1">Ruangan</th>
                <th class="border px-2 py-1">Tanggal</th>
                <th class="border px-2 py-1">Waktu</th>
                <th class="border px-2 py-1">Kegiatan</th>
                <th class="border px-2 py-1">Status</th>
                <th class="border px-2 py-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <td class="border px-2 py-1">{{ $booking->user->name }}</td>
                    <td class="border px-2 py-1">{{ $booking->room->building }} - {{ $booking->room->room_number }}</td>
                    <td class="border px-2 py-1">{{ $booking->date }}</td>
                    <td class="border px-2 py-1">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                    <td class="border px-2 py-1">{{ $booking->activity_name }}</td>
                    <td class="border px-2 py-1">
                        @if($booking->status === 'pending')
                            <span class="text-yellow-600 font-semibold">Menunggu</span>
                        @elseif($booking->status === 'approved')
                            <span class="text-green-600 font-semibold">Disetujui</span>
                        @else
                            <span class="text-red-600 font-semibold">Ditolak</span>
                        @endif
                    </td>
                    <td class="border px-2 py-1">
                        @if ($booking->status === 'pending')
                            <button wire:click="approve({{ $booking->id }})" class="bg-green-500 text-white px-2 py-1 rounded">Setujui</button>
                            <button wire:click="reject({{ $booking->id }})" class="bg-red-500 text-white px-2 py-1 rounded ml-1">Tolak</button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Tidak ada data pemesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
