<div>
    <h1 class="text-xl font-bold">Jadwal Ruangan</h1>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border px-4 py-2">No. Ruangan</th>
                <th class="border px-4 py-2">Nama Kegiatan</th>
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Jam Mulai</th>
                <th class="border px-4 py-2">Jam Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal as $schedule)
                <tr>
                    <td class="border px-4 py-2">{{ $schedule->room_id }}</td>
                    <td class="border px-4 py-2">{{ $schedule->activity_name }}</td>
                    <td class="border px-4 py-2">{{ $schedule->date }}</td>
                    <td class="border px-4 py-2">{{ $schedule->start_time }}</td>
                    <td class="border px-4 py-2">{{ $schedule->end_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
