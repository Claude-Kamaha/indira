
<div class="content-section" id="categories">
            <div class="dashboard-header">
                <h1>Gestion des Catégories</h1>
            </div>
            
            <div class="dashboard-card">
                <h2 class="card-title">Ajouter une Catégorie</h2>
                <div class="card-content">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="nom_categorie">Nom</label>
                            <input type="text" id="nom_categorie" name="nom_categorie" required>
                        </div>
                        <div class="form-group">
                            <label for="description_categorie">Description</label>
                            <textarea id="description_categorie" name="description_categorie" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit_categorie">Enregistrer</button>
                    </form>
                </div>
            </div>
            
            <div class="dashboard-card">
                <h2 class="card-title">Liste des Catégories</h2>
                <div class="card-content">
                    <table id="liste-categories">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $stmt = $conn->query("SELECT * FROM Categories ORDER BY nom");
                                $categories_liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                if (count($categories_liste) > 0) {
                                    foreach($categories_liste as $categorie) {
                                        $categorie_id = $categorie['id'];
                                        
                                        echo "<tr id='categorie-row-{$categorie_id}' class='data-row'>";
                                        echo "<td>" . e($categorie['id']) . "</td>";
                                        echo "<td>" . e($categorie['nom']) . "</td>";
                                        echo "<td>" . e($categorie['description']) . "</td>";
                                        echo "<td>";
                                        echo "<button type='button' class='btn-edit' data-id='{$categorie_id}' data-type='categorie'>Modifier</button> ";
                                        echo "<button type='button' class='btn-delete' onclick=\"confirmerSuppression('categorie_id', {$categorie_id}, 'delete_categorie')\">Supprimer</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                        
                                        // Formulaire d'édition (caché par défaut)
                                        echo "<tr id='edit-form-categorie-{$categorie_id}' class='edit-row'>";
                                        echo "<td colspan='4'>";
                                        echo "<div class='form-editer'>";
                                        echo "<form method='POST' action=''>";
                                        echo "<input type='hidden' name='categorie_id' value='{$categorie_id}'>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='nom_categorie_{$categorie_id}'>Nom</label>";
                                        echo "<input type='text' id='nom_categorie_{$categorie_id}' name='nom_categorie' value='" . e($categorie['nom']) . "' required>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='description_categorie_{$categorie_id}'>Description</label>";
                                        echo "<textarea id='description_categorie_{$categorie_id}' name='description_categorie' rows='3'>" . e($categorie['description']) . "</textarea>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-actions'>";
                                        echo "<button type='button' class='btn-cancel' data-id='{$categorie_id}' data-type='categorie'>Annuler</button>";
                                        echo "<button type='submit' name='update_categorie'>Enregistrer</button>";
                                        echo "</div>";
                                        
                                        echo "</form>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4' style='text-align: center;'>Aucune catégorie trouvée</td></tr>";
                                }
                            } catch(PDOException $e) {
                                echo "<tr><td colspan='4' style='text-align: center;'>Erreur: " . $e->getMessage() . "</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>