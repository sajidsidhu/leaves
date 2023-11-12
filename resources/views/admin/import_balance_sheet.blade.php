<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md py-4 px-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('import.balance') }}" enctype="multipart/form-data">
                @csrf

        <div class="mt-4">
            <x-input-label for="year" :value="__('Year')" />
            <select id="year" class="block mt-1 w-full form-controll border-gray-300 rounded-md " name="year">
                @for($i = date('Y'); $i > 2010; $i--)
                <option>{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mt-4">
            <x-input-label for="balance_sheet" :value="__('Choose Balance Sheet')" />
            <input id="balance_sheet" class="block mt-1 w-full" type="file" name="balance_sheet" />
            <x-input-error :messages="$errors->get('balance_sheet')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="leave_availed" :value="__('Choose Availed Leave Sheet')" />
            <input id="leave_availed" class="block mt-1 w-full" type="file" name="leave_availed" />
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
