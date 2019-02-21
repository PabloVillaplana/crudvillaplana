

@extends('layout')



@section('content')

    <div class="card" style="margin-top: 150px">
        <h4 class="card-header">
            Crear Usuario
        </h4>
        <div class="card-body">
            @if ($errors->any())
                <div  class="alert alert-danger ">
                    <h6>Por Favor corrige los siguientes errores</h6>
                    @foreach($errors->all() as $errors)
                        <ul>
                            <li>{{$errors}}</li>
                        </ul>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{url('usuarios')}}">
                {!! csrf_field() !!}


                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Crear Usuario</button>
                <a href="{{url('usuarios')}}" class="btn btn-link" >Regresar al listado de usuarios</a>
            </form>
        </div>
    </div>


@endsection




