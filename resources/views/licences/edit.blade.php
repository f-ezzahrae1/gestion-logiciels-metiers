@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Modifier une Licence</h1>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Il y a eu des problèmes avec votre entrée.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('licences.update', $licence->id_licence) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
    <label for="id_utilisateur">Utilisateur:</label>
    <select name="id_utilisateur" id="id_utilisateur" class="form-control" required>
        <option value="">Sélectionner un utilisateur</option>
        @foreach ($utilisateurs as $u)
           <option value="{{ $u->id_utilisateur }}" 
            {{ old('id_utilisateur', $licence->id_utilisateur) == $u->id_utilisateur ? 'selected' : '' }}>
            {{ $u->nom }} {{ $u->prenom }}
            </option>

        @endforeach
    </select>
</div>
                <div class="form-group mb-3">
                    <label for="id_logiciel">Logiciel:</label>
                    <select name="id_logiciel" id="id_logiciel" class="form-control" required>
                        <option value="">Sélectionner un logiciel</option>
                        @foreach ($logiciels as $logiciel)
                            <option value="{{ $logiciel->id_logiciel }}" {{ old('id_logiciel', $licence->id_logiciel) == $logiciel->id_logiciel ? 'selected' : '' }}>{{ $logiciel->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="cle_licence">Clé de Licence:</label>
                    <input type="text" name="cle_licence" id="cle_licence" class="form-control" value="{{ old('cle_licence', $licence->cle_licence) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="date_acquisition">Date d'Acquisition:</label>
                    <input type="date" name="date_acquisition" id="date_acquisition" class="form-control" value="{{ old('date_acquisition', \Carbon\Carbon::parse($licence->date_acquisition)->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="status">Statut:</label>
                    <input type="text" name="status" id="status" class="form-control" value="{{ old('status', $licence->status) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="type_licence">Type de Licence:</label>
                    <input type="text" name="type_licence" id="type_licence" class="form-control" value="{{ old('type_licence', $licence->type_licence) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="contrat">Contrat:</label>
                    <textarea name="contrat" id="contrat" rows="4" class="form-control">{{ old('contrat', $licence->contrat) }}</textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning me-2">Mettre à jour</button>
                    <a href="{{ route('licences.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection