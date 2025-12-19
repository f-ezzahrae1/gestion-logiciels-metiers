@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Gestion des Logiciels</h1>
            <a href="{{ route('logiciels.create') }}" class="btn btn-primary">Ajouter un Logiciel</a>
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
                        <th>Version</th>
                        <th>Description</th>
                        <th>Date d'Installation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logiciels as $logiciel)
                        <tr>
                            <td>{{ $logiciel->id_logiciel }}</td>
                            <td>{{ $logiciel->nom }}</td>
                            <td>{{ $logiciel->version }}</td>
                            <td>{{ Str::limit($logiciel->description, 50) }}</td>
                            <td>{{ $logiciel->date_installation ? \Carbon\Carbon::parse($logiciel->date_installation)->format('Y-m-d') : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('logiciels.show', $logiciel->id_logiciel) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('logiciels.edit', $logiciel->id_logiciel) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('logiciels.destroy', $logiciel->id_logiciel) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce logiciel ?');">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Aucun logiciel trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection