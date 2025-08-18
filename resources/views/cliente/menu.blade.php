@extends('layouts.app')

@section('title', 'Menú de Clientes')

@section('content')
    <div class="text-center mb-5">
        <h1 class="display-4 mb-4">Gestión de Clientes</h1>
        <p class="lead text-muted">Seleccione la acción que desea realizar</p>
    </div>

    <div class="row justify-content-center g-4">
        {{-- Registrar Nuevo Cliente --}}
        <div class="col-md-5 mb-4">
            <div class="custom-card h-100 bg-dark text-white d-flex flex-column">
                <div class="card-body text-center d-flex flex-column">
                    <div class="system-icon mb-4">
                        <i class="fas fa-user-plus fa-4x text-primary"></i>
                    </div>
                    <h3 class="card-title mb-3">Registrar Nuevo Cliente</h3>
                    <p class="card-text flex-grow-1">Añada un nuevo cliente al sistema con toda su información.</p>
                    <a href="{{ route('cliente.create') }}" class="btn btn-primary btn-lg mt-auto">Acceder</a>
                </div>
            </div>
        </div>

        {{-- Lista de Clientes --}}
        <div class="col-md-5 mb-4">
            <div class="custom-card h-100 bg-dark text-white d-flex flex-column">
                <div class="card-body text-center d-flex flex-column">
                    <div class="system-icon mb-4">
                        <i class="fas fa-users fa-4x text-info"></i>
                    </div>
                    <h3 class="card-title mb-3">Lista de Clientes</h3>
                    <p class="card-text flex-grow-1">Visualice, edite o elimine los clientes existentes.</p>
                    <a href="{{ route('cliente.index') }}" class="btn btn-info btn-lg mt-auto">Acceder</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('welcome') }}" class="btn btn-outline-secondary btn-lg">
            <i class="fas fa-arrow-left me-2"></i> Volver al Menú Principal
        </a>
    </div>


@endsection
