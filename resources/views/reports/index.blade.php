@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>{{ $reportTitle }}</h1>
        </div>
        <div class="card-body">
            @if ($type === 'logiciels')
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Version</th>
                                <th>Description</th>
                                <th>Date d'Installation</th>
                                <th>Utilisateur Responsable</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $logiciel)
                                <tr>
                                    <td>{{ $logiciel->id_logiciel }}</td>
                                    <td>{{ $logiciel->nom }}</td>
                                    <td>{{ $logiciel->version }}</td>
                                    <td>{{ Str::limit($logiciel->description, 50) }}</td>
                                    <td>{{ $logiciel->date_installation ? \Carbon\Carbon::parse($logiciel->date_installation)->format('Y-m-d') : 'N/A' }}</td>
                                    <td>{{ $logiciel->utilisateur->nom ?? 'N/A' }} {{ $logiciel->utilisateur->prenom ?? '' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Aucun logiciel trouvé pour ce rapport.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @elseif ($type === 'licences')
                <div class="table-responsive">
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $licence)
                                <tr>
                                    <td>{{ $licence->id_licence }}</td>
                                    <td>{{ $licence->logiciel->nom ?? 'N/A' }}</td>
                                    <td>{{ $licence->cle_licence }}</td>
                                    <td>{{ \Carbon\Carbon::parse($licence->date_acquisition)->format('Y-m-d') }}</td>
                                    <td>{{ $licence->status }}</td>
                                    <td>{{ $licence->type_licence }}</td>
                                    <td>{{ $licence->contrat ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Aucune licence trouvée pour ce rapport.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @elseif ($type === 'utilisateurs')
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Rôle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $utilisateur)
                                <tr>
                                    <td>{{ $utilisateur->id_utilisateur }}</td>
                                    <td>{{ $utilisateur->nom }}</td>
                                    <td>{{ $utilisateur->prenom }}</td>
                                    <td>{{ $utilisateur->email }}</td>
                                    <td>{{ $utilisateur->role }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucun utilisateur trouvé pour ce rapport.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">Type de rapport non spécifié ou non valide.</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour au Tableau de bord</a>
            </div>
        </div>
    </div>
</div>
@endsection