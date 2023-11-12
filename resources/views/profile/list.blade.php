<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <table class="table w-full border">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->type}}</td>
                                <td>{{$user->active ? "Active":"Deactive"}}</td>
                                <td>
                                    <a href="{{route('user.status.update',['id'=>$user->id,'status'=>($user->active ? 0:1)])}}" class="btn btn-md">{{$user->active ? "Deactive":"Active"}}</a> 
                                    <a href="{{route('user.edit',['id'=>$user->id])}}" class="btn btn-md">Edit</a> 
                                </td>
                            </tr>
                        @endforeach
                    </table>
                {{$users->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
