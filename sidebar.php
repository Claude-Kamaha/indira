<!-- Sidebar Navigation -->
<div class="sidebar">
    <div class="sidebar-header">
        <h2>Gestion Stock</h2>
    </div>
    <div class="sidebar-menu">
        <div class="menu-item <?php echo (!isset($_GET['section']) || $_GET['section'] == 'dashboard') ? 'active' : ''; ?>" data-section="dashboard">
            <a href="index.php?section=dashboard">
                <i class="menu-icon">📊</i> Dashboard
            </a>
        </div>
        <div class="menu-item <?php echo (isset($_GET['section']) && $_GET['section'] == 'fournisseurs') ? 'active' : ''; ?>" data-section="fournisseurs">
            <a href="index.php?section=fournisseurs">
                <i class="menu-icon">🏢</i> Fournisseurs
            </a>
        </div>
        <div class="menu-item <?php echo (isset($_GET['section']) && $_GET['section'] == 'categories') ? 'active' : ''; ?>" data-section="categories">
            <a href="index.php?section=categories">
                <i class="menu-icon">🏷️</i> Catégories
            </a>
        </div>
        <div class="menu-item" data-target="produits-submenu">
            <i class="menu-icon">📦</i> Produits
        </div>
        <div class="submenu" id="produits-submenu">
            <div class="submenu-item <?php echo (isset($_GET['section']) && $_GET['section'] == 'ajouter-produit') ? 'active' : ''; ?>" data-section="ajouter-produit">
                <a href="index.php?section=ajouter-produit">
                    <i class="menu-icon">➕</i> Ajouter Produit
                </a>
            </div>
            <div class="submenu-item <?php echo (isset($_GET['section']) && $_GET['section'] == 'liste-produits') ? 'active' : ''; ?>" data-section="liste-produits">
                <a href="index.php?section=liste-produits">
                    <i class="menu-icon">📋</i> Liste des Produits
                </a>
            </div>
            <div class="submenu-item <?php echo (isset($_GET['section']) && $_GET['section'] == 'entrees-sorties') ? 'active' : ''; ?>" data-section="entrees-sorties">
                <a href="index.php?section=entrees-sorties">
                    <i class="menu-icon">🔄</i> Entrées/Sorties
                </a>
            </div>
        </div>
        <div class="menu-item <?php echo (isset($_GET['section']) && $_GET['section'] == 'inventaire') ? 'active' : ''; ?>" data-section="inventaire">
            <a href="index.php?section=inventaire">
                <i class="menu-icon">🔍</i> Inventaire
            </a>
        </div>
        <div class="menu-item <?php echo (isset($_GET['section']) && $_GET['section'] == 'utilisateurs') ? 'active' : ''; ?>">
            <a href="index.php?section=utilisateurs">
                <i class="menu-icon">👤</i> Utilisateurs
            </a> 
        </div>
    </div>
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">D</div>
            <div class="user-name">Deconnexion</div>
        </div>
    </div>
</div>