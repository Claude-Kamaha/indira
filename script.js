document.addEventListener('DOMContentLoaded', function() {
    // Toggle submenu
    const productsMenuItem = document.querySelector('.menu-item[data-target="produits-submenu"]');
    const produitsSubmenu = document.getElementById('produits-submenu');
    console.log("productsMenuItem", productsMenuItem);
    console.log("produitsSubmenu", produitsSubmenu);
    if (productsMenuItem && produitsSubmenu) {
        productsMenuItem.addEventListener('click', function(event) {
            // Basculer l'affichage du sous-menu
            console.log("produitsSubmenu.style.display", produitsSubmenu.style.display);
            
            if (produitsSubmenu.style.display === 'block') {
                produitsSubmenu.style.display = 'none';
            } else {
                produitsSubmenu.style.display = 'block';
            }
        });
    }

    // Edit buttons functionality
    const editButtons = document.querySelectorAll('.btn-edit');
    const cancelButtons = document.querySelectorAll('.btn-cancel');

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const type = this.getAttribute('data-type');
            
            // Hide current row, show edit form
            const currentRow = document.getElementById(`${type}-row-${id}`);
            const editForm = document.getElementById(`edit-form-${type}-${id}`);
            
            if (currentRow && editForm) {
                currentRow.style.display = 'none';
                editForm.style.display = 'table-row';
            }
        });
    });

    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const type = this.getAttribute('data-type');
            
            // Hide edit form, show current row
            const currentRow = document.getElementById(`${type}-row-${id}`);
            const editForm = document.getElementById(`edit-form-${type}-${id}`);
            
            if (currentRow && editForm) {
                currentRow.style.display = 'table-row';
                editForm.style.display = 'none';
            }
        });
    });

    // Confirmation modal for deletion
    const confirmationOverlay = document.getElementById('confirmation-overlay');
    const confirmationBox = document.getElementById('confirmation-box');
    const cancelDeleteBtn = document.getElementById('cancel-delete');
    const confirmDeleteBtn = document.getElementById('confirm-delete');
    const deleteForm = document.getElementById('delete-form');

    // Function to show confirmation modal
    window.confirmerSuppression = function(idField, id, deleteType) {
        confirmationOverlay.style.display = 'block';
        confirmationBox.style.display = 'block';

        // Set up confirm delete action
        confirmDeleteBtn.onclick = function() {
            document.getElementById('delete-id').value = id;
            document.getElementById('delete-type').value = deleteType;
            deleteForm.submit();
        };
    };

    // Close confirmation modal
    // cancelDeleteBtn.addEventListener('click', function() {
    //     confirmationOverlay.style.display = 'none';
    //     confirmationBox.style.display = 'none';
    // });
});