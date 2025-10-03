<?php
include 'header.php';
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
        /* Estilos do header.php aqui (copiar todo o CSS) */
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
        
        /* ... (manter todo o CSS do header.php) ... */
    </style>
</head>
<body>
    <!-- Elementos flutuantes de fundo -->
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    
    <!-- Menu de navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-dungeon me-2"></i><?php echo SITE_NAME; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="fas fa-home me-1"></i>Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sobre.php">
                            <i class="fas fa-info-circle me-1"></i>Sobre
                        </a>
                    </li>
                    <?php if (isLoggedIn()): ?>
                        <?php if (isAdmin()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="painel.php">
                                    <i class="fas fa-tachometer-alt me-1"></i>Painel Admin
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="usuario.php">
                                    <i class="fas fa-user me-1"></i>Minha Conta
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link logout-btn" href="logout.php">
                                <i class="fas fa-sign-out-alt me-1"></i>Sair
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <h1 class="hero-title"><?php echo SITE_NAME; ?></h1>
            <p class="hero-subtitle">Domine o conhecimento como um verdadeiro caçador de sombras</p>
            
            <?php if (isLoggedIn()): ?>
                <?php if (isAdmin()): ?>
                    <a href="painel.php" class="btn btn-glow">
                        <i class="fas fa-crown me-2"></i>Acessar Painel Admin
                    </a>
                <?php else: ?>
                    <a href="usuario.php" class="btn btn-glow">
                        <i class="fas fa-user-shield me-2"></i>Minha Arena
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <a href="login.php" class="btn btn-glow">
                    <i class="fas fa-play me-2"></i>Iniciar Missão
                </a>
            <?php endif; ?>
            
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-number">1,847</div>
                    <div class="stat-label">Tomos Arcanos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">642</div>
                    <div class="stat-label">Caçadores Ativos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">156</div>
                    <div class="stat-label">Missões Hoje</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">89%</div>
                    <div class="stat-label">Taxa de Sucesso</div>
                </div>
            </div>
        </div>
    </header>

    <!-- Seção de Recursos -->
    <section class="container my-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card-glow p-4 text-center h-100">
                    <div class="mb-3" style="font-size: 3rem;">⚔️</div>
                    <h4 style="color: var(--highlight);">Sistema de Rank</h4>
                    <p>Progrida de E-Rank até S-Rank através do conhecimento adquirido nos tomos arcanos.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-glow p-4 text-center h-100">
                    <div class="mb-3" style="font-size: 3rem;">📚</div>
                    <h4 style="color: var(--highlight);">Tomos Arcanos</h4>
                    <p>Acesse conhecimentos proibidos e habilidades especiais através de nossa coleção exclusiva.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-glow p-4 text-center h-100">
                    <div class="mb-3" style="font-size: 3rem;">🎯</div>
                    <h4 style="color: var(--highlight);">Missões Diárias</h4>
                    <p>Complete missões de leitura para ganhar pontos de experiência e subir de nível.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> - <?php echo SITE_NAME; ?></p>
            <p class="small">Inspirado no universo de Solo Leveling - Sistema de Gerenciamento de Conhecimento Arcano</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>