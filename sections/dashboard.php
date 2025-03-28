<div class="content-section active" id="dashboard">
    <div class="dashboard-header">
        <h1>Tableau de Bord</h1>
        <p>Bienvenue dans votre système de gestion de stock</p>
    </div>
    
    <div class="dashboard-card">
        <h2 class="card-title">Aperçu du Stock</h2>
        <div class="card-content">
            <div class="stats-container">
                <div class="stats-card blue">
                    <h3>Total Produits</h3>
                    <p class="stats-value"><?php echo $total_produits ?? 0; ?></p>
                </div>
                <div class="stats-card green">
                    <h3>Fournisseurs</h3>
                    <p class="stats-value"><?php echo $total_fournisseurs ?? 0; ?></p>
                </div>
                <div class="stats-card purple">
                    <h3>Catégories</h3>
                    <p class="stats-value"><?php echo $total_categories ?? 0; ?></p>
                </div>
                <div class="stats-card orange">
                    <h3>Alertes Stock</h3>
                    <p class="stats-value"><?php echo $produits_alerte ?? 0; ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="dashboard-card">
        <h2 class="card-title">Dernières Entrées</h2>
        <div class="card-content">
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($dernieres_entrees) && count($dernieres_entrees) > 0): ?>
                        <?php foreach($dernieres_entrees as $entree): ?>
                        <tr>
                            <td><?php echo e($entree['produit_nom']); ?></td>
                            <td><?php echo e($entree['quantite']); ?></td>
                            <td><?php echo e($entree['prix']); ?> €</td>
                            <td><?php echo date('d/m/Y', strtotime($entree['date_entree'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">Aucune entrée enregistrée</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>