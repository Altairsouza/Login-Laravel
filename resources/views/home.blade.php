@extends('layouts.app_layout')


@php
    use App\Classes\Enc; // as duas formas de usar
        $enc = new App\Classes\Enc();
@endphp



@section('conteudo')
    <div>
        <h3>
           LISTA DE USUÁRIOS
        </h3>
        <hr>
        <ul>
        @foreach ($usuarios as $user )
            <li><a href="{{route('main_edite', ['id_usuario'=>$enc->encriptar($user->id)])}}">EDIT</a> {{$user->usuario}}</li>

        @endforeach
        </ul>

    </div>


    <div>

        <h3>Upload de ficheiro</h3>
        <form action="{{route('main_upload')}}" method="post" enctype="multipart/form-data"> {{-- enctype ta avisando q vai ter ficheiro para donwload--}}
            @csrf
            <input type="file" name="ficheiro" >
            <input type="submit" value="Enviar">
        </form>
    </div>


    {{-- errors --}}


        @if ($errors->any())
        <div>
        <ul>
            @foreach ($errors->all() as $error )
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
@endsection
