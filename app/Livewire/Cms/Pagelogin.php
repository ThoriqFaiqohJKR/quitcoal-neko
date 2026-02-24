<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;

class Pagelogin extends Component
{
    public string $email = '';
    public string $password = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function mount()
    {
        if (session()->has('account_id')) {
            return redirect('/' . app()->getLocale() . '/cms');
        }
    }

    public function login()
    {
        $this->validate();

        $throttleKey = Str::lower($this->email) . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->addError('email', "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik.");
            return;
        }

        $user = DB::table('accounts')
            ->where('email', $this->email)
            ->first();

        if (!$user) {
            $this->addError('email', 'Email tidak ditemukan.');
            return;
        }

        if (!Hash::check($this->password, $user->password)) {
            $this->addError('password', 'Password salah.');
            return;
        }

        RateLimiter::clear($throttleKey);

        session()->regenerate();

        Session::put('account_id', $user->id);
        Session::put('account_role', $user->role);

        return redirect('/' . app()->getLocale() . '/cms');
    }

    public function render()
    {
        return view('livewire.cms.pagelogin');
    }
}