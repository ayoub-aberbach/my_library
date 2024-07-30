<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Support\Str;

class Login extends Component
{
    public string $name = "";
    public string $email = "";
    public string $password = "";

    public string $user_email_name = "";
    public string $user_password = "";

    public $register_form = false;

    #[Layout("components.layouts.login-app")]
    public function render()
    {
        // if (count(User::get()) === 1) {
        //     $this->register_form = false;
        // }
        return view('livewire.login');
    }

    public function signupForm()
    {
        $this->register_form = true;
        $this->email = "";
        $this->password = "";
        $this->resetValidation();
    }

    public function loginForm()
    {
        $this->register_form = false;

        $this->name = "";
        $this->email = "";
        $this->password = "";

        $this->user_email_name = "";
        $this->user_password = "";

        $this->resetValidation();
    }

    public function login()
    {

        $this->validate([
            "user_email_name" => ['required', 'string'],
            "user_password" => ['required']
        ]);

        $user_by_email = Auth::attempt(
            [
                "email" => $this->user_email_name,
                'password' => $this->user_password
            ]
        );

        $user_by_name = Auth::attempt(
            [
                "name" => $this->user_email_name,
                'password' => $this->user_password
            ]
        );

        if ($user_by_email || $user_by_name) {
            $this->resetErrorBag();
            return redirect()->route("dashboard");
        } else {
            $this->resetErrorBag();
            return $this->dispatch("not_authorized");
        }

        $this->user_email_name = "";
        $this->user_password = "";
    }

    public function signup()
    {
        $this->validate(
            [
                "name" => ['required', 'string', "unique:users"],
                "email" => ["required", "email:rfc,dns,spoof,filter,filter_unicode", "unique:users"],
                "password" => ['required', RulesPassword::min(10)->letters()->mixedCase()->numbers()->symbols()->uncompromised(2)],
            ]
        );

        $this->password = Hash::make($this->password);

        $userReg = User::create(
            [
                'id' => Str::uuid(),
                'name' => $this->name,
                "email" => $this->email,
                'password' => $this->password
            ]
        );

        if ($userReg) {
            $this->resetErrorBag();
            return redirect()->route('login');
        } else {
            $this->resetErrorBag();
            return;
        }

        $this->name = "";
        $this->email = "";
        $this->password = "";
    }
}
