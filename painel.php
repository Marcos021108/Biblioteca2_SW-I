<?php
include 'header.php';
requireAuth();

// Verificar se é admin
if (!isAdmin()) {
    header('Location: usuario.php');
    exit();
}
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
                        <a class="nav-link" href="sobre.php">
                            <i class="fas fa-info-circle me-1"></i>Sobre
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="painel.php">
                            <i class="fas fa-crown me-1"></i>Painel Admin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link logout-btn" href="logout.php">
                            <i class="fas fa-sign-out-alt me-1"></i>Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="page-title">Painel de Controle do Sistema</h1>
        <div class="alert-custom">
            <h2><i class="fas fa-crown me-2"></i>COMANDANTE DO SISTEMA</h2>
            <p class="mt-3">Bem-vindo, <?php echo $_SESSION['user_name']; ?>! Você tem controle total sobre o sistema.</p>
        </div>
        
        <!-- Estatísticas do Sistema -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number">1,847</div>
                <div class="stat-label">Total de Tomos</div>
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
                <div class="stat-number">12</div>
                <div class="stat-label">Alertas Críticos</div>
            </div>
        </div>
        
        <!-- Ações Rápidas e Alertas -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="book-card">
                    <h3 class="book-title">
                        <i class="fas fa-bolt me-2"></i>Ações Rápidas
                    </h3>
                    <div class="action-buttons">
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-plus me-1"></i>Novo Tomo
                        </button>
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-user-plus me-1"></i>Novo Caçador
                        </button>
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-chart-bar me-1"></i>Relatório
                        </button>
                    </div>
                    <div class="action-buttons mt-2">
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-cog me-1"></i>Configurações
                        </button>
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-shield-alt me-1"></i>Segurança
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="book-card">
                    <h3 class="book-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>Alertas do Sistema
                    </h3>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-skull-crossbones text-danger me-2"></i>
                            <strong>5 missões em estado crítico</strong>
                            <small class="d-block text-muted">Necessária intervenção imediata</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-user-clock text-warning me-2"></i>
                            <strong>3 novos caçadores esta semana</strong>
                            <small class="d-block text-muted">Aguardando avaliação de rank</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-server text-info me-2"></i>
                            <strong>Sistema operando normalmente</strong>
                            <small class="d-block text-muted">Performance: 98.7%</small>
                        </li>
                        <li>
                            <i class="fas fa-sync text-success me-2"></i>
                            <strong>Backup automático concluído</strong>
                            <small class="d-block text-muted">Último backup: 2 horas atrás</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Últimas Atividades -->
        <h3 class="section-title">
            <i class="fas fa-list-alt me-2"></i>Últimas Atividades
        </h3>
        
        <div class="book-card">
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Caçador</th>
                            <th>Ação</th>
                            <th>Tomo</th>
                            <th>Data/Hora</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Jin-Woo Sung</strong></td>
                            <td>Iniciou missão</td>
                            <td>Domínio das Sombras Nv2</td>
                            <td>24/10/2023 14:30</td>
                            <td><span class="book-status status-borrowed">Em Andamento</span></td>
                        </tr>
                        <tr>
                            <td><strong>Cha Hae-In</strong></td>
                            <td>Completou missão</td>
                            <td>Estratégias Avançadas</td>
                            <td>24/10/2023 13:15</td>
                            <td><span class="book-status status-available">Concluído</span></td>
                        </tr>
                        <tr>
                            <td><strong>Baek Yoon-Ho</strong></td>
                            <td>Missão expirada</td>
                            <td>Táticas de Guildas</td>
                            <td>24/10/2023 11:45</td>
                            <td><span class="book-status status-overdue">Crítico</span></td>
                        </tr>
                        <tr>
                            <td><strong>Yoo Jin-Ho</strong></td>
                            <td>Nova inscrição</td>
                            <td>Sistema Básico</td>
                            <td>24/10/2023 10:20</td>
                            <td><span class="book-status status-available">Ativo</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> - <?php echo SITE_NAME; ?></p>
            <p class="small">Sistema de Gerenciamento Arcano - Versão 2.1.4</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>