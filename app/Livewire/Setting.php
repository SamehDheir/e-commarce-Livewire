<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Setting extends Component
{

    use WithFileUploads;


    public $email;
    public $username;
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;
    public $avatar;

    public function changeUserName()
    {
        $this->validate([
            'username' => 'required|min:2|max:15'
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $this->username;
        $user->save();
        session()->flash('successUserName', 'Change Username Successfully');
        return redirect()->back();
    }

    public function changeEmail()
    {
        $this->validate([
            'email' => 'required|email'
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->email = $this->email;
        $user->save();
        session()->flash('successEmail', 'Change Email Addresss Successfully');
        return redirect()->back();
    }

    public function changePassword()
    {
        // $this->validate([
        //     'currentPassword' => 'required',
        //     'newPassword' => 'required|confirmed|min:8',
        // ]);

        $user = User::findOrFail(Auth::user()->id);
        if (Hash::check($this->currentPassword, $user->password)) {
            $user->update([
                'password' => Hash::make($this->newPassword),
            ]);
            session()->flash('successPassword', 'Change Password Successfully');
            $user->logout();
        }
        return redirect()->back();
    }

    public function changePhoto()
    {
        $this->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = User::findOrFail(Auth::user()->id);
        if ($this->avatar) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = $this->avatar->store('images/users', 'public');
        }
        $user->save();
        session()->flash('successPhoto', 'Change Photo Successfully');
        return redirect()->back();
    }


    public function render()
    {
        return view('livewire.setting');
    }
}
