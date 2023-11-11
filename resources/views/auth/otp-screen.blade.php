<x-guest-layout>
<div class="mb-4 text-sm text-gray-600">
    Please Add OTP sent on your email: {{old('email',session('email'))}}
</div>
    <form method="GET" action="{{ route('password.reset') }}">
        @csrf

        <input type="hidden" name="email"  value="{{ old('email',session('email')) }}">

        <!-- Email Address -->
        <!-- <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" value="{{session('email')}}" readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> -->

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="otp" :value="__('OTP')" />
            <x-text-input id="otp" class="block mt-1 w-full" type="number" name="otp" required />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>
        
        <div class="flex items-center justify-end mt-4">
            <a href="{{route('otp.resend').'?email='.old('email',session('email'))}}" style="flex:auto; text-decoration:underline;">resend OTP</a>
            <x-primary-button>
                {{ __('Confirm & Next') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
