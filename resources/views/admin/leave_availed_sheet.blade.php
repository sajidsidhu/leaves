<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Excels') }}
        </h2>
    </x-slot>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md py-4 px-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('import.availed') }}" enctype="multipart/form-data">
                @csrf
        <div>
            <x-input-label for="leave_availed" :value="__('Choose Availed Leave Sheet')" />
            <input id="leave_availed" class="block mt-1 w-full" type="file" name="leave_availed" required />
            <x-input-error :messages="$errors->get('leave_availed')" class="mt-2" />
        </div>
            <x-primary-button class="mt-4">
                {{ __('Upload') }}
            </x-primary-button>
        </div>
    </form>
            </div>
        </div>
</x-guest-layout>
