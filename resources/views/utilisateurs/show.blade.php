@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Détails de l'Utilisateur</h1>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong> {{ $utilisateur->id_utilisateur }}
            </div>
            <div class="mb-3">
                <strong>Nom:</strong> {{ $utilisateur->nom }}
            </div>
            <div class="mb-3">
                <strong>Prénom:</strong> {{ $utilisateur->prenom }}
            </div>
            <div class="mb-3">
                <strong>Email:</strong> {{ $utilisateur->email }}
            </div>
            <div class="mb-3">
                <strong>Rôle:</strong> {{ $utilisateur->role }}
            </div>
            <div class="mt-4">
                <a href="{{ route('utilisateurs.index') }}" class="btn btn-primary">Retour à la liste</a>
            </div>
        </div>
    </div>
</div>
@endsection