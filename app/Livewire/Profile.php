<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Livewire\Attributes\On;

class Profile extends Component
{
    public string $name = "";
    public string $email = "";
    public string $password = "";

    public bool $hidden_name = true;
    public bool $hidden_email = true;
    public bool $hidden_password = true;

    public function render()
    {
        return view('livewire.profile', [
            'user' => Auth::user()
        ]);
    }

    // Email field
    public function show_email()
    {
        $this->hidden_email = false;
    }

    public function hide_email()
    {
        $this->hidden_email = true;
    }

    // Name field
    public function show_name()
    {
        $this->hidden_name = false;
    }

    public function hide_name()
    {
        $this->hidden_name = true;
    }

    // Password field
    public function show_pass()
    {
        $this->hidden_password = false;
    }

    public function hide_pass()
    {
        $this->hidden_password = true;
    }

    public function updateData(string $email)
    {
        $user = User::where('email', $email)->first();

        $this->validate([
            'name' => ['string'],
            'email' => ["email:rfc,dns,spoof,filter,filter_unicode"],
            'password' => [RulesPassword::min(10)->letters()->mixedCase()->numbers()->symbols()->uncompromised(2)]
        ]);

        if (!empty($this->name)) {
            $user->name = $this->name;
            $user->save();
            $this->dispatch('name_updated');
        }

        if (!empty($this->email)) {
            $user->email = $this->email;
            $user->save();
            $this->dispatch('email_updated');
        }

        if (!empty($this->password)) {
            $this->password = Hash::make($this->password);
            $user->password = $this->password;
            $user->save();
            $this->dispatch('password_updated');
        }

        if (empty($this->name) && empty($this->email) && empty($this->password)) {
            $this->dispatch('empty_fields');
        }

        $this->name = "";
        $this->email = "";
        $this->password = "";

        return $this->dispatch('refreshing');
    }

    #[On('refreshing')]
    public function refreshComp()
    {
        return $this->redirectRoute('profile');
    }
}
