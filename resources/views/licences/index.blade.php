@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Gestion des Licences</h1>
            <a href="{{ route('licences.create') }}" class="btn btn-primary">Ajouter une Licence</a>
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
                        <th>Logiciel</th>
                        <th>Clé Licence</th>
                        <th>Date Acquisition</th>
                        <th>Statut</th>
                        <th>Type Licence</th>
                        <th>Contrat</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($licences as $licence)
                        <tr>
                            <td>{{ $licence->id_licence }}</td>
                            <td>{{ $licence->logiciel->nom ?? 'N/A' }}</td>
                            <td>{{ $licence->cle_licence }}</td>
                            <td>{{ \Carbon\Carbon::parse($licence->date_acquisition)->format('Y-m-d') }}</td>
                            <td>{{ $licence->status }}</td>
                            <td>{{ $licence->type_licence }}</td>
                            <td>{{ $licence->contrat ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('licences.show', $licence->id_licence) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('licences.edit', $licence->id_licence) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('licences.destroy', $licence->id_licence) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette licence ?');">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Aucune licence trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection