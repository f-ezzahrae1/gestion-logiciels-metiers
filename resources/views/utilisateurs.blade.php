@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h2>Gestion des Utilisateurs</h2>
            <button class="btn-primary" onclick="openModal('add-user')">
                <i class="fas fa-plus"></i> Ajouter utilisateur
            </button>
        </div>
        <div class="users-grid" id="users-grid">
            <!-- User cards -->
        </div>
    </section>
@endsection
