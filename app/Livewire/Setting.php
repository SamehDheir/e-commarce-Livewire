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


    public $username;
    public $email;
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;
    public $avatar;

    public function mount()
    {
        $this->username = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function changeUserName()
    {
        $this->validate([
            'username' => 'required|min:2|max:15'
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $this->username;
        $user->save();
        // session()->flash('successUserName', 'Change Username Successfully');
        toastr()->success('Change Username Successfully', ['timeOut' => 2000]);

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
        // session()->flash('successEmail', 'Change Email Addresss Successfully');
        toastr()->success('Change Email Addresss Successfully', ['timeOut' => 2000]);

        return redirect()->back();
    }

    public function changePassword()
    {
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required:min:8',
        ]);

        if (!Hash::check($this->currentPassword, Auth::user()->password)) {
            $this->addError('currentPassword', 'The current password is incorrect.');
            return;
        } else {
            $user = User::findOrfail(Auth::user()->id);
            $user->update([
                'password' => Hash::make($this->newPassword),
            ]);
        }

        $this->currentPassword = '';
        $this->newPassword = '';
        $this->confirmPassword = '';

        // session()->flash('successPassword', 'Password changed successfully.');
        toastr()->success('Password changed successfully', ['timeOut' => 2000]);
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
        // session()->flash('successPhoto', 'Change Photo Successfully');
        toastr()->success('Change Photo Successfully', ['timeOut' => 2000]);

        return redirect()->back();
    }


    public function render()
    {
        return view('livewire.setting');
    }
}
