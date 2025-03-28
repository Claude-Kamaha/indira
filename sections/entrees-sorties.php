<div class="content-section" id="entrees-sorties">
            <div class="dashboard-header">
                <h1>Gestion des Entrées et Sorties</h1>
            </div>
            
            <div class="tabs">
                <div class="tab active" data-tab="entrees">Entrées de Stock</div>
                <div class="tab" data-tab="sorties">Sorties de Stock</div>
                <div class="tab" data-tab="historique">Historique</div>
            </div>
            
            <!-- Entrées de Stock -->
            <div class="tab-content active" id="entrees">
                <div class="dashboard-card">
                    <h2 class="card-title">Nouvelle Entrée de Stock</h2>
                    <div class="card-content">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="produit_entree">Produit</label>
                                <select id="produit_entree" name="produit_entree" required>
                                    <option value="">Sélectionner un produit</option>
                                    <?php foreach($produits as $produit): ?>
                                    <option value="<?php echo $produit['id']; ?>"><?php echo e($produit['nom']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantite_entree">Quantité</label>
                                <input type="number" id="quantite_entree" name="quantite_entree" min="1" required>
                            </div>
                            <div class="form-group">
                                <label for="prix_entree">Prix unitaire</label>
                                <input type="number" id="prix_entree" name="prix_entree" min="0" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="date_entree">Date d'entrée</label>
                                <input type="date" id="date_entree" name="date_entree" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <button type="submit" name="submit_entree">Enregistrer l'entrée</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Sorties de Stock -->
            <div class="tab-content" id="sorties">
                <div class="dashboard-card">
                    <h2 class="card-title">Nouvelle Sortie de Stock</h2>
                    <div class="card-content">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="produit_sortie">Produit</label>
                                <select id="produit_sortie" name="produit_sortie" required>
                                    <option value="">Sélectionner un produit</option>
                                    <?php foreach($produits as $produit): ?>
                                    <option value="<?php echo $produit['id']; ?>"><?php echo e($produit['nom'] . ' - Stock: ' . $produit['quantite']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantite_sortie">Quantité</label>
                                <input type="number" id="quantite_sortie" name="quantite_sortie" min="1" required>
                            </div>
                            <div class="form-group">
                                <label for="prix_sortie">Prix unitaire de vente</label>
                                <input type="number" id="prix_sortie" name="prix_sortie" min="0" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="date_sortie">Date de sortie</label>
                                <input type="date" id="date_sortie" name="date_sortie" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <button type="submit" name="submit_sortie">Enregistrer la sortie</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Historique des Entrées/Sorties -->
            <div class="tab-content" id="historique">
                <div class="dashboard-card">
                    <h2 class="card-title">Historique des Entrées</h2>
                    <div class="card-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {
                                    $stmt = $conn->query("SELECT e.*, p.nom as produit_nom 
                                                        FROM Entrees e 
                                                        JOIN Produits p ON e.produit_id = p.id 
                                                        ORDER BY e.date_entree DESC LIMIT 10");
                                    $entrees = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    if (count($entrees) > 0) {
                                        foreach($entrees as $entree) {
                                            echo "<tr>";
                                            echo "<td>" . e($entree['id']) . "</td>";
                                            echo "<td>" . e($entree['produit_nom']) . "</td>";
                                            echo "<td>" . e($entree['quantite']) . "</td>";
                                            echo "<td>" . e($entree['prix']) . " €</td>";
                                            echo "<td>" . date('d/m/Y', strtotime($entree['date_entree'])) . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' style='text-align: center;'>Aucune entrée trouvée</td></tr>";
                                    }
                                } catch(PDOException $e) {
                                    echo "<tr><td colspan='5' style='text-align: center;'>Erreur: " . $e->getMessage() . "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="dashboard-card">
                    <h2 class="card-title">Historique des Sorties</h2>
                    <div class="card-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {
                                    $stmt = $conn->query("SELECT s.*, p.nom as produit_nom 
                                                        FROM Sorties s 
                                                        JOIN Produits p ON s.produit_id = p.id 
                                                        ORDER BY s.date_sortie DESC LIMIT 10");
                                    $sorties = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    if (count($sorties) > 0) {
                                        foreach($sorties as $sortie) {
                                            echo "<tr>";
                                            echo "<td>" . e($sortie['id']) . "</td>";
                                            echo "<td>" . e($sortie['produit_nom']) . "</td>";
                                            echo "<td>" . e($sortie['quantite']) . "</td>";
                                            echo "<td>" . e($sortie['prix']) . " €</td>";
                                            echo "<td>" . date('d/m/Y', strtotime($sortie['date_sortie'])) . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' style='text-align: center;'>Aucune sortie trouvée</td></tr>";
                                    }
                                } catch(PDOException $e) {
                                    echo "<tr><td colspan='5' style='text-align: center;'>Erreur: " . $e->getMessage() . "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>