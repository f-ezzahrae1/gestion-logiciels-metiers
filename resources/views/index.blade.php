<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Logiciels Métiers</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <i class="fas fa-cogs"></i>
                <span>LogicielsMétiers</span>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#dashboard" class="nav-link active">Tableau de bord</a>
                </li>
                <li class="nav-item">
                    <a href="#logiciels" class="nav-link">Logiciels</a>
                </li>
                <li class="nav-item">
                    <a href="#licences" class="nav-link">Licences</a>
                </li>
                <li class="nav-item">
                    <a href="#utilisateurs" class="nav-link">Utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a href="#rapports" class="nav-link">Rapports</a>
                </li>
            </ul>
            <div class="nav-profile">
                <img src="images/avatar.jpg" alt="Profile" class="profile-img">
                <span class="profile-name">Admin</span>
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Dashboard Section -->
        <section id="dashboard" class="dashboard-section">
            <div class="dashboard-header">
                <h1>Tableau de bord</h1>
                <p>Vue d'ensemble de vos logiciels métiers</p>
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
                    <button class="action-btn" onclick="openModal('add-software')">
                        <i class="fas fa-plus"></i>
                        <span>Ajouter un logiciel</span>
                    </button>
                    <button class="action-btn" onclick="openModal('add-license')">
                        <i class="fas fa-key"></i>
                        <span>Nouvelle licence</span>
                    </button>
                    <button class="action-btn" onclick="openModal('add-user')">
                        <i class="fas fa-user-plus"></i>
                        <span>Ajouter utilisateur</span>
                    </button>
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

        <!-- Logiciels Section -->
        <section id="logiciels" class="section hidden">
            <div class="section-header">
                <h2>Gestion des Logiciels</h2>
                <button class="btn-primary" onclick="openModal('add-software')">
                    <i class="fas fa-plus"></i> Ajouter un logiciel
                </button>
            </div>
            <div class="software-grid" id="software-grid">
                <!-- Software cards will be loaded here -->
            </div>
        </section>

        <!-- Licences Section -->
        <section id="licences" class="section hidden">
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
                    <tbody id="license-tbody">
                        <!-- License data will be loaded here -->
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Utilisateurs Section -->
        <section id="utilisateurs" class="section hidden">
            <div class="section-header">
                <h2>Gestion des Utilisateurs</h2>
                <button class="btn-primary" onclick="openModal('add-user')">
                    <i class="fas fa-plus"></i> Ajouter utilisateur
                </button>
            </div>
            <div class="users-grid" id="users-grid">
                <!-- User cards will be loaded here -->
            </div>
        </section>

        <!-- Rapports Section -->
        <section id="rapports" class="section hidden">
            <div class="section-header">
                <h2>Rapports et Analyses</h2>
                <button class="btn-primary" onclick="generateReport()">
                    <i class="fas fa-download"></i> Exporter rapport
                </button>
            </div>
            <div class="reports-container">
                <div class="report-card">
                    <h3>Utilisation des logiciels</h3>
                    <canvas id="software-usage-chart"></canvas>
                </div>
                <div class="report-card">
                    <h3>Licences par statut</h3>
                    <canvas id="license-status-chart"></canvas>
                </div>
            </div>
        </section>
    </main>

    <!-- Modals -->
    <div id="modal-overlay" class="modal-overlay hidden">
        <div class="modal">
            <div class="modal-header">
                <h3 id="modal-title">Titre du modal</h3>
                <button class="modal-close" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                <!-- Modal content will be loaded here -->
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>