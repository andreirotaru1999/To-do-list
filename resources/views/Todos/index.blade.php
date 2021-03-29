@extends('todos.layout')

@section('content')

<div class ="flex justify-between border-b pb-4 px-2">
    <h1 class="text-2xl">All your todos</h1>
    <a href="/todos/create" class="mx-5 py-2 text-blue-400 cursor pointer text-white"    >
    <span class="fas fa-plus-circle" />
    </a>
</div>
    <ul class="my-5">
        <x-alert />
        @foreach($todos as $todo)
        <li class="flex justify-between p-2 ">
            @if($todo->completed)
            <p class="line-through">{{$todo->title}}</p>
            @else
            <p>{{$todo->title}}</p>
            @endif
            <div>
                
                <a href="{{'/todos/'.$todo->id.'/edit'}}" class=" text-yellow-400 cursor pointer text-white">
                <span class="fas fa-edit  px-2"></a>
                @include('todos.CompleteButton')
            </div>
        </li>
        @endforeach
    </ul>
@endsection




