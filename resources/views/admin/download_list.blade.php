<x-app-layout>
<style>
        td{
            text-align: center;
        }
</style>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Download List Zip\'s') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <?php
        $page = request()->page??0;
        $sr = 1 + (($page > 0?$page-1:0) * 10);
    ?>
    <table class="table w-full border mb-4">
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
        </div>
</x-guest-layout>
