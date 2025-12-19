@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h2>Gestion des Logiciels</h2>
            <button class="btn-primary" onclick="openModal('add-software')">
                <i class="fas fa-plus"></i> Ajouter un logiciel
            </button>
        </div>
        <div class="software-grid" id="software-grid">
            <!-- Software cards -->
        </div>
    </section>
@endsection
