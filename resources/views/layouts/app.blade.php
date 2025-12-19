<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Logiciels Métiers</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
                   <!-- <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Tableau de bord</a>
-->
                   <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Tableau de bord</a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('logiciels.index') }}" class="menu-link {{ request()->routeIs('logiciels.*') ? 'active' : '' }}">Logiciels</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('licences.index') }}" class="menu-link {{ request()->routeIs('licences.*') ? 'active' : '' }}">Licences</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('utilisateurs.index') }}" class="menu-link {{ request()->routeIs('utilisateurs.*') ? 'active' : '' }}">Utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rapports') }}" class="menu-link {{ request()->routeIs('rapports') ? 'active' : '' }}">Rapports</a>
                </li>
                  </ul>

           <li class="nav-profile">
                <!-- Profile Link -->
                <a href="{{ route('profile.edit') }}" class="menu-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">Profile</a>
            </li>

                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>
    {{-- Footer --}}
@include('includes.footer')

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
