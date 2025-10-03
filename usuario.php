<?php
include 'header.php';
requireAuth();

// Verificar se é usuário comum
if (isAdmin()) {
    header('Location: painel.php');
    exit();
}

// Dados do usuário atual
$user_data = $users[$_SESSION['user_id']];
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
                        <a class="nav-link active" href="usuario.php">
                            <i class="fas fa-user-shield me-1"></i>Minha Arena
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
        <h1 class="page-title">Minha Arena de Conhecimento</h1>
        
        <!-- Header do Usuário -->
        <div class="user-header">
            <div class="user-avatar">
                <?php echo $user_data['avatar']; ?>
            </div>
            <div class="user-info text-center">
                <h2><?php echo $_SESSION['user_name']; ?></h2>
                <p><i class="fas fa-envelope me-2"></i><?php echo $_SESSION['user_id']; ?></p>
                <p><i class="fas fa-id-card me-2"></i>Membro desde: 15/03/2023</p>
                <p><i class="fas fa-shield-alt me-2"></i>Rank: <?php echo $_SESSION['user_name'] === 'Jin-Woo Sung' ? 'S-Rank' : 'A-Rank'; ?></p>
            </div>
            
            <div class="user-stats">
                <div class="user-stat">
                    <div class="user-stat-value">7</div>
                    <div class="user-stat-label">Missões Ativas</div>
                </div>
                <div class="user-stat">
                    <div class="user-stat-value">156</div>
                    <div class="user-stat-label">XP Total</div>
                </div>
                <div class="user-stat">
                    <div class="user-stat-value">23</div>
                    <div class="user-stat-label">Conquistas</div>
                </div>
                <div class="user-stat">
                    <div class="user-stat-value">89%</div>
                    <div class="user-stat-label">Taxa Vitória</div>
                </div>
            </div>
        </div>
        
        <!-- Missões Ativas -->
        <h3 class="section-title">
            <i class="fas fa-tasks me-2"></i>Missões de Leitura Ativas
        </h3>
        
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="book-card">
                    <div class="book-cover">
                        <i class="fas fa-scroll"></i>
                    </div>
                    <h4 class="book-title">Sistema de Dupla Ascensão</h4>
                    <p class="book-author">por Arcano Desconhecido</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="book-status status-borrowed">Em Missão</span>
                        <small>Conclusão: 25/10/2023</small>
                    </div>
                    <div class="action-buttons">
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-sync me-1"></i>Renovar
                        </button>
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-info me-1"></i>Detalhes
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="book-card">
                    <div class="book-cover">
                        <i class="fas fa-book-dead"></i>
                    </div>
                    <h4 class="book-title">Arte da Guerra das Sombras</h4>
                    <p class="book-author">por Igris - Comandante</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="book-status status-overdue">Missão Crítica</span>
                        <small>Conclusão: 15/10/2023</small>
                    </div>
                    <div class="action-buttons">
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-flag me-1"></i>Reportar
                        </button>
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-info me-1"></i>Detalhes
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="book-card">
                    <div class="book-cover">
                        <i class="fas fa-dragon"></i>
                    </div>
                    <h4 class="book-title">Domínio de Portais Avançado</h4>
                    <p class="book-author">por Associação de Caçadores</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="book-status status-borrowed">Em Missão</span>
                        <small>Conclusão: 30/10/2023</small>
                    </div>
                    <div class="action-buttons">
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-sync me-1"></i>Renovar
                        </button>
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-info me-1"></i>Detalhes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Histórico de Missões -->
        <h3 class="section-title">
            <i class="fas fa-history me-2"></i>Histórico de Missões
        </h3>
        
        <div class="book-card">
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Tomo</th>
                            <th>Início Missão</th>
                            <th>Conclusão</th>
                            <th>Status</th>
                            <th>XP Ganho</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Manual do Sistema</td>
                            <td>10/08/2023</td>
                            <td>25/08/2023</td>
                            <td><span class="book-status status-available">Concluído</span></td>
                            <td><strong style="color: var(--highlight);">+15 XP</strong></td>
                        </tr>
                        <tr>
                            <td>Rank S: Lendas</td>
                            <td>05/09/2023</td>
                            <td>20/09/2023</td>
                            <td><span class="book-status status-available">Concluído</span></td>
                            <td><strong style="color: var(--highlight);">+25 XP</strong></td>
                        </tr>
                        <tr>
                            <td>Guildas e Estratégia</td>
                            <td>01/10/2023</td>
                            <td>16/10/2023</td>
                            <td><span class="book-status status-available">Concluído</span></td>
                            <td><strong style="color: var(--highlight);">+18 XP</strong></td>
                        </tr>
                        <tr>
                            <td>Domínio de Habilidades</td>
                            <td>18/09/2023</td>
                            <td>02/10/2023</td>
                            <td><span class="book-status status-available">Concluído</span></td>
                            <td><strong style="color: var(--highlight);">+22 XP</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Próximas Missões -->
        <h3 class="section-title">
            <i class="fas fa-bullseye me-2"></i>Próximas Missões Recomendadas
        </h3>
        
        <div class="row">
            <div class="col-md-6">
                <div class="book-card">
                    <h4 class="book-title">Domínio das Sombras: Nível 2</h4>
                    <p class="book-author">Técnicas Avançadas de Invocação</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="book-status status-available">Disponível</span>
                        <strong style="color: var(--highlight);">Recompensa: 30 XP</strong>
                    </div>
                    <div class="action-buttons">
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-play me-1"></i>Iniciar Missão
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="book-card">
                    <h4 class="book-title">Análise de Dungeons R-rank</h4>
                    <p class="book-author">Estratégias de Sobrevivência</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="book-status status-available">Disponível</span>
                        <strong style="color: var(--highlight);">Recompensa: 25 XP</strong>
                    </div>
                    <div class="action-buttons">
                        <button class="btn btn-glow btn-sm">
                            <i class="fas fa-play me-1"></i>Iniciar Missão
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> - <?php echo SITE_NAME; ?></p>
            <p class="small">Continue sua jornada de conhecimento, Caçador</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>