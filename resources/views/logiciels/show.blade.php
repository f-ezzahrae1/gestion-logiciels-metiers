@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Détails du Logiciel</h1>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong> {{ $logiciel->id_logiciel }}
            </div>
            <div class="mb-3">
                <strong>Nom:</strong> {{ $logiciel->nom }}
            </div>
            <div class="mb-3">
                <strong>Version:</strong> {{ $logiciel->version }}
            </div>
            <div class="mb-3">
                <strong>Description:</strong> {{ $logiciel->description ?? 'N/A' }}
            </div>
            <div class="mb-3">
                <strong>Date d'Installation:</strong> {{ $logiciel->date_installation ? \Carbon\Carbon::parse($logiciel->date_installation)->format('Y-m-d') : 'N/A' }}
            </div>
            <div class="mt-4">
                <a href="{{ route('logiciels.index') }}" class="btn btn-primary">Retour à la liste</a>
            </div>
        </div>
    </div>
</div>
@endsection