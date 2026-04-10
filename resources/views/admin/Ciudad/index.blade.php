@extends('adminlte::page')

@section('title', 'Ciudades')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-city mr-2"></i>Ciudades</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Ciudades</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-outline {{ isset($ciudad) ? 'card-warning' : 'card-primary' }}">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas {{ isset($ciudad) ? 'fa-edit' : 'fa-plus' }} mr-1"></i>
                            {{ isset($ciudad) ? 'Editar Ciudad' : 'Nueva Ciudad' }}
                        </h3>
                    </div>

                    <form action="{{ isset($ciudad) ? route('admin.ciudad.update', $ciudad->id) : route('admin.ciudad.store') }}" method="POST">
                        @csrf
                        @if(isset($ciudad)) @method('PUT') @endif

                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $ciudad->nombre ?? '') }}" required>
                                @error('nombre') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="codigo_postal">Código Postal <span class="text-danger">*</span></label>
                                <input type="text" name="codigo_postal" id="codigo_postal" class="form-control @error('codigo_postal') is-invalid @enderror" value="{{ old('codigo_postal', $ciudad->codigo_postal ?? '') }}" required>
                                @error('codigo_postal') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn {{ isset($ciudad) ? 'btn-warning' : 'btn-primary' }} btn-block">
                                <i class="fas fa-save mr-1"></i> {{ isset($ciudad) ? 'Guardar' : 'Actualizar' }}
                            </button>
                            @if(isset($ciudad))
                                <a href="{{ route('admin.ciudad.index') }}" class="btn btn-secondary btn-block mt-2">Cancelar</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-list mr-1"></i> Listado</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-hover m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Cod. Postal</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ciudades as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nombre }}</td>
                                        <td><code>{{ $item->codigo_postal }}</code></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.ciudad.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('admin.ciudad.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection