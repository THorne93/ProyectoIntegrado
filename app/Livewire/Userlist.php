<?php

namespace App\Livewire;
use DB;
use LivewireUI\Modal\ModalComponent;
use Carbon\Carbon;
use App\Models\User;
class Userlist extends ModalComponent
{
    public $isOpen = false;
    public $search = "";
    public $view = "online";
    public $online;
    public $offline;

    public function open()
    {
        $this->isOpen = true;
        $this->dispatch('lock-scroll');
    }

    public function close()
    {
        $this->isOpen = false;
        $this->dispatch('unlock-scroll');
    }

    public function toggleOnline()
    {
        $this->view = "online";
    }
    public function toggleOffline()
    {
        $this->view = "offline";
    }

    protected $listeners = ['openUserList' => 'loadUserList'];

    public function loadUserList()
    {
        $this->isOpen = true;

        $this->dispatch('lock-scroll');
    }
    public function render()
    {
        $current = DB::table('sessions')
            ->where('last_activity', '>=', Carbon::now()->subMinutes(30)->timestamp);
        $this->online = User::whereIn('id', $current->pluck('user_id'))
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('surname', 'like', '%' . $this->search . '%');
            })
            ->get();
        $this->offline = User::whereNotIn('id', $current->pluck('user_id'))
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('surname', 'like', '%' . $this->search . '%');
            })
            ->get();


        return view('livewire.userlist');
    }
}
