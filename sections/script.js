// document.addEventListener("DOMContentLoaded", function () {
//   // Handle menu clicks
//   const menuItems = document.querySelectorAll(".menu-item, .submenu-item");

//   menuItems.forEach((item) => {
//     item.addEventListener("click", function () {
//       // Handle submenu toggling
//       if (this.dataset.target) {
//         this.classList.toggle("active");
//         return;
//       }

//       // Handle section navigation
//       if (this.dataset.section) {
//         // Remove active class from all menu items
//         menuItems.forEach((mi) => mi.classList.remove("active"));

//         // Add active class to clicked menu item
//         this.classList.add("active");

//         // Hide all sections
//         document.querySelectorAll(".content-section").forEach((section) => {
//           section.classList.remove("active");
//         });

//         // Show selected section
//         const targetSection = document.getElementById(this.dataset.section);
//         if (targetSection) {
//           targetSection.classList.add("active");
//         }
//       }
//     });
//   });

//   // Handle tab clicks
//   const tabs = document.querySelectorAll(".tab");

//   tabs.forEach((tab) => {
//     tab.addEventListener("click", function () {
//       // Remove active class from all tabs
//       tabs.forEach((t) => t.classList.remove("active"));

//       // Add active class to clicked tab
//       this.classList.add("active");

//       // Hide all tab content
//       document.querySelectorAll(".tab-content").forEach((content) => {
//         content.classList.remove("active");
//       });

//       // Show selected tab content
//       const targetContent = document.getElementById(this.dataset.tab);
//       if (targetContent) {
//         targetContent.classList.add("active");
//       }
//     });
//   });

//   // Open products submenu by default
//   const productsMenuItem = document.querySelector(
//     '[data-target="produits-submenu"]'
//   );
//   productsMenuItem.classList.add("active");

//   // Gestion des boutons Modifier
//   document.querySelectorAll(".btn-edit").forEach((button) => {
//     button.addEventListener("click", function () {
//       const id = this.getAttribute("data-id");
//       const type = this.getAttribute("data-type");
//       toggleEditForm(id, type);
//     });
//   });

//   // Gestion des boutons Annuler dans les formulaires
//   document.querySelectorAll(".btn-cancel").forEach((button) => {
//     button.addEventListener("click", function () {
//       const id = this.getAttribute("data-id");
//       const type = this.getAttribute("data-type");
//       toggleEditForm(id, type);
//     });
//   });

//   // Configuration du formulaire de suppression
//   document
//     .getElementById("cancel-delete")
//     .addEventListener("click", function () {
//       hideConfirmation();
//     });

//   document
//     .getElementById("confirmation-overlay")
//     .addEventListener("click", function () {
//       hideConfirmation();
//     });

//   document
//     .getElementById("confirm-delete")
//     .addEventListener("click", function () {
//       const deleteForm = document.getElementById("delete-form");
//       deleteForm.submit();
//     });
// });

// // Fonction pour afficher/masquer les formulaires d'édition
// function toggleEditForm(id, type) {
//   // Fermer tous les formulaires ouverts d'abord
//   document.querySelectorAll(".edit-row").forEach((row) => {
//     row.style.display = "none";
//   });

//   document.querySelectorAll(".data-row").forEach((row) => {
//     row.classList.remove("ligne-edit");
//   });

//   // Afficher ou masquer le formulaire sélectionné
//   const formRow = document.getElementById(`edit-form-${type}-${id}`);
//   const dataRow = document.getElementById(`${type}-row-${id}`);

//   if (formRow && dataRow) {
//     // Si le formulaire est déjà visible, le masquer
//     if (formRow.style.display === "table-row") {
//       formRow.style.display = "none";
//       dataRow.classList.remove("ligne-edit");
//     } else {
//       // Sinon, l'afficher
//       formRow.style.display = "table-row";
//       dataRow.classList.add("ligne-edit");

//       // S'assurer que le formulaire à l'intérieur est visible
//       const formElement = formRow.querySelector(".form-editer");
//       if (formElement) {
//         formElement.style.display = "block";
//       }
//     }
//   }
// }

// // Fonctions pour la confirmation de suppression
// function confirmerSuppression(idField, id, submitName) {
//   // Préparer le formulaire de suppression
//   const deleteForm = document.getElementById("delete-form");

//   // Vider le formulaire
//   while (deleteForm.firstChild) {
//     deleteForm.removeChild(deleteForm.firstChild);
//   }

//   // Ajouter le champ ID
//   const idInput = document.createElement("input");
//   idInput.type = "hidden";
//   idInput.name = idField;
//   idInput.value = id;
//   deleteForm.appendChild(idInput);

//   // Ajouter le bouton de soumission
//   const submitInput = document.createElement("input");
//   submitInput.type = "hidden";
//   submitInput.name = submitName;
//   submitInput.value = "1";
//   deleteForm.appendChild(submitInput);

//   // Afficher la confirmation
//   document.getElementById("confirmation-overlay").style.display = "block";
//   document.getElementById("confirmation-box").style.display = "block";
// }

// function hideConfirmation() {
//   document.getElementById("confirmation-overlay").style.display = "none";
//   document.getElementById("confirmation-box").style.display = "none";
// }

document.addEventListener("DOMContentLoaded", function () {
  // Handle menu clicks
  const menuItems = document.querySelectorAll(".menu-item, .submenu-item");

  menuItems.forEach((item) => {
    item.addEventListener("click", function () {
      // Handle submenu toggling
      if (this.dataset.target) {
        this.classList.toggle("active");
        return;
      }

      // Handle section navigation
      if (this.dataset.section) {
        // Remove active class from all menu items
        menuItems.forEach((mi) => mi.classList.remove("active"));

        // Add active class to clicked menu item
        this.classList.add("active");

        // Hide all sections
        document.querySelectorAll(".content-section").forEach((section) => {
          section.classList.remove("active");
        });

        // Show selected section
        const targetSection = document.getElementById(this.dataset.section);
        if (targetSection) {
          targetSection.classList.add("active");
        }
      }
    });
  });

  // Handle tab clicks
  const tabs = document.querySelectorAll(".tab");

  tabs.forEach((tab) => {
    tab.addEventListener("click", function () {
      // Remove active class from all tabs
      tabs.forEach((t) => t.classList.remove("active"));

      // Add active class to clicked tab
      this.classList.add("active");

      // Hide all tab content
      document.querySelectorAll(".tab-content").forEach((content) => {
        content.classList.remove("active");
      });

      // Show selected tab content
      const targetContent = document.getElementById(this.dataset.tab);
      if (targetContent) {
        targetContent.classList.add("active");
      }
    });
  });

  // Open products submenu by default
  const productsMenuItem = document.querySelector(
    '[data-target="produits-submenu"]'
  );
  productsMenuItem.classList.add("active");

  // Gestion des boutons Modifier
  document.querySelectorAll(".btn-edit").forEach((button) => {
    button.addEventListener("click", function () {
      const id = this.getAttribute("data-id");
      const type = this.getAttribute("data-type");
      toggleEditForm(id, type);
    });
  });

  // Gestion des boutons Annuler dans les formulaires
  document.querySelectorAll(".btn-cancel").forEach((button) => {
    button.addEventListener("click", function () {
      const id = this.getAttribute("data-id");
      const type = this.getAttribute("data-type");
      toggleEditForm(id, type);
    });
  });

  // Configuration du formulaire de suppression
  document
    .getElementById("cancel-delete")
    .addEventListener("click", function () {
      hideConfirmation();
    });

  document
    .getElementById("confirmation-overlay")
    .addEventListener("click", function () {
      hideConfirmation();
    });

  document
    .getElementById("confirm-delete")
    .addEventListener("click", function () {
      const deleteForm = document.getElementById("delete-form");
      deleteForm.submit();
    });
});

// Fonction pour afficher/masquer les formulaires d'édition
function toggleEditForm(id, type) {
  // Fermer tous les formulaires ouverts d'abord
  document.querySelectorAll(".edit-row").forEach((row) => {
    row.style.display = "none";
  });

  document.querySelectorAll(".data-row").forEach((row) => {
    row.classList.remove("ligne-edit");
  });

  // Afficher ou masquer le formulaire sélectionné
  const formRow = document.getElementById(`edit-form-${type}-${id}`);
  const dataRow = document.getElementById(`${type}-row-${id}`);

  if (formRow && dataRow) {
    // Si le formulaire est déjà visible, le masquer
    if (formRow.style.display === "table-row") {
      formRow.style.display = "none";
      dataRow.classList.remove("ligne-edit");
    } else {
      // Sinon, l'afficher
      formRow.style.display = "table-row";
      dataRow.classList.add("ligne-edit");

      // S'assurer que le formulaire à l'intérieur est visible
      const formElement = formRow.querySelector(".form-editer");
      if (formElement) {
        formElement.style.display = "block";
      }
    }
  }
}

// Fonctions pour la confirmation de suppression
function confirmerSuppression(idField, id, submitName) {
  // Préparer le formulaire de suppression
  const deleteForm = document.getElementById("delete-form");

  // Vider le formulaire
  while (deleteForm.firstChild) {
    deleteForm.removeChild(deleteForm.firstChild);
  }

  // Ajouter le champ ID
  const idInput = document.createElement("input");
  idInput.type = "hidden";
  idInput.name = idField;
  idInput.value = id;
  deleteForm.appendChild(idInput);

  // Ajouter le bouton de soumission
  const submitInput = document.createElement("input");
  submitInput.type = "hidden";
  submitInput.name = submitName;
  submitInput.value = "1";
  deleteForm.appendChild(submitInput);

  // Afficher la confirmation
  document.getElementById("confirmation-overlay").style.display = "block";
  document.getElementById("confirmation-box").style.display = "block";
}

function hideConfirmation() {
  document.getElementById("confirmation-overlay").style.display = "none";
  document.getElementById("confirmation-box").style.display = "none";
}
