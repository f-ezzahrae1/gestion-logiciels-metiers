// Données simulées pour l'application
const mockData = {
    software: [
        {
            id: 1,
            name: "Adobe Creative Suite 2024",
            version: "24.0.1",
            category: "Design",
            status: "active",
            licenses: 15,
            used: 12,
            icon: "fas fa-palette"
        },
        {
            id: 2,
            name: "Microsoft Office 365",
            version: "2024",
            category: "Productivité",
            status: "active",
            licenses: 50,
            used: 45,
            icon: "fas fa-file-word"
        },
        {
            id: 3,
            name: "Visual Studio Code",
            version: "1.85.0",
            category: "Développement",
            status: "active",
            licenses: 30,
            used: 28,
            icon: "fas fa-code"
        },
        {
            id: 4,
            name: "AutoCAD 2024",
            version: "24.0",
            category: "CAO/DAO",
            status: "warning",
            licenses: 10,
            used: 10,
            icon: "fas fa-drafting-compass"
        },
        {
            id: 5,
            name: "SAP Business One",
            version: "10.0",
            category: "ERP",
            status: "active",
            licenses: 25,
            used: 20,
            icon: "fas fa-chart-line"
        },
        {
            id: 6,
            name: "SolidWorks 2024",
            version: "24.0",
            category: "CAO/DAO",
            status: "expired",
            licenses: 8,
            used: 8,
            icon: "fas fa-cube"
        }
    ],
    licenses: [
        {
            id: 1,
            software: "Adobe Creative Suite 2024",
            key: "ADOBE-2024-XXXX-YYYY-ZZZZ",
            expiration: "2024-12-31",
            user: "Jean Dupont",
            status: "active"
        },
        {
            id: 2,
            software: "Microsoft Office 365",
            key: "MS-365-XXXX-YYYY-ZZZZ",
            expiration: "2024-06-30",
            user: "Marie Martin",
            status: "warning"
        },
        {
            id: 3,
            software: "Visual Studio Code",
            key: "VS-CODE-XXXX-YYYY",
            expiration: "2025-12-31",
            user: "Pierre Durand",
            status: "active"
        },
        {
            id: 4,
            software: "AutoCAD 2024",
            key: "AUTO-2024-XXXX-YYYY",
            expiration: "2024-03-15",
            user: "Sophie Bernard",
            status: "expired"
        }
    ],
    users: [
        {
            id: 1,
            name: "Jean Dupont",
            email: "jean.dupont@entreprise.com",
            department: "Design",
            role: "Designer",
            status: "active",
            avatar: "images/avatar1.jpg"
        },
        {
            id: 2,
            name: "Marie Martin",
            email: "marie.martin@entreprise.com",
            department: "Administration",
            role: "Assistante",
            status: "active",
            avatar: "images/avatar2.jpg"
        },
        {
            id: 3,
            name: "Pierre Durand",
            email: "pierre.durand@entreprise.com",
            department: "IT",
            role: "Développeur",
            status: "active",
            avatar: "images/avatar3.jpg"
        },
        {
            id: 4,
            name: "Sophie Bernard",
            email: "sophie.bernard@entreprise.com",
            department: "Ingénierie",
            role: "Ingénieur",
            status: "inactive",
            avatar: "images/avatar4.jpg"
        }
    ]
};

// Gestion de la navigation
document.addEventListener('DOMContentLoaded', function() {
    initializeNavigation();
    loadDashboardData();
    initializeCharts();

// Function for generating reports
    window.generateReport = function() {
        let reportType = prompt("Sur quoi voulez-vous ce rapport ? (logiciels, licences, ou utilisateurs)");
        reportType = reportType ? reportType.toLowerCase() : null;

        if (reportType === 'logiciels' || reportType === 'licences' || reportType === 'utilisateurs') {
            window.location.href = `/rapports/${reportType}`;
        } else if (reportType !== null) {
            alert("Type de rapport non valide. Veuillez choisir 'logiciels', 'licences', ou 'utilisateurs'.");
        }
    };

    // Function for exporting reports
    window.exportReport = function() {
        let exportType = prompt("Quel type de rapport souhaitez-vous exporter ? (logiciels, licences, ou utilisateurs)");
        exportType = exportType ? exportType.toLowerCase() : null;

        if (exportType === 'logiciels' || exportType === 'licences' || exportType === 'utilisateurs') {
            window.location.href = `/export-rapports/${exportType}`;
        } else if (exportType !== null) {
            alert("Type d'exportation non valide. Veuillez choisir 'logiciels', 'licences', ou 'utilisateurs'.");
        }
    };
});

function initializeNavigation() {
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('section');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Retirer la classe active de tous les liens
            navLinks.forEach(l => l.classList.remove('active'));
            
            // Ajouter la classe active au lien cliqué
            this.classList.add('active');
            
            // Masquer toutes les sections
            sections.forEach(section => section.classList.add('hidden'));
            
            // Afficher la section correspondante
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.classList.remove('hidden');
                
                // Charger les données spécifiques à la section
                switch(targetId) {
                    case 'logiciels':
                        loadSoftwareData();
                        break;
                    case 'licences':
                        loadLicenseData();
                        break;
                    case 'utilisateurs':
                        loadUserData();
                        break;
                    case 'rapports':
                        initializeCharts();
                        break;
                }
            }
        });
    });
}

function loadDashboardData() {
    // Les données du dashboard sont déjà dans le HTML
    // Ici on pourrait ajouter des mises à jour en temps réel
    updateStats();
}

function updateStats() {
    const stats = {
        software: mockData.software.length,
        licenses: mockData.licenses.filter(l => l.status === 'active').length,
        users: mockData.users.filter(u => u.status === 'active').length,
        expired: mockData.licenses.filter(l => l.status === 'expired').length
    };

    // Mettre à jour les statistiques dans le DOM
    const statCards = document.querySelectorAll('.stat-card h3');
    if (statCards.length >= 4) {
        statCards[0].textContent = stats.software;
        statCards[1].textContent = stats.licenses;
        statCards[2].textContent = stats.users;
        statCards[3].textContent = stats.expired;
    }
}

function loadSoftwareData() {
    const softwareGrid = document.getElementById('software-grid');
    if (!softwareGrid) return;

    softwareGrid.innerHTML = mockData.software.map(software => `
        <div class="software-card">
            <div class="software-header">
                <div class="software-icon">
                    <i class="${software.icon}"></i>
                </div>
                <div class="software-info">
                    <h3>${software.name}</h3>
                    <p class="software-version">Version ${software.version}</p>
                    <span class="status-badge status-${software.status}">${getStatusText(software.status)}</span>
                </div>
            </div>
            <div class="software-details">
                <p><strong>Catégorie:</strong> ${software.category}</p>
                <p><strong>Licences:</strong> ${software.used}/${software.licenses}</p>
                <div class="license-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: ${(software.used / software.licenses) * 100}%"></div>
                    </div>
                </div>
            </div>
            <div class="software-actions">
                <button class="btn-secondary" onclick="editSoftware(${software.id})">
                    <i class="fas fa-edit"></i> Modifier
                </button>
                <button class="btn-primary" onclick="manageLicenses(${software.id})">
                    <i class="fas fa-key"></i> Licences
                </button>
            </div>
        </div>
    `).join('');
}

