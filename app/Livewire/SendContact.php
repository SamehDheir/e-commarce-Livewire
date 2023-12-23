<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class SendContact extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;

    public function create()
    {
        $validate = $this->validate([
            'name' => 'required|min:2|max:30',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::create($validate);

        $this->reset(["name", 'email', 'subject', 'message']);

        // session()->flash("success", "Sent message successfully.");
        toastr()->success('Sent message successfully', ['timeOut' => 2000]);
    }

    public function render()
    {
        return view('livewire.send-contact');
    }
}
