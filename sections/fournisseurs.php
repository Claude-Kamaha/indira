<div class="content-section" id="fournisseurs">
            <div class="dashboard-header">
                <h1>Gestion des Fournisseurs</h1>
            </div>
            
            <div class="dashboard-card">
                <h2 class="card-title">Ajouter un Fournisseur</h2>
                <div class="card-content">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="nom_fournisseur">Nom</label>
                            <input type="text" id="nom_fournisseur" name="nom_fournisseur" required>
                        </div>
                        <div class="form-group">
                            <label for="contact_fournisseur">Contact</label>
                            <input type="text" id="contact_fournisseur" name="contact_fournisseur">
                        </div>
                        <div class="form-group">
                            <label for="adresse_fournisseur">Adresse</label>
                            <textarea id="adresse_fournisseur" name="adresse_fournisseur" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit_fournisseur">Enregistrer</button>
                    </form>
                </div>
            </div>
            
            <div class="dashboard-card">
                <h2 class="card-title">Liste des Fournisseurs</h2>
                <div class="card-content">
                    <table id="liste-fournisseurs">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Contact</th>
                                <th>Adresse</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $stmt = $conn->query("SELECT * FROM Fournisseurs ORDER BY id DESC");
                                $fournisseurs_liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                if (count($fournisseurs_liste) > 0) {
                                    foreach($fournisseurs_liste as $fournisseur) {
                                        $fournisseur_id = $fournisseur['id'];
                                        
                                        echo "<tr id='fournisseur-row-{$fournisseur_id}' class='data-row'>";
                                        echo "<td>" . e($fournisseur['id']) . "</td>";
                                        echo "<td>" . e($fournisseur['nom']) . "</td>";
                                        echo "<td>" . e($fournisseur['contact']) . "</td>";
                                        echo "<td>" . e($fournisseur['adresse']) . "</td>";
                                        echo "<td>";
                                        echo "<button type='button' class='btn-edit' data-id='{$fournisseur_id}' data-type='fournisseur'>Modifier</button> ";
                                        echo "<button type='button' class='btn-delete' onclick=\"confirmerSuppression('fournisseur_id', {$fournisseur_id}, 'delete_fournisseur')\">Supprimer</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                        
                                        // Formulaire d'édition (caché par défaut)
                                        echo "<tr id='edit-form-fournisseur-{$fournisseur_id}' class='edit-row'>";
                                        echo "<td colspan='5'>";
                                        echo "<div class='form-editer'>";
                                        echo "<form method='POST' action=''>";
                                        echo "<input type='hidden' name='fournisseur_id' value='{$fournisseur_id}'>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='nom_fournisseur_{$fournisseur_id}'>Nom</label>";
                                        echo "<input type='text' id='nom_fournisseur_{$fournisseur_id}' name='nom_fournisseur' value='" . e($fournisseur['nom']) . "' required>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='contact_fournisseur_{$fournisseur_id}'>Contact</label>";
                                        echo "<input type='text' id='contact_fournisseur_{$fournisseur_id}' name='contact_fournisseur' value='" . e($fournisseur['contact']) . "'>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='adresse_fournisseur_{$fournisseur_id}'>Adresse</label>";
                                        echo "<textarea id='adresse_fournisseur_{$fournisseur_id}' name='adresse_fournisseur' rows='3'>" . e($fournisseur['adresse']) . "</textarea>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-actions'>";
                                        echo "<button type='button' class='btn-cancel' data-id='{$fournisseur_id}' data-type='fournisseur'>Annuler</button>";
                                        echo "<button type='submit' name='update_fournisseur'>Enregistrer</button>";
                                        echo "</div>";
                                        
                                        echo "</form>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' style='text-align: center;'>Aucun fournisseur trouvé</td></tr>";
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