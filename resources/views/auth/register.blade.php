<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="register-form" enctype="multipart/form-data">
        @csrf

        <div class="mt-4">
            <x-input-label for="image" :value="__('Profile Picture')" />
            <input id="image" type="file" name="image" accept="image/*" class="dark:text-white" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Lastname -->
        <div>
            <x-input-label for="lastname" :value="__('Lastname')" />
            <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
        </div>

        <!-- birth date -->
        <div>
            <x-input-label for="birth_date" :value="__('Birth Date')" />
            <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" required autofocus autocomplete="birth_date" />
            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input onkeyup='check();' id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input onkeyup='check();' id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="ml-4" id="register-btn" type="button">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        const check = () => { //.style.backgroundColor = "red";
            let pwConfirm = document.getElementById('password_confirmation')
            let pw = document.getElementById('password');
        if (pw.value == pwConfirm.value) {
            pwConfirm.style.backgroundColor = "green";
        } else {
            pwConfirm.style.backgroundColor = "red";
        }
    }
    document.querySelector("#register-btn").addEventListener('click', () => {
        let pwConfirm = document.getElementById('password_confirmation')
        let pw = document.getElementById('password');
        if (pw.value == pwConfirm.value) {
            document.getElementById('register-form').submit();
        }
    })
    </script>
</x-guest-layout>
