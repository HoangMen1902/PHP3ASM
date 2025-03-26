<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    <style>
        body {

            color: #FFD700;
            font-family: 'Poppins', sans-serif;
            display: flex;  
            height: 100vh;
            width: 100vw;
            margin: 0;
            overflow: hidden;
        }

        .auth-wrapper {
            display: flex;
            height: 100vh;
            width: 100vw;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.6);
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
        }

        .auth-image {

            width: 55%;
            img{
                width: 100%;
                height: 100%;
            }
        }

        .auth-container {
            width: 45%;
            padding: 100px;
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
            border: 2px solid #FFD700;
            background: transparent;
            color: #FFD700;
            border-radius: 5px;
            font-size: 1.1rem;
            transition: border-color 0.3s;
            margin-bottom: 10px;
        }

        .auth-input:focus {
            border-color: #e6c300;
            outline: none;
        }

        .auth-button {
            width: 100%;
            padding: 1rem;
            background: #FFD700;
            color: #111;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .auth-button:hover {
            background: #e6c300;
            transform: scale(1.05);
        }

        .auth-google {
            width: 100%;
            padding: 1rem;
            background: #fff;
            color: #111;
            border: none;
            border-radius: 5px;
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
            margin-top: 1rem;
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
            width: 75%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
        }
        .auth-label{
            font-size: 1.1rem;
            font-weight: bold;
            text-align: left;
            margin-bottom: 10px !important;
        }
    </style>
</head>

<body>
    <x-auth-session-status class="text-center" :status="session('status')" />
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-image"><img src="assets/img/Hanover2.png" alt=""></div>
            <div class="auth-container">
                <h2 style="font-size: xx-large; font-weight: bolder; margin-bottom:20px;" class="text-center">Bamesa Register</h2>
                <form wire:submit="register">
                    <label class="auth-label" for="name">Fullname: </label>
                    <input class="auth-input" wire:model="name" :label="'Name'" type="text" required autofocus autocomplete="name"
                        :placeholder="'Full name'" />
                        <label class="auth-label" for="email">Email: </label>
                        <input class="auth-input" wire:model="email" :label="'Email address'" type="email" required
                        autocomplete="email" placeholder="email@example.com" />
                        
                        <label class="auth-label" for="phone">Phone: </label>
                        <input class="auth-input" wire:model="phone" :label="'Phone number'" type="tel" required
                        autocomplete="phone" placeholder="0987654321" />
                    <!-- Password -->
                    <label class="auth-label" for="password">Password: </label>
                    <input class="auth-input" wire:model="password" :label="'Password'" type="password" required
                        autocomplete="new-password" :placeholder="'Password'" />

                    <!-- Confirm Password -->
                    <label class="auth-label" for="confirm-password">Confirm password: </label>
                    <input class="auth-input" wire:model="password_confirmation" :label="'Confirm password'" type="password"
                        required autocomplete="new-password" :placeholder="'Confirm password'" />

                    <div class="flex items-center justify-end">
                        <button  class="auth-button" type="submit" variant="primary" class="w-full">
                            {{ __('Create account') }}
                        </button>
                    </div>
                </form>
                <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
                    {{ __('Already have an account?') }}
                    <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
                </div>
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>