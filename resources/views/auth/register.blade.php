<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contact -->
        <div class="mt-4">
            <x-input-label for="contact" :value="__('Contact')" />
            <x-text-input id="contact" class="block mt-1 w-full" type="text" name="contact" :value="old('contact')" required />
            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender" class="block mt-1 w-full" required>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- House No -->
        <div class="mt-4">
            <x-input-label for="houseNo" :value="__('House No')" />
            <x-text-input id="houseNo" class="block mt-1 w-full" type="text" name="houseNo" :value="old('houseNo')" required />
            <x-input-error :messages="$errors->get('houseNo')" class="mt-2" />
        </div>

        <!-- Street Name -->
        <div class="mt-4">
            <x-input-label for="streetName" :value="__('Street Name')" />
            <x-text-input id="streetName" class="block mt-1 w-full" type="text" name="streetName" :value="old('streetName')" required />
            <x-input-error :messages="$errors->get('streetName')" class="mt-2" />
        </div>

        <!-- City -->
        <div class="mt-4">
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <!-- Postal Code -->
        <div class="mt-4">
            <x-input-label for="postalCode" :value="__('Postal Code')" />
            <x-text-input id="postalCode" class="block mt-1 w-full" type="text" name="postalCode" :value="old('postalCode')" required />
            <x-input-error :messages="$errors->get('postalCode')" class="mt-2" />
        </div>

        <!-- Image URL -->
        <div class="mt-4">
            <x-input-label for="image" :value="__('Image URL')" />
            <x-text-input id="image" class="block mt-1 w-full" type="text" name="image" :value="old('image')" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
