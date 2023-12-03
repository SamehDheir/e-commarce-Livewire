<?php

namespace App\Livewire;

use App\Models\Contact as ModelsContact;
use Livewire\Component;
use Livewire\WithPagination;

class Contact extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function delete($id)
    {
        $contact = ModelsContact::find($id);
        if ($contact) {
            $contact->delete();
            session()->flash('success', 'Contact deleted successfully!');
        }
    }

    public function render()
    {
        $contact = ModelsContact::latest()->paginate(5);
        $i = 1;
        return view('livewire.contact', compact('contact', 'i'));
    }
}
