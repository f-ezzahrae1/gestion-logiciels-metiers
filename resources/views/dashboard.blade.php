@extends('layouts.app')

@section('content')
    <section class="dashboard-section">
        <div class="dashboard-header">
            <h1>Tableau de bord</h1>
            <p>Vue d'ensemble de vos logiciels métiers</p>
        </div>
        {{-- الكود ديال tableau de bord اللي كان عندك --}}
         </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="stat-content">
                        <h3>24</h3>
                        <p>Logiciels actifs</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <div class="stat-content">
                        <h3>156</h3>
                        <p>Licences valides</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3>89</h3>
                        <p>Utilisateurs</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stat-content">
                        <h3>3</h3>
                        <p>Licences expirées</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h2>Actions rapides</h2>
                <div class="actions-grid">
                    <a href="{{ route('logiciels.create') }}" class="action-btn">
                        <i class="fas fa-plus"></i>
                        <span>Ajouter un logiciel</span>
                    </a>
                    <a href="{{ route('licences.create') }}" class="action-btn">
                        <i class="fas fa-key"></i>
                        <span>Nouvelle licence</span>
                    </a>
                    <a href="{{ route('utilisateurs.create') }}" class="action-btn">
                        <i class="fas fa-user-plus"></i>
                        <span>Ajouter utilisateur</span>
                    </a>
                    <button class="action-btn" onclick="generateReport()">
                        <i class="fas fa-chart-bar"></i>
                        <span>Générer rapport</span>
                    </button>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="recent-activity">
                <h2>Activité récente</h2>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Nouveau logiciel ajouté</h4>
                            <p>Adobe Creative Suite 2024 a été ajouté au système</p>
                            <span class="activity-time">Il y a 2 heures</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Nouvel utilisateur</h4>
                            <p>Marie Dupont a été ajoutée comme utilisateur</p>
                            <span class="activity-time">Il y a 4 heures</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Licence expirée</h4>
                            <p>La licence de Microsoft Office expire dans 7 jours</p>
                            <span class="activity-time">Il y a 1 jour</span>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection