<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <title>Flame & Fragrance | Sign up</title>
</head>
<body>
    

    <div class="auth">
        <div class="left">
            <a href="/">Flame &<br> Fragrance</a>
        </div>

        <div class="right">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="head">
                    <span>Create New Account</span>
                    <span>Please enter your details</span>
                </div>

                <div class="body">
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"  placeholder="Full Name"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

        
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
        
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

        
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                    </div>
                <div class="foot">
               
                    <button type="submit">Register</button>
                    <span>Already have an account? <a href="{{ route('login') }}">Login</a></span>
                </div>
        
            </form>
        </div>
    </div>


</body>
</html>