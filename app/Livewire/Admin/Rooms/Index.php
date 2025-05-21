<?php

namespace App\Livewire\Admin\Rooms;

use Livewire\Component;
use App\Models\Room;

class Index extends Component
{
        public $rooms;
    public $building, $floor, $room_number, $room_type;
    public $roomId;
    public $isEdit = false;

    // Menampilkan daftar ruangan
    public function mount()
    {
        $this->rooms = Room::all();
    }

    // Menyimpan ruangan baru
    public function store()
    {
        $validatedData = $this->validate([
            'building' => 'required|string|max:255',
            'floor' => 'required|integer',
            'room_number' => 'required|string|max:10',
            'room_type' => 'required|string',
        ]);

        Room::create($validatedData);
        session()->flash('message', 'Ruangan berhasil ditambahkan.');
        $this->resetForm();
        $this->mount(); // Reload data ruangan
    }

    // Mengambil data untuk edit
    public function edit($id)
    {
        $room = Room::find($id);
        $this->roomId = $room->id;
        $this->building = $room->building;
        $this->floor = $room->floor;
        $this->room_number = $room->room_number;
        $this->room_type = $room->room_type;
        $this->isEdit = true;
    }

    // Mengupdate data ruangan
    public function update()
    {
        $validatedData = $this->validate([
            'building' => 'required|string|max:255',
            'floor' => 'required|integer',
            'room_number' => 'required|string|max:10',
            'room_type' => 'required|string',
        ]);

        $room = Room::find($this->roomId);
        $room->update($validatedData);
        session()->flash('message', 'Ruangan berhasil diperbarui.');
        $this->resetForm();
        $this->mount(); // Reload data ruangan
    }

    // Menghapus ruangan
    public function delete($id)
    {
        Room::destroy($id);
        session()->flash('message', 'Ruangan berhasil dihapus.');
        $this->mount(); // Reload data ruangan
    }

    // Reset form
    public function resetForm()
    {
        $this->building = '';
        $this->floor = '';
        $this->room_number = '';
        $this->room_type = '';
        $this->roomId = null;
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.admin.rooms.index');
    }
}
