// Modal Edit
const modal = document.getElementById('editModal');
const spanClose = document.getElementsByClassName('close')[0];
const editForm = document.getElementById('editForm');

document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
        document.getElementById('editNom').value = btn.getAttribute('data-nom');
        document.getElementById('editVersion').value = btn.getAttribute('data-version');
        document.getElementById('editDescription').value = btn.getAttribute('data-description');
        editForm.action = `/logiciels/${id}`; // route update
        modal.style.display = 'block';
    });
});

spanClose.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Initialisation des graphiques
function initializeCharts() {
    // Attendre que les éléments canvas soient disponibles
    setTimeout(() => {
        createSoftwareUsageChart();
        createLicenseStatusChart();
    }, 100);
}

// Graphique d'utilisation des logiciels
function createSoftwareUsageChart() {
    const ctx = document.getElementById('software-usage-chart');
    if (!ctx) return;

    const softwareData = mockData.software.map(software => ({
        name: software.name,
        used: software.used,
        total: software.licenses,
        percentage: (software.used / software.licenses) * 100
    }));

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: softwareData.map(item => item.name),
            datasets: [{
                label: 'Licences utilisées',
                data: softwareData.map(item => item.used),
                backgroundColor: 'rgba(40, 56, 135, 1)',
                borderColor: 'rgba(40, 56, 135, 1)',
                borderWidth: 1
            }, {
                label: 'Licences totales',
                data: softwareData.map(item => item.total),
                backgroundColor: 'rgba(244, 152, 38, 0.6)',
                borderColor: 'rgba(244, 152, 38, 0.6)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre de licences'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Logiciels'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Utilisation des licences par logiciel'
                }
            }
        }
    });
}

// Graphique des statuts de licences
function createLicenseStatusChart() {
    const ctx = document.getElementById('license-status-chart');
    if (!ctx) return;

    const statusCounts = {
        active: mockData.licenses.filter(l => l.status === 'active').length,
        warning: mockData.licenses.filter(l => l.status === 'warning').length,
        expired: mockData.licenses.filter(l => l.status === 'expired').length
    };

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Actives', 'Attention', 'Expirées'],
            datasets: [{
                data: [statusCounts.active, statusCounts.warning, statusCounts.expired],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(255, 193, 7, 0.8)',
                    'rgba(220, 53, 69, 0.8)'
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Répartition des licences par statut'
                }
            }
        }
    });
}

// Fonction pour rafraîchir les graphiques
function refreshCharts() {
    // Supprimer les anciens graphiques
    const charts = document.querySelectorAll('canvas');
    charts.forEach(canvas => {
        const chart = Chart.getChart(canvas);
        if (chart) {
            chart.destroy();
        }
    });

    // Recréer les graphiques
    initializeCharts();
}

// Fonction pour exporter les données
function exportData(format = 'csv') {
    const data = {
        software: mockData.software,
        licenses: mockData.licenses,
        users: mockData.users
    };

    switch(format) {
        case 'csv':
            exportToCSV(data);
            break;
        case 'json':
            exportToJSON(data);
            break;
        case 'pdf':
            exportToPDF(data);
            break;
    }
}

