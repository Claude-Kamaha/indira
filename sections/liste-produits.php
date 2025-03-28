
<div class="content-section" id="liste-produits">
            <div class="dashboard-header">
                <h1>Liste des Produits</h1>
            </div>
            
            <div class="filter-bar">
                <form method="GET" action="" id="filter-form">
                    <label for="categorie-filter">Filtrer par catégorie:</label>
                    <select id="categorie-filter" name="categorie" onchange="document.getElementById('filter-form').submit()">
                        <option value="0">Toutes les catégories</option>
                        <?php foreach($categories as $categorie): ?>
                        <option value="<?php echo $categorie['id']; ?>" <?php echo ($categorie_filter == $categorie['id']) ? 'selected' : ''; ?>>
                            <?php echo e($categorie['nom']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="section" value="liste-produits">
                </form>
            </div>
            
            <div class="dashboard-card">
                <div class="card-content">
                    <table id="liste-produits-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Quantité</th>
                                <th>Prix</th>
                                <th>Marque</th>
                                <th>Fournisseur</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $where = "";
                                $params = [];
                                
                                if ($categorie_filter > 0) {
                                    $where = " WHERE p.categorie_id = ?";
                                    $params = [$categorie_filter];
                                }
                                
                                $stmt = $conn->prepare("SELECT p.*, f.nom as fournisseur_nom, c.nom as categorie_nom 
                                                       FROM Produits p 
                                                       LEFT JOIN Fournisseurs f ON p.fournisseur_id = f.id 
                                                       LEFT JOIN Categories c ON p.categorie_id = c.id
                                                       $where
                                                       ORDER BY p.id DESC");
                                $stmt->execute($params);
                                $produits_liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                if (count($produits_liste) > 0) {
                                    foreach($produits_liste as $produit) {
                                        $produit_id = $produit['id'];
                                        
                                        echo "<tr id='produit-row-{$produit_id}' class='data-row'>";
                                        echo "<td>" . e($produit['id']) . "</td>";
                                        echo "<td>" . e($produit['nom']) . "</td>";
                                        echo "<td>" . e($produit['categorie_nom'] ?? 'Non définie') . "</td>";
                                        echo "<td>" . e($produit['quantite']) . "</td>";
                                        echo "<td>" . e($produit['prix']) . " €</td>";
                                        echo "<td>" . e($produit['marque']) . "</td>";
                                        echo "<td>" . e($produit['fournisseur_nom'] ?? 'Non défini') . "</td>";
                                        echo "<td>";
                                        echo "<button type='button' class='btn-edit' data-id='{$produit_id}' data-type='produit'>Modifier</button> ";
                                        echo "<button type='button' class='btn-delete' onclick=\"confirmerSuppression('produit_id', {$produit_id}, 'delete_produit')\">Supprimer</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                        
                                        // Formulaire d'édition (caché par défaut)
                                        echo "<tr id='edit-form-produit-{$produit_id}' class='edit-row'>";
                                        echo "<td colspan='8'>";
                                        echo "<div class='form-editer'>";
                                        echo "<form method='POST' action=''>";
                                        echo "<input type='hidden' name='produit_id' value='{$produit_id}'>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='nom_produit_{$produit_id}'>Nom</label>";
                                        echo "<input type='text' id='nom_produit_{$produit_id}' name='nom_produit' value='" . e($produit['nom']) . "' required>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='description_produit_{$produit_id}'>Description</label>";
                                        echo "<textarea id='description_produit_{$produit_id}' name='description_produit' rows='3'>" . e($produit['description']) . "</textarea>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='prix_produit_{$produit_id}'>Prix</label>";
                                        echo "<input type='number' id='prix_produit_{$produit_id}' name='prix_produit' min='0' step='0.01' value='" . e($produit['prix']) . "' required>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='marque_produit_{$produit_id}'>Marque</label>";
                                        echo "<input type='text' id='marque_produit_{$produit_id}' name='marque_produit' value='" . e($produit['marque']) . "'>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='categorie_produit_{$produit_id}'>Catégorie</label>";
                                        echo "<select id='categorie_produit_{$produit_id}' name='categorie_produit'>";
                                        echo "<option value=''>Sélectionner une catégorie</option>";
                                        
                                        foreach($categories as $categorie) {
                                            $selected = ($categorie['id'] == $produit['categorie_id']) ? 'selected' : '';
                                            echo "<option value='" . $categorie['id'] . "' {$selected}>" . e($categorie['nom']) . "</option>";
                                        }
                                        
                                        echo "</select>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='fournisseur_produit_{$produit_id}'>Fournisseur</label>";
                                        echo "<select id='fournisseur_produit_{$produit_id}' name='fournisseur_produit'>";
                                        echo "<option value=''>Sélectionner un fournisseur</option>";
                                        
                                        foreach($fournisseurs as $fournisseur) {
                                            $selected = ($fournisseur['id'] == $produit['fournisseur_id']) ? 'selected' : '';
                                            echo "<option value='" . $fournisseur['id'] . "' {$selected}>" . e($fournisseur['nom']) . "</option>";
                                        }
                                        
                                        echo "</select>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<p>Note: La quantité ne peut être modifiée que via les entrées/sorties ou l'inventaire.</p>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-actions'>";
                                        echo "<button type='button' class='btn-cancel' data-id='{$produit_id}' data-type='produit'>Annuler</button>";
                                        echo "<button type='submit' name='update_produit'>Enregistrer</button>";
                                        echo "</div>";
                                        
                                        echo "</form>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8' style='text-align: center;'>Aucun produit trouvé</td></tr>";
                                }
                            } catch(PDOException $e) {
                                echo "<tr><td colspan='8' style='text-align: center;'>Erreur: " . $e->getMessage() . "</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>