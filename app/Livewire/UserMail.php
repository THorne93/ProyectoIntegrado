<?php

namespace App\Livewire;
use App\Models\User;
use App\Models\Mail;
use Auth;
use Livewire\Component;
use Request;

class UserMail extends Component
{

    public $allUsers;
    public $user;
    public $mails;
    public $successSend = false;
    public $fromUserName;
    public $confirmdelete = false;
    public $recipient;
    public $sendError = false;
    public $content;
    public $search;

    public $recipientID;
    public $subject;
    public $currentMail;
    public function mount()
    {
        if (session('mail_id')) {
            $this->recipient = User::find(session('mail_id'));
            session()->forget('mail_id');
        }
        $user = User::findOrFail(Auth::user()->id);
        $this->mails = Mail::where('to_user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function changeSendSuccess()
    {
        $this->successSend = true;
    }

    public function openMail($mailId)
    {
        $this->currentMail = Mail::findOrFail($mailId);
        $this->currentMail->is_read = true;
        $this->currentMail->save();
        $this->dispatch('openMail');
        $this->fromUserName = User::findOrFail($this->currentMail->from_user_id)->name . ' ' . User::findOrFail($this->currentMail->from_user_id)->surname;
    }

    public function newMessage()
    {
        $this->currentMail = null;
        $this->recipient = null;
    }

    public function changeRecipient($recipientId)
    {
        $this->recipient = User::findOrFail($recipientId);
        $this->recipientID = $recipientId;
    }

    public function deleteMail()
    {
        $this->confirmdelete = true;
    }

    public function deleteMailConfirm()
    {
        $this->currentMail->delete();
        $this->currentMail = null;
        $this->confirmdelete = false;
        $this->mails = Mail::where('to_user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function sendError()
    {
        $this->sendError = true;
    }
    public function respond()
    {
        $this->recipient = User::findOrFail($this->currentMail->from_user_id);
        $this->subject = 'Re: ' . $this->currentMail->subject;
        $this->currentMail = null;
    }

    public function send(Request $request)
    {
        if ($this->recipient == null || $this->subject == null || $this->content == null) {
            $this->sendError();
            return;
        }
        $mail = new Mail();
        $mail->to_user_id = $this->recipient->id;
        $mail->from_user_id = Auth::user()->id;
        $mail->subject = $this->subject;
        $mail->body = $this->content;
        $mail->is_read = false;
        $mail->save();
        $this->currentMail = null;
        $this->recipient = null;
        $this->subject = null;
        $this->content = null;
        $this->changeSendSuccess();
    }
    public function render()
    {
        $query = User::where('id', '!=', Auth::user()->id);

        if (Auth::user()->role !== 'Admin') {
            // Limit to same school or admins
            $query->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)
                    ->orWhere('role', 'Admin');
            });
        }

        // Apply search to name and surname
        $query->where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('surname', 'like', '%' . $this->search . '%');
        });

        $this->allUsers = $query->get();

        return view('livewire.usermail')->layout('layouts.app');
    }

}
