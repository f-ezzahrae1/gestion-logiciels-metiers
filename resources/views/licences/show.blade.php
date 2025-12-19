@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Détails de la Licence</h1>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong> {{ $licence->id_licence }}
            </div>
            <div class="mb-3">
                <strong>Logiciel:</strong> {{ $licence->logiciel->nom ?? 'N/A' }}
            </div>
            <div class="mb-3">
                <strong>Clé de Licence:</strong> {{ $licence->cle_licence }}
            </div>
            <div class="mb-3">
                <strong>Date d'Acquisition:</strong> {{ \Carbon\Carbon::parse($licence->date_acquisition)->format('Y-m-d') }}
            </div>
            <div class="mb-3">
                <strong>Statut:</strong> {{ $licence->status }}
            </div>
            <div class="mb-3">
                <strong>Type de Licence:</strong> {{ $licence->type_licence }}
            </div>
            <div class="mb-3">
                <strong>Contrat:</strong> {{ $licence->contrat ?? 'N/A' }}
            </div>
            <div class="mt-4">
                <a href="{{ route('licences.index') }}" class="btn btn-primary">Retour à la liste</a>
            </div>
        </div>
    </div>
</div>
@endsection