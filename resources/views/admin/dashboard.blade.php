@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Panel de administración</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bienvenido, {{ Auth::user()->name }}</h3>
                </div>
                <div class="card-body">
                    Has iniciado sesión correctamente.
                </div>
            </div>
        </div>
    </div>
@stop