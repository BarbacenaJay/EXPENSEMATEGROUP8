<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExpenseMate - Track Your Expenses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Lato:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --maroon: #800020;
            --maroon-dark: #5C0017;
            --maroon-light: #A3002D;
            --black: #1A1A1A;
            --white: #FFFFFF;
            --gray-dark: #333333;
            --gray: #666666;
            --gray-light: #F5F5F5;
            --bg: #FAFAFA;
        }
        
        body {
            background: var(--bg);
            font-family: 'Lato', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            color: var(--black);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }
        
        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 600;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%) !important;
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(128, 0, 32, 0.3);
        }
        
        .navbar-brand {
            font-size: 1.6rem;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
        }
        
        .navbar-brand i {
            font-size: 1.8rem;
        }
        
        .nav-link {
            font-family: 'Lato', sans-serif;
            font-weight: 500;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background: rgba(255,255,255,0.15);
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 40px rgba(0,0,0,0.12);
        }
        
        .stat-card {
            padding: 1.75rem;
            border-radius: 12px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -30%;
            width: 80%;
            height: 200%;
            background: rgba(255,255,255,0.08);
            transform: rotate(25deg);
        }
        
        .stat-card.income {
            background: linear-gradient(135deg, #2E7D32 0%, #1B5E20 100%);
        }
        
        .stat-card.expense {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);
        }
        
        .stat-card.balance {
            background: linear-gradient(135deg, var(--black) 0%, #333333 100%);
        }
        
        .stat-card .stat-icon {
            font-size: 3.5rem;
            opacity: 0.2;
            position: absolute;
            right: 1.5rem;
            top: 1rem;
        }
        
        .stat-card h3 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            letter-spacing: -0.5px;
        }
        
        .stat-card p {
            margin: 0;
            opacity: 0.9;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 500;
        }
        
        .btn {
            font-family: 'Lato', sans-serif;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-radius: 8px;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--maroon-light) 0%, var(--maroon) 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(128, 0, 32, 0.3);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #2E7D32 0%, #1B5E20 100%);
            border: none;
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #388E3C 0%, #2E7D32 100%);
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);
            border: none;
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, var(--maroon-light) 0%, var(--maroon) 100%);
            transform: translateY(-2px);
        }
        
        .btn-warning {
            background: var(--black);
            border: none;
            color: white;
        }
        
        .btn-warning:hover {
            background: #333333;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-outline-secondary {
            border: 2px solid var(--gray);
            color: var(--gray);
            border-radius: 8px;
            padding: 0.6rem 1.5rem;
        }
        
        .btn-outline-secondary:hover {
            background: var(--gray-dark);
            border-color: var(--gray-dark);
            color: white;
        }
        
        .table {
            border-collapse: separate;
            border-spacing: 0 6px;
        }
        
        .table thead th {
            background: var(--black);
            color: white;
            border: none;
            padding: 1rem 1.25rem;
            font-family: 'Lato', sans-serif;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .table thead th:first-child {
            border-radius: 8px 0 0 8px;
        }
        
        .table thead th:last-child {
            border-radius: 0 8px 8px 0;
        }
        
        .table tbody td {
            background: white;
            border: none;
            padding: 1rem 1.25rem;
            vertical-align: middle;
            font-size: 0.95rem;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover td {
            background: #F8F8F8;
        }
        
        .badge {
            padding: 0.4rem 0.9rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.8rem 1rem;
            border: 2px solid #E0E0E0;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--maroon);
            box-shadow: 0 0 0 4px rgba(128, 0, 32, 0.1);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--black);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .card-header {
            background: white;
            border-bottom: 2px solid var(--gray-light);
            padding: 1.25rem 1.5rem;
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            font-weight: 500;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #2E7D32 0%, #1B5E20 100%);
            color: white;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);
            color: white;
        }
        
        .page-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.75rem;
        }
        
        .page-title i {
            color: var(--maroon);
        }
        
        .recent-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 1rem 1.5rem;
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 600;
            font-size: 1rem;
        }
        
        .recent-header.expense {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);
            color: white;
            border-radius: 12px 12px 0 0;
        }
        
        .recent-header.income {
            background: linear-gradient(135deg, #2E7D32 0%, #1B5E20 100%);
            color: white;
            border-radius: 12px 12px 0 0;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--gray);
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.4;
        }
        
        .empty-state h4 {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 600;
            color: var(--black);
        }
        
        .action-btn {
            padding: 0.4rem 0.9rem;
            font-size: 0.85rem;
            border-radius: 6px;
        }
        
        .input-group-text {
            background: var(--gray-light);
            border: 2px solid #E0E0E0;
            border-right: none;
            border-radius: 8px 0 0 8px;
            font-weight: 600;
            color: var(--gray);
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 8px 8px 0;
        }
        
        .text-danger {
            color: var(--maroon) !important;
        }
        
        .text-success {
            color: #2E7D32 !important;
        }
        
        .fw-bold {
            font-weight: 700 !important;
        }
        
        @media (max-width: 768px) {
            .stat-card {
                margin-bottom: 1rem;
            }
            
            .page-title {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="ri-wallet-3-fill"></i>
                ExpenseMate
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="ri-dashboard-line me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('expenses.index') }}">
                                <i class="ri-shopping-cart-line me-1"></i> Expenses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('incomes.index') }}">
                                <i class="ri-money-dollar-circle-line me-1"></i> Income
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn nav-link w-100 text-start">
                                    <i class="ri-logout-box-line me-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="ri-login-box-line me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="ri-user-add-line me-1"></i> Register
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