// Export CSV
function exportToCSV(data) {
    let csvContent = "data:text/csv;charset=utf-8,";
    
    // En-têtes pour les logiciels
    csvContent += "Logiciels\n";
    csvContent += "Nom,Version,Catégorie,Statut,Licences utilisées,Licences totales\n";
    
    data.software.forEach(software => {
        csvContent += `${software.name},${software.version},${software.category},${software.status},${software.used},${software.licenses}\n`;
    });
    
    csvContent += "\nLicences\n";
    csvContent += "Logiciel,Clé,Expiration,Utilisateur,Statut\n";
    
    data.licenses.forEach(license => {
        csvContent += `${license.software},${license.key},${license.expiration},${license.user},${license.status}\n`;
    });
    
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "logiciels_metiers.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Export JSON
function exportToJSON(data) {
    const jsonContent = JSON.stringify(data, null, 2);
    const blob = new Blob([jsonContent], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement("a");
    link.setAttribute("href", url);
    link.setAttribute("download", "logiciels_metiers.json");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
}

// Export PDF (simulation)
function exportToPDF(data) {
    alert('Fonctionnalité d\'export PDF en cours de développement');
    // Ici on pourrait utiliser une bibliothèque comme jsPDF
}

// Fonction pour filtrer les données
function filterData(type, filters) {
    let filteredData = [];
    
    switch(type) {
        case 'software':
            filteredData = mockData.software.filter(software => {
                if (filters.category && software.category !== filters.category) return false;
                if (filters.status && software.status !== filters.status) return false;
                if (filters.search && !software.name.toLowerCase().includes(filters.search.toLowerCase())) return false;
                return true;
            });
            break;
        case 'licenses':
            filteredData = mockData.licenses.filter(license => {
                if (filters.status && license.status !== filters.status) return false;
                if (filters.search && !license.software.toLowerCase().includes(filters.search.toLowerCase())) return false;
                return true;
            });
            break;
        case 'users':
            filteredData = mockData.users.filter(user => {
                if (filters.department && user.department !== filters.department) return false;
                if (filters.status && user.status !== filters.status) return false;
                if (filters.search && !user.name.toLowerCase().includes(filters.search.toLowerCase())) return false;
                return true;
            });
            break;
    }
    
    return filteredData;
}

// Fonction pour rechercher
function searchData(query, type = 'all') {
    const results = {
        software: [],
        licenses: [],
        users: []
    };
    
    if (type === 'all' || type === 'software') {
        results.software = mockData.software.filter(software => 
            software.name.toLowerCase().includes(query.toLowerCase()) ||
            software.category.toLowerCase().includes(query.toLowerCase())
        );
    }
    
    if (type === 'all' || type === 'licenses') {
        results.licenses = mockData.licenses.filter(license => 
            license.software.toLowerCase().includes(query.toLowerCase()) ||
            license.user.toLowerCase().includes(query.toLowerCase())
        );
    }
    
    if (type === 'all' || type === 'users') {
        results.users = mockData.users.filter(user => 
            user.name.toLowerCase().includes(query.toLowerCase()) ||
            user.email.toLowerCase().includes(query.toLowerCase()) ||
            user.department.toLowerCase().includes(query.toLowerCase())
        );
    }
    
    return results;
}

// Fonction pour obtenir les statistiques avancées
function getAdvancedStats() {
    const stats = {
        totalSoftware: mockData.software.length,
        totalLicenses: mockData.licenses.length,
        totalUsers: mockData.users.length,
        activeLicenses: mockData.licenses.filter(l => l.status === 'active').length,
        expiredLicenses: mockData.licenses.filter(l => l.status === 'expired').length,
        warningLicenses: mockData.licenses.filter(l => l.status === 'warning').length,
        activeUsers: mockData.users.filter(u => u.status === 'active').length,
        licenseUtilization: 0,
        topSoftware: [],
        departments: {}
    };
    
    // Calcul du taux d'utilisation des licences
    const totalLicenses = mockData.software.reduce((sum, software) => sum + software.licenses, 0);
    const usedLicenses = mockData.software.reduce((sum, software) => sum + software.used, 0);
    stats.licenseUtilization = totalLicenses > 0 ? (usedLicenses / totalLicenses) * 100 : 0;
    
    // Logiciels les plus utilisés
    stats.topSoftware = mockData.software
        .sort((a, b) => (b.used / b.licenses) - (a.used / a.licenses))
        .slice(0, 5);
    
    // Répartition par département
    mockData.users.forEach(user => {
        if (!stats.departments[user.department]) {
            stats.departments[user.department] = 0;
        }
        stats.departments[user.department]++;
    });
    
    return stats;
}

// Fonction pour afficher les notifications
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${getNotificationIcon(type)}"></i>
            <span>${message}</span>
        </div>
        <button class="notification-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    // Ajouter les styles CSS pour les notifications
    if (!document.querySelector('#notification-styles')) {
        const styles = document.createElement('style');
        styles.id = 'notification-styles';
        styles.textContent = `
            .notification {
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                border-radius: 8px;
                padding: 1rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                display: flex;
                align-items: center;
                gap: 0.5rem;
                z-index: 3000;
                animation: slideIn 0.3s ease;
            }
            
            .notification-info {
                border-left: 4px solid #667eea;
            }
            
            .notification-success {
                border-left: 4px solid #28a745;
            }
            
            .notification-warning {
                border-left: 4px solid #ffc107;
            }
            
            .notification-error {
                border-left: 4px solid #dc3545;
            }
            
            .notification-content {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
            
            .notification-close {
                background: none;
                border: none;
                cursor: pointer;
                color: #666;
                padding: 0.25rem;
            }
            
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(styles);
    }
    
    document.body.appendChild(notification);
    
    // Auto-suppression après 5 secondes
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

function getNotificationIcon(type) {
    const icons = {
        info: 'info-circle',
        success: 'check-circle',
        warning: 'exclamation-triangle',
        error: 'times-circle'
    };
    return icons[type] || 'info-circle';
}

// Fonction pour valider les formulaires
function validateForm(formData, type) {
    const errors = [];
    
    switch(type) {
        case 'software':
            if (!formData.get('name').trim()) {
                errors.push('Le nom du logiciel est requis');
            }
            if (!formData.get('version').trim()) {
                errors.push('La version est requise');
            }
            if (!formData.get('category')) {
                errors.push('La catégorie est requise');
            }
            if (!formData.get('licenses') || parseInt(formData.get('licenses')) < 1) {
                errors.push('Le nombre de licences doit être supérieur à 0');
            }
            break;
            
        case 'license':
            if (!formData.get('software')) {
                errors.push('Le logiciel est requis');
            }
            if (!formData.get('key').trim()) {
                errors.push('La clé de licence est requise');
            }
            if (!formData.get('expiration')) {
                errors.push('La date d\'expiration est requise');
            }
            if (!formData.get('user')) {
                errors.push('L\'utilisateur est requis');
            }
            break;
            
        case 'user':
            if (!formData.get('name').trim()) {
                errors.push('Le nom est requis');
            }
            if (!formData.get('email').trim()) {
                errors.push('L\'email est requis');
            } else if (!isValidEmail(formData.get('email'))) {
                errors.push('L\'email n\'est pas valide');
            }
            if (!formData.get('department')) {
                errors.push('Le département est requis');
            }
            if (!formData.get('role').trim()) {
                errors.push('Le rôle est requis');
            }
            break;
    }
    
    return errors;
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Fonction pour générer des données de test
function generateTestData() {
    const testSoftware = [
        {
            name: "Photoshop 2024",
            version: "25.0",
            category: "Design",
            licenses: 20,
            used: 18
        },
        {
            name: "Excel 365",
            version: "2024",
            category: "Productivité",
            licenses: 35,
            used: 32
        }
    ];
    
    testSoftware.forEach(software => {
        // Simuler l'ajout de logiciel
        console.log('Ajout de logiciel de test:', software);
    });
    
    showNotification('Données de test générées avec succès', 'success');
}

// Initialisation des événements supplémentaires
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter des écouteurs d'événements pour les raccourcis clavier
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + N pour nouveau logiciel
        if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
            e.preventDefault();
            openModal('add-software');
        }
        
        // Ctrl/Cmd + K pour nouvelle licence
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            openModal('add-license');
        }
        
        // Ctrl/Cmd + U pour nouvel utilisateur
        if ((e.ctrlKey || e.metaKey) && e.key === 'u') {
            e.preventDefault();
            openModal('add-user');
        }
        
        // Échap pour fermer les modals
        if (e.key === 'Escape') {
            closeModal();
        }
    });
    
    // Ajouter des tooltips pour les raccourcis clavier
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
        const text = button.querySelector('span').textContent;
        let shortcut = '';
        
        if (text.includes('logiciel')) shortcut = 'Ctrl+N';
        else if (text.includes('licence')) shortcut = 'Ctrl+K';
        else if (text.includes('utilisateur')) shortcut = 'Ctrl+U';
        
        if (shortcut) {
            button.title = `${text} (${shortcut})`;
        }
    });
});
