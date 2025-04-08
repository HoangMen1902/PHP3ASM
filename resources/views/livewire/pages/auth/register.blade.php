<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $phone = '';
    public int $status = 0;
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:10'],
            'status' => ['required', 'int', 'max:1']

        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        $this->redirect(route('login'));
    }
}; ?>



<div>
    <style>
        body {
            color: #f5f5f5 !important font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100vw;
            margin: 0;
            overflow: hidden;
        }

        .auth-wrapper {
            margin: 0 auto;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
        }

        .auth-image {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;

            img {
                width: 300px;
                height: 250px;
            }
        }

        .auth-container {
            width: 100%;
            background-color: #f5f5f5 !important width: 45%;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-input {
            width: 100%;
            padding: 1rem;
            margin: 0.75rem 0;
            border: 2px solid #f5f5f5;
            background: transparent;
            color: #FFD700;
            border-radius: 5px;
            font-size: 1.1rem;
            transition: border-color 0.3s;
            margin-bottom: 10px;
        }

        .auth-input:focus {

            outline: none;
        }

        .auth-button {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .auth-button:hover {
            background: #e6c300;
            transform: scale(1.05);
        }

        .auth-google {
            margin: 0 auto;
            text-align: center;
            border-radius: 50%;
            padding: 1rem;
            background: #fff;
            color: #111;
            border: none;

            font-size: 1.1rem;
            cursor: pointer;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: background 0.3s, transform 0.2s;
        }

        .auth-google:hover {
            background: #f5f5f5;
            transform: scale(1.05);
        }

        .auth-link {
            display: block;
            text-align: center;
            color: #FFD700;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .auth-link:hover {
            color: #e6c300;
            text-decoration: underline;
        }

        .auth-content {
            width: 30%;
            justify-content: space-between;
            align-items: center;
            margin: 0 auto;

        }

        .auth-label {
            color: #f5f5f5 font-size: 1.1rem;
            font-weight: bold;
            text-align: left;
        }

        .ready {
            text-align: center;
            color: #c5c5c5
        }

        .ready:hover {
            color: gray;
        }

        .link-ctrl {
            text-align: center
        }

        .form-input-line {
            display: flex;
            justify-content: space-between
        }

        .input-container {
            width: 49%;
        }
    </style>
    </head>

    <body>
        <div class="auth-wrapper  bg-gray-800">
            <div class="auth-content">
                <div class="auth-image"><img src="assets/img/Hanover2.png" alt="">
                    <h2 style="font-size: xx-large;color:#f5f5f5; font-weight: bolder; margin-bottom:20px;"
                        class="text-center">Bamesa Barbershop</h2>
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                </div>
                <div class="auth-container">

                    <form wire:submit="register">


                        <label style="color: #f5f5f5" class="auth-label" for="name">Name: </label>
                        <x-text-input wire:model="name" id="name" class="auth-input" type="text" name="name" required
                            autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                        <div class="form-input-line">
                            <!-- Email Address -->
                            <div class="input-container">
                                <label style="color: #f5f5f5" class="auth-label" for="email">Email: </label>
                                <x-text-input wire:model="email" id="email" class="auth-input" type="email" name="email"
                                    required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="input-container">
                                <label style="color: #f5f5f5" class="auth-label" for="phone">Phone: </label>
                                <x-text-input wire:model="phone" id="phone" class="auth-input" type="tel" name="phone"
                                    required />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="form-input-line">
                            <div class="input-container">
                                <label style="color: #f5f5f5" class="auth-label" for="password">Password: </label>

                                <x-text-input wire:model="password" id="password" class="auth-input" type="password"
                                    name="password" required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="input-container">
                                <label style="color: #f5f5f5" class="auth-label" for="password_confirmation">Confirm
                                    password: </label>

                                <x-text-input wire:model="password_confirmation" id="password_confirmation"
                                    class="auth-input" type="password" name="password_confirmation" required
                                    autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                        <div class="auth-link">
                            

                            <x-primary-button style="color: rgb(17 24 39); text-align:center" class="auth-button my-2 bg-white">
                                {{ __('Register') }}
                            </x-primary-button>
                            <a class="ready" href="{{ route('login') }}" wire:navigate>
                                {{ __('Already registered?') }}
                            </a>
                        </div>

                    </form>

                </div>
            </div>

            @fluxScripts
        </div>
</div>