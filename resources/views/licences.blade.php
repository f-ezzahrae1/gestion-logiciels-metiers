@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h2>Gestion des Licences</h2>
            <button class="btn-primary" onclick="openModal('add-license')">
                <i class="fas fa-plus"></i> Nouvelle licence
            </button>
        </div>
        <div class="license-table-container">
            <table class="license-table">
                <thead>
                    <tr>
                        <th>Logiciel</th>
                        <th>Clé de licence</th>
                        <th>Date d'expiration</th>
                        <th>Utilisateur</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="license-tbody"></tbody>
            </table>
        </div>
    </section>
@endsection
