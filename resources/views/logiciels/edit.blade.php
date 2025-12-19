@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Modifier un Logiciel</h1>
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

            <form action="{{ route('logiciels.update', $logiciel->id_logiciel) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nom">Nom du Logiciel:</label>
                    <input type="text" name="nom" id="nom" class="form-control" 
                           value="{{ old('nom', $logiciel->nom) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="version">Version:</label>
                    <input type="text" name="version" id="version" class="form-control" 
                           value="{{ old('version', $logiciel->version) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" rows="4" 
                              class="form-control">{{ old('description', $logiciel->description) }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="date_installation">Date d'Installation:</label>
                    <input type="date" name="date_installation" id="date_installation" class="form-control" 
                           value="{{ old('date_installation', $logiciel->date_installation ? \Carbon\Carbon::parse($logiciel->date_installation)->format('Y-m-d') : '') }}">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning me-2">Mettre à jour</button>
                    <a href="{{ route('logiciels.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
