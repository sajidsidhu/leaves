<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md py-4 px-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('update.user') }}">
                @csrf
            <input type="hidden" name="id" value="{{$user->id}}"/>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="{{$user->name}}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="type" :value="__('User Type')" />
            <select id="type" class="block mt-1 w-full form-controll border-gray-300 rounded-md " name="type">
                <option {{$user->type == "Super Admin" ? "selected":""}}>Super Admin</option>
                <option {{$user->type == "Admin" ? "selected":""}}>Admin</option>
            </select>
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="{{$user->phone}}" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="{{$user->email}}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password (add only if you wants to change)')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            placeholder=""/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

            <x-primary-button class="ml-4">
                {{ __('Update User') }}
            </x-primary-button>
        </div>
    </form>
            </div>
        </div>
</x-guest-layout>
