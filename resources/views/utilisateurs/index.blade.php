@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Gestion des Utilisateurs</h1>
            <a href="{{ route('utilisateurs.create') }}" class="btn btn-primary">Ajouter un Utilisateur</a>
        </div>
        <div class="table-responsive">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($utilisateurs as $utilisateur)
                        <tr>
                            <td>{{ $utilisateur->id_utilisateur }}</td>
                            <td>{{ $utilisateur->nom }}</td>
                            <td>{{ $utilisateur->prenom }}</td>
                            <td>{{ $utilisateur->email }}</td>
                            <td>{{ $utilisateur->role }}</td>
                            <td>
                                <a href="{{ route('utilisateurs.show', $utilisateur->id_utilisateur) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('utilisateurs.edit', $utilisateur->id_utilisateur) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('utilisateurs.destroy', $utilisateur->id_utilisateur) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Aucun utilisateur trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection