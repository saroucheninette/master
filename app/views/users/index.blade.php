@extends('layouts.master')
@section('topbar')

    <li><a href="index-2.html">Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@stop
@section('content')
    <b>user list</b>
     @foreach($users as $user)
        {{ $user->Alias }},
    @endforeach
@stop