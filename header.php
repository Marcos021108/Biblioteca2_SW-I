<?php
session_start();

// Configurações do sistema
define('SITE_NAME', 'Biblioteca Shadow');

// Funções de autenticação
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

function requireAuth() {
    if (!isLoggedIn()) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
        exit();
    }
}

function redirectIfLoggedIn() {
    if (isLoggedIn()) {
        if (isAdmin()) {
            header('Location: painel.php');
        } else {
            header('Location: usuario.php');
        }
        exit();
    }
}

// Dados de usuários
$GLOBALS['users'] = [
    'admin@biblioteca.com' => [
        'password' => 'admin123',
        'name' => 'Administrador Sistema',
        'role' => 'admin',
        'avatar' => '👑'
    ],
    'jinwoo@biblioteca.com' => [
        'password' => 'shadow123',
        'name' => 'Jin-Woo Sung',
        'role' => 'user',
        'avatar' => '⚔️'
    ],
    'cha@biblioteca.com' => [
        'password' => 'haein123',
        'name' => 'Cha Hae-In',
        'role' => 'user',
        'avatar' => '🛡️'
    ]
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #0a0a1a;
            --primary-blue: #1a237e;
            --accent-blue: #2962ff;
            --accent-purple: #7b1fa2;
            --highlight: #00e5ff;
            --text-light: #e0e0e0;
            --success: #00c853;
            --warning: #ffab00;
            --danger: #ff1744;
            --card-bg: rgba(20, 20, 45, 0.7);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: var(--primary-dark);
            color: var(--text-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(41, 98, 255, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(123, 31, 162, 0.1) 0%, transparent 20%);
        }
        
        .floating-element {
            position: fixed;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(0, 229, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(20px);
            z-index: -1;
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-element:nth-child(1) {
            top: 10%;
            left: 5%;
            width: 150px;
            height: 150px;
            animation-delay: 0s;
        }
        
        .floating-element:nth-child(2) {
            top: 60%;
            right: 10%;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, rgba(123, 31, 162, 0.1) 0%, transparent 70%);
            animation-delay: 2s;
        }
        
        .floating-element:nth-child(3) {
            bottom: 20%;
            left: 15%;
            width: 80px;
            height: 80px;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%) !important;
            border-bottom: 2px solid var(--accent-blue);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: linear-gradient(135deg, var(--highlight), var(--accent-blue));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 0 20px rgba(0, 229, 255, 0.5);
            letter-spacing: 1px;
        }
        
        .nav-link {
            color: var(--text-light) !important;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            margin: 0 5px;
            border-radius: 8px;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--highlight) !important;
            background: rgba(41, 98, 255, 0.1);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--highlight);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after, .nav-link.active::after {
            width: 80%;
        }
        
        .hero-section {
            background: linear-gradient(135deg, 
                rgba(10, 10, 26, 0.9) 0%, 
                rgba(26, 35, 126, 0.7) 50%, 
                rgba(10, 10, 26, 0.9) 100%);
            padding: 120px 0 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(0, 229, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(123, 31, 162, 0.1) 0%, transparent 50%);
            animation: pulse 4s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.8; }
        }
        
        .hero-title {
            font-size: 4rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--highlight), var(--accent-blue), var(--accent-purple));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 0 30px rgba(0, 229, 255, 0.3);
            letter-spacing: 2px;
        }
        
        .hero-subtitle {
            font-size: 1.4rem;
            margin-bottom: 2.5rem;
            color: var(--text-light);
            opacity: 0.9;
            font-weight: 300;
        }
        
        .btn-glow {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            border: none;
            color: white;
            font-weight: 700;
            padding: 15px 40px;
            border-radius: 50px;
            transition: all 0.4s ease;
            box-shadow: 
                0 6px 20px rgba(41, 98, 255, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 1.1rem;
        }
        
        .btn-glow:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 
                0 12px 30px rgba(41, 98, 255, 0.6),
                0 0 20px rgba(0, 229, 255, 0.4);
            color: white;
        }
        
        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.8s ease;
        }
        
        .btn-glow:hover::before {
            left: 100%;
        }
        
        .card-glow {
            background: var(--card-bg);
            border: 1px solid rgba(41, 98, 255, 0.3);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        
        .card-glow:hover {
            transform: translateY(-8px);
            border-color: var(--accent-blue);
            box-shadow: 
                0 15px 35px rgba(0, 0, 0, 0.3),
                0 0 15px rgba(41, 98, 255, 0.2);
        }
        
        .login-container {
            background: var(--card-bg);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 50px;
            margin: 100px auto;
            max-width: 500px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(41, 98, 255, 0.2);
            border: 1px solid rgba(41, 98, 255, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(41, 98, 255, 0.1) 0%, transparent 70%);
            z-index: -1;
            animation: rotate 20s linear infinite;
        }
        
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .form-control {
            background-color: rgba(30, 30, 60, 0.8);
            border: 2px solid rgba(41, 98, 255, 0.3);
            color: var(--text-light);
            border-radius: 12px;
            padding: 15px 20px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        
        .form-control:focus {
            background-color: rgba(40, 40, 80, 0.9);
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 0.3rem rgba(41, 98, 255, 0.2);
            color: var(--text-light);
        }
        
        .page-title {
            font-size: 3rem;
            font-weight: 800;
            text-align: center;
            margin: 60px 0 40px;
            background: linear-gradient(135deg, var(--highlight), var(--accent-blue));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 0 20px rgba(0, 229, 255, 0.3);
        }
        
        .alert-custom {
            background: rgba(123, 31, 162, 0.2);
            border: 2px solid var(--accent-purple);
            color: var(--text-light);
            border-radius: 15px;
            text-align: center;
            padding: 30px;
            margin: 40px 0;
            backdrop-filter: blur(10px);
        }
        
        .alert-success {
            background: rgba(0, 200, 83, 0.2);
            border: 2px solid var(--success);
        }
        
        .alert-warning {
            background: rgba(255, 171, 0, 0.2);
            border: 2px solid var(--warning);
        }
        
        footer {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
            border-top: 2px solid var(--accent-blue);
            padding: 30px 0;
            margin-top: 80px;
        }
        
        .stats-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 60px 0;
            flex-wrap: wrap;
        }
        
        .stat-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            min-width: 200px;
            border: 1px solid rgba(41, 98, 255, 0.3);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .stat-card:hover {
            transform: translateY(-8px) scale(1.05);
            border-color: var(--accent-blue);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: var(--highlight);
            margin-bottom: 10px;
            text-shadow: 0 0 10px rgba(0, 229, 255, 0.3);
        }
        
        .stat-label {
            color: var(--text-light);
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .user-header {
            background: linear-gradient(135deg, rgba(41, 98, 255, 0.3), rgba(123, 31, 162, 0.2));
            border-radius: 20px;
            padding: 40px;
            margin: 40px 0;
            border: 2px solid rgba(41, 98, 255, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .user-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            margin: 0 auto 25px;
            border: 4px solid var(--highlight);
            box-shadow: 0 0 30px rgba(0, 229, 255, 0.3);
        }
        
        .user-info h2 {
            color: var(--highlight);
            margin-bottom: 15px;
            font-weight: 700;
        }
        
        .user-info p {
            margin-bottom: 8px;
            font-size: 1.1rem;
        }
        
        .user-stats {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            gap: 20px;
        }
        
        .user-stat {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            min-width: 120px;
        }
        
        .user-stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--highlight);
            text-shadow: 0 0 10px rgba(0, 229, 255, 0.3);
        }
        
        .user-stat-label {
            font-size: 1rem;
            color: var(--text-light);
            font-weight: 600;
        }
        
        .book-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid rgba(41, 98, 255, 0.3);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .book-card:hover {
            transform: translateY(-8px);
            border-color: var(--accent-blue);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        
        .book-cover {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4.5rem;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        .book-title {
            font-weight: 800;
            color: var(--highlight);
            margin-bottom: 8px;
            font-size: 1.3rem;
        }
        
        .book-author {
            color: var(--text-light);
            font-size: 1rem;
            margin-bottom: 15px;
            opacity: 0.8;
        }
        
        .book-status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .status-available {
            background-color: rgba(0, 200, 83, 0.2);
            color: var(--success);
            border: 2px solid var(--success);
        }
        
        .status-borrowed {
            background-color: rgba(255, 171, 0, 0.2);
            color: var(--warning);
            border: 2px solid var(--warning);
        }
        
        .status-overdue {
            background-color: rgba(255, 23, 68, 0.2);
            color: var(--danger);
            border: 2px solid var(--danger);
        }
        
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }
        
        .btn-sm {
            padding: 8px 20px;
            font-size: 0.9rem;
            border-radius: 25px;
            font-weight: 600;
        }
        
        .section-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--highlight);
            margin: 50px 0 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid rgba(41, 98, 255, 0.3);
            text-shadow: 0 0 10px rgba(0, 229, 255, 0.2);
        }
        
        .logout-btn {
            background: transparent;
            border: 2px solid var(--danger);
            color: var(--danger);
            font-weight: 600;
        }
        
        .logout-btn:hover {
            background: var(--danger);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 23, 68, 0.3);
        }
        
        .table-dark {
            background: var(--card-bg);
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid rgba(41, 98, 255, 0.3);
        }
        
        .table-dark th {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            color: white;
            border: none;
            padding: 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .table-dark td {
            border-color: rgba(41, 98, 255, 0.2);
            padding: 15px 20px;
            vertical-align: middle;
        }
        
        .table-dark tbody tr:hover {
            background: rgba(41, 98, 255, 0.1);
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .login-container {
                margin: 60px 20px;
                padding: 30px 20px;
            }
            
            .stats-container {
                flex-direction: column;
                align-items: center;
            }
            
            .user-stats {
                flex-direction: column;
                gap: 15px;
            }
            
            .page-title {
                font-size: 2.2rem;
            }
        }
        
        .demo-accounts {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 20px;
            margin-top: 25px;
            border: 1px solid rgba(41, 98, 255, 0.2);
        }
        
        .demo-accounts h6 {
            color: var(--highlight);
            margin-bottom: 15px;
            font-weight: 700;
        }
        
        .account-item {
            background: rgba(255, 255, 255, 0.03);
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 8px;
            border-left: 4px solid var(--accent-blue);
        }
    </style>
</head>