function loadLicenseData() {
    const licenseTbody = document.getElementById('license-tbody');
    if (!licenseTbody) return;

    licenseTbody.innerHTML = mockData.licenses.map(license => `
        <tr>
            <td>${license.software}</td>
            <td><code>${license.key}</code></td>
            <td>${formatDate(license.expiration)}</td>
            <td>${license.user}</td>
            <td><span class="status-badge status-${license.status}">${getStatusText(license.status)}</span></td>
            <td>
                <button class="btn-secondary" onclick="editLicense(${license.id})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-secondary" onclick="deleteLicense(${license.id})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function loadUserData() {
    const usersGrid = document.getElementById('users-grid');
    if (!usersGrid) return;

    usersGrid.innerHTML = mockData.users.map(user => `
        <div class="user-card">
            <div class="user-avatar">
                <img src="${user.avatar}" alt="${user.name}" onerror="this.src='images/default-avatar.jpg'">
            </div>
            <h3>${user.name}</h3>
            <p class="user-email">${user.email}</p>
            <p class="user-department">${user.department}</p>
            <p class="user-role">${user.role}</p>
            <span class="status-badge status-${user.status}">${getStatusText(user.status)}</span>
            <div class="user-actions">
                <button class="btn-secondary" onclick="editUser(${user.id})">
                    <i class="fas fa-edit"></i> Modifier
                </button>
                <button class="btn-primary" onclick="assignSoftware(${user.id})">
                    <i class="fas fa-desktop"></i> Logiciels
                </button>
            </div>
        </div>
    `).join('');
}

// Fonctions utilitaires
function getStatusText(status) {
    const statusMap = {
        'active': 'Actif',
        'inactive': 'Inactif',
        'expired': 'Expiré',
        'warning': 'Attention'
    };
    return statusMap[status] || status;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR');
}

// Gestion des modals
function openModal(type) {
    const modal = document.getElementById('modal-overlay');
    const modalTitle = document.getElementById('modal-title');
    const modalBody = document.getElementById('modal-body');

    modal.classList.remove('hidden');

    switch(type) {
        case 'add-software':
            modalTitle.textContent = 'Ajouter un logiciel';
            modalBody.innerHTML = getSoftwareForm();
            break;
        case 'add-license':
            modalTitle.textContent = 'Nouvelle licence';
            modalBody.innerHTML = getLicenseForm();
            break;
        case 'add-user':
            modalTitle.textContent = 'Ajouter un utilisateur';
            modalBody.innerHTML = getUserForm();
            break;
    }
}

function closeModal() {
    const modal = document.getElementById('modal-overlay');
    modal.classList.add('hidden');
}

function getSoftwareForm() {
    return `
        <form id="software-form">
            <div class="form-group">
                <label for="software-name">Nom du logiciel</label>
                <input type="text" id="software-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="software-version">Version</label>
                <input type="text" id="software-version" name="version" required>
            </div>
            <div class="form-group">
                <label for="software-category">Catégorie</label>
                <select id="software-category" name="category" required>
                    <option value="">Sélectionner une catégorie</option>
                    <option value="Design">Design</option>
                    <option value="Productivité">Productivité</option>
                    <option value="Développement">Développement</option>
                    <option value="CAO/DAO">CAO/DAO</option>
                    <option value="ERP">ERP</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>
            <div class="form-group">
                <label for="software-licenses">Nombre de licences</label>
                <input type="number" id="software-licenses" name="licenses" min="1" required>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="closeModal()">Annuler</button>
                <button type="submit" class="btn-primary">Ajouter</button>
            </div>
        </form>
    `;
}

function getLicenseForm() {
    return `
        <form id="license-form">
            <div class="form-group">
                <label for="license-software">Logiciel</label>
                <select id="license-software" name="software" required>
                    <option value="">Sélectionner un logiciel</option>
                    ${mockData.software.map(s => `<option value="${s.id}">${s.name}</option>`).join('')}
                </select>
            </div>
            <div class="form-group">
                <label for="license-key">Clé de licence</label>
                <input type="text" id="license-key" name="key" required>
            </div>
            <div class="form-group">
                <label for="license-expiration">Date d'expiration</label>
                <input type="date" id="license-expiration" name="expiration" required>
            </div>
            <div class="form-group">
                <label for="license-user">Utilisateur</label>
                <select id="license-user" name="user" required>
                    <option value="">Sélectionner un utilisateur</option>
                    ${mockData.users.map(u => `<option value="${u.id}">${u.name}</option>`).join('')}
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="closeModal()">Annuler</button>
                <button type="submit" class="btn-primary">Ajouter</button>
            </div>
        </form>
    `;
}

function getUserForm() {
    return `
        <form id="user-form">
            <div class="form-group">
                <label for="user-name">Nom complet</label>
                <input type="text" id="user-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="user-email">Email</label>
                <input type="email" id="user-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="user-department">Département</label>
                <select id="user-department" name="department" required>
                    <option value="">Sélectionner un département</option>
                    <option value="IT">IT</option>
                    <option value="Design">Design</option>
                    <option value="Administration">Administration</option>
                    <option value="Ingénierie">Ingénierie</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Ventes">Ventes</option>
                </select>
            </div>
            <div class="form-group">
                <label for="user-role">Rôle</label>
                <input type="text" id="user-role" name="role" required>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="closeModal()">Annuler</button>
                <button type="submit" class="btn-primary">Ajouter</button>
            </div>
        </form>
    `;
}

// Fonctions d'action
function editSoftware(id) {
    console.log('Modifier logiciel:', id);
    // Implémenter la logique de modification
}

function manageLicenses(id) {
    console.log('Gérer licences pour logiciel:', id);
    // Implémenter la logique de gestion des licences
}

function editLicense(id) {
    console.log('Modifier licence:', id);
    // Implémenter la logique de modification
}

function deleteLicense(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette licence ?')) {
        console.log('Supprimer licence:', id);
        // Implémenter la logique de suppression
    }
}

function editUser(id) {
    console.log('Modifier utilisateur:', id);
    // Implémenter la logique de modification
}

function assignSoftware(id) {
    console.log('Assigner logiciels à utilisateur:', id);
    // Implémenter la logique d'assignation
}

function generateReport() {
    console.log('Génération du rapport...');
    // Implémenter la logique de génération de rapport
    alert('Rapport généré avec succès !');
}

// Gestion des formulaires
document.addEventListener('submit', function(e) {
    if (e.target.id === 'software-form') {
        e.preventDefault();
        // Traiter l'ajout de logiciel
        console.log('Ajout de logiciel:', new FormData(e.target));
        closeModal();
        loadSoftwareData();
    } else if (e.target.id === 'license-form') {
        e.preventDefault();
        // Traiter l'ajout de licence
        console.log('Ajout de licence:', new FormData(e.target));
        closeModal();
        loadLicenseData();
    } else if (e.target.id === 'user-form') {
        e.preventDefault();
        // Traiter l'ajout d'utilisateur
        console.log('Ajout d\'utilisateur:', new FormData(e.target));
        closeModal();
        loadUserData();
    }
});

// Fermer le modal en cliquant à l'extérieur
document.getElementById('modal-overlay').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});