<?php
include 'header.php';
?>
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
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-home me-1"></i>Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="sobre.php">
                            <i class="fas fa-info-circle me-1"></i>Sobre
                        </a>
                    </li>
                    <?php if (isLoggedIn()): ?>
                        <?php if (isAdmin()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="painel.php">
                                    <i class="fas fa-crown me-1"></i>Painel Admin
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="usuario.php">
                                    <i class="fas fa-user-shield me-1"></i>Minha Arena
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

    <div class="container">
        <h1 class="page-title">Sobre o Sistema Arcano</h1>
        
        <div class="alert-custom">
            <h2><i class="fas fa-scroll me-2"></i>CRÔNICAS DA BIBLIOTECA SHADOW</h2>
            <p class="mt-3">Um sistema de gerenciamento de conhecimento inspirado no universo de caçadores e portais</p>
        </div>
        
        <!-- Missão e Visão -->
        <div class="row mt-5">
            <div class="col-md-6 mb-4">
                <div class="book-card h-100">
                    <h3 class="book-title">
                        <i class="fas fa-bullseye me-2"></i>Nossa Missão
                    </h3>
                    <p class="mt-3">
                        Fornecer uma plataforma arcana onde caçadores de conhecimento possam acessar tomos proibidos, 
                        completar missões de aprendizado e evoluir em sua jornada de poder. Inspirado na estética de 
                        dungeons e portais, criamos um sistema imersivo para o verdadeiro dominador do conhecimento.
                    </p>
                    <div class="mt-3">
                        <span class="book-status status-available">Ativa</span>
                        <small class="text-muted ms-2">Desde 2023</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="book-card h-100">
                    <h3 class="book-title">
                        <i class="fas fa-eye me-2"></i>Nossa Visão
                    </h3>
                    <p class="mt-3">
                        Ser o sistema de referência para guildas de conhecimento, oferecendo a mais avançada 
                        experiência em gerenciamento de tomos arcanos. Queremos capacitar cada caçador a alcançar 
                        o rank S através do domínio completo do conhecimento disponível em nossos portais.
                    </p>
                    <div class="mt-3">
                        <span class="book-status status-borrowed">Em Evolução</span>
                        <small class="text-muted ms-2">Meta: 2025</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Características do Sistema -->
        <h3 class="section-title">
            <i class="fas fa-star me-2"></i>Características do Sistema
        </h3>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="book-card text-center h-100">
                    <div class="mb-3" style="font-size: 3rem;">🎯</div>
                    <h4 style="color: var(--highlight);">Sistema de Rank</h4>
                    <p>Progrida de E-Rank até S-Rank baseado no seu domínio do conhecimento e conclusão de missões.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="book-card text-center h-100">
                    <div class="mb-3" style="font-size: 3rem;">⚡</div>
                    <h4 style="color: var(--highlight);">Missões Diárias</h4>
                    <p>Desafios de leitura que oferecem XP e recompensas para acelerar sua evolução.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="book-card text-center h-100">
                    <div class="mb-3" style="font-size: 3rem;">📊</div>
                    <h4 style="color: var(--highlight);">Análise Detalhada</h4>
                    <p>Estatísticas completas do seu progresso e desempenho em todas as missões.</p>
                </div>
            </div>
        </div>

        <!-- Ranks do Sistema -->
        <h3 class="section-title">
            <i class="fas fa-trophy me-2"></i>Hierarquia de Ranks
        </h3>
        
        <div class="book-card">
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>XP Necessário</th>
                            <th>Privilégios</th>
                            <th>Caçadores Ativos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong style="color: #ff4444;">S-Rank</strong></td>
                            <td>1000+ XP</td>
                            <td>Acesso Total + Portal Admin</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td><strong style="color: #ffaa00;">A-Rank</strong></td>
                            <td>500-999 XP</td>
                            <td>Tomos Avançados</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td><strong style="color: #ffff00;">B-Rank</strong></td>
                            <td>200-499 XP</td>
                            <td>Missões Especiais</td>
                            <td>156</td>
                        </tr>
                        <tr>
                            <td><strong style="color: #00ff00;">C-Rank</strong></td>
                            <td>100-199 XP</td>
                            <td>Tomos Intermediários</td>
                            <td>289</td>
                        </tr>
                        <tr>
                            <td><strong style="color: #888888;">D-Rank</strong></td>
                            <td>50-99 XP</td>
                            <td>Acesso Básico</td>
                            <td>167</td>
                        </tr>
                        <tr>
                            <td><strong style="color: #555555;">E-Rank</strong></td>
                            <td>0-49 XP</td>
                            <td>Iniciante</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Desenvolvedores -->
        <h3 class="section-title">
            <i class="fas fa-code me-2"></i>Arcanos do Sistema
        </h3>
        
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="book-card">
                    <div class="d-flex align-items-center">
                        <div class="user-avatar me-4" style="width: 80px; height: 80px; font-size: 2rem;">
                            👑
                        </div>
                        <div>
                            <h4 style="color: var(--highlight);">Arcano Supremo</h4>
                            <p class="mb-1">Desenvolvedor Principal</p>
                            <small class="text-muted">Rank: S+ | Especialidade: Portais Dimensionais</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="book-card">
                    <div class="d-flex align-items-center">
                        <div class="user-avatar me-4" style="width: 80px; height: 80px; font-size: 2rem;">
                            🔮
                        </div>
                        <div>
                            <h4 style="color: var(--highlight);">Feiticeira do Código</h4>
                            <p class="mb-1">Desenvolvedora de Interface</p>
                            <small class="text-muted">Rank: A | Especialidade: Ilusões Visuais</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> - <?php echo SITE_NAME; ?></p>
            <p class="small">Sistema desenvolvido com magia arcana e tecnologia moderna</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>