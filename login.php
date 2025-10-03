<?php
include 'header.php';

// Debug: Verificar se o header foi incluído
if (!defined('SITE_NAME')) {
    die('Erro: header.php não carregou corretamente');
}

// Se já estiver logado, redirecionar
if (isLoggedIn()) {
    if (isAdmin()) {
        header('Location: painel.php');
    } else {
        header('Location: usuario.php');
    }
    exit();
}

// Processar formulário de login
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validar campos
    if (empty($email) || empty($password)) {
        $error = "Por favor, preencha todos os campos!";
    } else {
        // Verificar credenciais
        if (isset($GLOBALS['users'][$email])) {
            $user = $GLOBALS['users'][$email];
            
            if ($user['password'] === $password) {
                // Login bem-sucedido
                $_SESSION['user_id'] = $email;
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_avatar'] = $user['avatar'];
                
                // Redirecionar baseado no role
                if ($user['role'] === 'admin') {
                    header('Location: painel.php');
                } else {
                    header('Location: usuario.php');
                }
                exit();
            } else {
                $error = "Senha incorreta!";
            }
        } else {
            $error = "Usuário não encontrado!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo SITE_NAME; ?></title>
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
        }
        
        body {
            background-color: var(--primary-dark);
            color: var(--text-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(90deg, var(--highlight), var(--accent-blue));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .login-container {
            background: rgba(15, 15, 35, 0.9);
            border-radius: 15px;
            padding: 40px;
            margin: 50px auto;
            max-width: 500px;
            border: 1px solid rgba(41, 98, 255, 0.3);
        }
        
        .btn-glow {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }
        
        .btn-glow:hover {
            transform: translateY(-2px);
            color: white;
        }
        
        .form-control {
            background-color: rgba(30, 30, 60, 0.7);
            border: 1px solid rgba(41, 98, 255, 0.3);
            color: var(--text-light);
            border-radius: 8px;
            padding: 12px 15px;
        }
        
        .form-control:focus {
            background-color: rgba(40, 40, 80, 0.8);
            border-color: var(--accent-blue);
            color: var(--text-light);
        }
        
        .demo-accounts {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }
        
        .account-item {
            background: rgba(255, 255, 255, 0.03);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        
        footer {
            margin-top: auto;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <!-- Menu Simples -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-dungeon me-2"></i><?php echo SITE_NAME; ?>
            </a>
            <div>
                <a href="index.php" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-home me-1"></i>Início
                </a>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="container flex-grow-1">
        <div class="login-container">
            <h2 class="text-center mb-4" style="color: var(--highlight);">
                <i class="fas fa-sign-in-alt me-2"></i>Acesso ao Sistema
            </h2>
            
            <?php if ($error): ?>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" 
                           placeholder="seu@email.com" required 
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" 
                           placeholder="Sua senha" required>
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-glow">
                        <i class="fas fa-play me-2"></i>Entrar no Portal
                    </button>
                </div>
            </form>
            
            <div class="demo-accounts">
                <h6 class="mb-3" style="color: var(--highlight);">
                    <i class="fas fa-users me-2"></i>Contas para Teste
                </h6>
                
                <div class="account-item">
                    <strong>👑 Administrador</strong><br>
                    <small>Email: admin@biblioteca.com</small><br>
                    <small>Senha: admin123</small>
                </div>
                
                <div class="account-item">
                    <strong>⚔️ Usuário Comum</strong><br>
                    <small>Email: jinwoo@biblioteca.com</small><br>
                    <small>Senha: shadow123</small>
                </div>
                
                <div class="account-item">
                    <strong>🛡️ Usuário Comum</strong><br>
                    <small>Email: cha@biblioteca.com</small><br>
                    <small>Senha: haein123</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> - <?php echo SITE_NAME; ?></p>
            <p class="small">Sistema de Gerenciamento de Conhecimento Arcano</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>