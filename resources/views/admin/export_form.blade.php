<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md py-4 px-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('export.pdf') }}" enctype="multipart/form-data">
                @csrf

        <div class="mt-4">
            <x-input-label for="month" :value="__('Month')" />
            <select id="month" class="block mt-1 w-full form-controll border-gray-300 rounded-md " name="month">
                @for($i = 1; $i <= 12; $i++)
                <option>{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mt-4">
            <x-input-label for="year" :value="__('Year')" />
            <select id="year" class="block mt-1 w-full form-controll border-gray-300 rounded-md " name="year">
                @foreach($years as $year)
                    @if($year->year > 2000)
                <option>{{$year->year}}</option>
                @endif
                @endforeach
            </select>
        </div>
            <x-primary-button class="mt-4">
                {{ __('Generate PDF') }}
            </x-primary-button>
        </div>
    </form>
    <?php
        $page = request()->page??0;
        $sr = 1 + (($page > 0?$page-1:0) * 10);
    ?>
    <table class="table w-full border">
                        <tr>
                            <th>Sr</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        @foreach($files as $f)
                            <tr>
                                <td>{{$sr++}}</td>
                                <td>{{$f->path}}</td>
                                <td>
                                    <a href="{{route('zip.download',['path'=>$f->path])}}" class="btn btn-md">Download</a> 
                                </td>
                            </tr>
                        @endforeach
                    </table>
                {{$files->links()}}
            </div>
        </div>
</x-guest-layout>
