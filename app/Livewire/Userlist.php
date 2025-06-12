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

    public function goToMail($id)
    {
        session(['mail_id' => $id]);
        return redirect()->route('mail');
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
        $activeUserIds = DB::table('sessions')
            ->where('last_activity', '>=', Carbon::now()->subMinutes(30)->timestamp)
            ->pluck('user_id')
            ->unique();

        // If the current user is an admin, don't restrict by school
        if (auth()->user()->role === 'Admin') {
            $baseQuery = User::query();
        } else {
            // For students and teachers: same school or Admins
            $baseQuery = User::where(function ($q) {
                $q->where('school_id', auth()->user()->school_id)
                    ->orWhere('role', 'Admin');
            });
        }

        // Apply search to both name and surname
        $baseQuery = $baseQuery->where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('surname', 'like', '%' . $this->search . '%');
        });

        $this->online = (clone $baseQuery)
            ->whereIn('id', $activeUserIds)
            ->get();

        $this->offline = (clone $baseQuery)
            ->whereNotIn('id', $activeUserIds)
            ->get();

        return view('livewire.userlist');
    }



}
