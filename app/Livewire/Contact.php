<?php

namespace App\Livewire;

use App\Models\Contact as ModelsContact;
use Livewire\Component;

class Contact extends Component
{

    public function render()
    {
        $contact = ModelsContact::all();
        $i = 1;
        return view('livewire.contact', compact('contact','i'));
    }
}
