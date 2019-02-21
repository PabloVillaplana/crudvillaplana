@extends('layout')



@section('content')

    <div class="d-flex justify-content-between align-items-end">
        <h1 class="titulo">{{ $title }}</h1>
        <p style="padding-top: 87px;">
            <a href="{{route('users.create')}}" class="btn btn-primary">Nuevo Usuario</a>
        </p>
    </div>


    @if($users->isNotEmpty())
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        {{--<a href="{{url('/usuarios/'. $user->id)}}">Ver detalles</a>--}}
                        {{--                    <a href="{{url("/usuarios/{$user->id}")}}">Ver detalles</a>--}}
                        {{--<a href="{{action('UserController@details', ['id'=>$user->id])}}">Ver detalles</a>--}}
                        <form action="{{route('users.destroy', $user)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('delete')}}
                            <a href="{{route('users.show', $user)}}" class="btn btn-link"><span class="oi oi-eye"></span></a>
                            <a href="{{route('users.edit', $user)}}" class="btn btn-link"><span class="oi oi-pencil"></span></a>
                            <button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
                        </form><br>
                        {{--lo mejor de route--}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No hay USUARIOS REGISTRADOS</p>
    @endif

    {{--<ul>--}}
    {{--@forelse($users as $user)--}}
    {{--<li>--}}
    {{--{{ $user->name }}, ({{$user->email}})--}}
                {{--<a href="{{url('/usuarios/'. $user->id)}}">Ver detalles</a>--}}
                                    {{--<a href="{{url("/usuarios/{$user->id}")}}">Ver detalles</a>--}}
                {{--<a href="{{action('UserController@details', ['id'=>$user->id])}}">Ver detalles</a>--}}
                {{--<a href="{{route('users.show', $user)}}">Ver detalles</a>|--}}
                {{--<a href="{{route('users.edit', $user)}}">Editar</a>|--}}
                {{--<form action="{{route('users.destroy', $user)}}" method="post">--}}
                    {{--{{csrf_field()}}--}}
                    {{--{{method_field('delete')}}--}}
                    {{--<button type="submit">Eliminar</button>--}}
                {{--</form><br>--}}
                {{--lo mejor de route--}}
            {{--</li>--}}
        {{--@empty--}}
            {{--<li>No hay Usuarios Registrados</li>--}}
        {{--@endforelse--}}
    {{--</ul>--}}

@endsection

@section('sidebar')

    @parent

@endsection




