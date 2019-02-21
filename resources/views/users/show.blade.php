
@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')
            <h1 class="titulo">Usuario # {{ $user->id}}</h1>

            <p>Nombre del usuario: {{$user->name}}</p>
            <p>Nombre del usuario: {{$user->email}}</p>

    <p>
         <a href="{{url('/usuarios')}}">Regresar al listado de usuarios</a>
         {{--<a href="{{action('UserController@index')}}">Regresar al listado de usuarioa</a>--}}

        {{--<a href="{{url()->previous()}}">Regresar</a>--}}
    </p>

@endsection


