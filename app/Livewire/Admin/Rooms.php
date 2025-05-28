<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Room;
use Flux;

class Rooms extends Component
{
    public $rooms;
    public $building, $floor, $room_number, $room_type;
    public $roomId;
    public $roomIdToDelete;
    public $isEdit = false;

    // Menampilkan daftar ruangan
    public function mount()
    {
        $this->loadRooms();
    }

    public function loadRooms()
    {
        $this->rooms = Room::all();
    }

    // Buka modal untuk tambah ruangan
    public function openModal()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->modal('room-form')->show();
    }

    // Tutup modal
    public function cancel()
    {
        $this->resetForm();
        $this->modal('room-form')->close();
    }

    // Simpan ruangan baru
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
        $this->modal('room-form')->close();
        $this->loadRooms();
    }

    // Ambil data ruangan untuk edit
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $this->fill([
            'roomId' => $room->id,
            'building' => $room->building,
            'floor' => $room->floor,
            'room_number' => $room->room_number,
            'room_type' => $room->room_type,
        ]);
        $this->isEdit = true;
        $this->modal('room-form')->show();
    }

    // Update ruangan
    public function update()
    {
        $validatedData = $this->validate([
            'building' => 'required|string|max:255',
            'floor' => 'required|integer',
            'room_number' => 'required|string|max:10',
            'room_type' => 'required|string',
        ]);

        $room = Room::findOrFail($this->roomId);
        $room->update($validatedData);
        session()->flash('message', 'Ruangan berhasil diperbarui.');
        $this->resetForm();
        $this->modal('room-form')->close();
        $this->loadRooms();
    }

    // Hapus ruangan
    public function confirmDelete($id)
    {
        $this->roomIdToDelete = $id;
        $this->modal('confirm-delete')->show(); // Panggil modal Flux
    }

    public function deleteRoom()
    {
        Room::destroy($this->roomIdToDelete);
        session()->flash('message', 'Ruangan berhasil dihapus.');
        $this->roomIdToDelete = null;
        $this->modal('confirm-delete')->close();
        $this->mount(); // Refresh data
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
        return view('livewire.admin.rooms.rooms');
    }
}
