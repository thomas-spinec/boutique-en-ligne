document.addEventListener("DOMContentLoaded", function () {
  // ----------------------------------------------------------VARIABLES------------------------------------------------------
  //LIEN ONGLET//
  const users = document.querySelector("#users");
  const products = document.querySelector("#products");
  const categories = document.querySelector("#categories");
  const sizes = document.querySelector("#sizes");
  //SECTION D'AFFICHAGE//
  const display = document.querySelector("#display");
  const gestion = document.querySelector("#gestion");
  const popUp = document.querySelector("#popUp");
  // -----------------------------------------------------------FUNCTIONS-------------------------------------------------------

  // USERS//
  function displayUsers() {
    display.innerHTML = "";
    gestion.innerHTML = "";
    fetch("inc/php/templateAdmin.php?users")
      .then((response) => response.text())
      .then((table) => (display.innerHTML = table));
  }

  function deleteUsers(id) {
    fetch("inc/php/adminGestion.php?delUser=" + id)
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          displayUsers();
        } else {
          display.nextElementSibling.innerHTML = "Error during suppression";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  function changeRole(id) {
    const formRole = document.querySelector("#formRole");

    let data = new FormData(formRole);
    data.append("id", id);
    data.append("changeRole", "ok");
    fetch("inc/php/adminGestion.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          displayUsers();
        } else {
          display.nextElementSibling.innerHTML = "Error role didn't changed";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  //PRODUCTS//
  function displayProducts(categ) {
    if (categ === undefined) {
      categ = "";
    }

    display.innerHTML = "";
    gestion.innerHTML = "";
    fetch("inc/php/templateAdmin.php?products&categ=" + categ)
      .then((response) => response.text())
      .then((table) => (display.innerHTML = table));
    fetch("inc/php/templateAdmin.php?addProducts")
      .then((response) => response.text())
      .then((form) => (gestion.innerHTML = form));
  }

  function addSelectSize(sizeNb, div) {
    console.log(sizeNb);
    console.log(div);
    fetch("inc/php/templateAdmin.php?" + sizeNb)
      .then((response) => response.text())
      .then((response) => {
        // rajouter la response à la suite de target via son parent, puis supprimer le target
        div.innerHTML += response;
      });
  }

  function deleteProduct(id) {
    fetch("inc/php/adminGestion.php?delProduct=" + id)
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          displayProducts();
        } else {
          display.nextElementSibling.innerHTML = "Error during suppression";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  function addProduct() {
    const formProduct = document.querySelector("#formProduct");

    let data = new FormData(formProduct);
    data.append("addProduct", "ok");
    fetch("inc/php/adminGestion.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        console.log(response);
      });
  }

  //CATEGORIES//

  function displayCategories() {
    display.innerHTML = "";
    gestion.innerHTML = "";

    fetch("inc/php/templateAdmin.php?categories")
      .then((response) => response.text())
      .then((table) => (display.innerHTML = table));

    fetch("inc/php/templateAdmin.php?addCategories")
      .then((response) => response.text())
      .then((form) => (gestion.innerHTML = form));
  }

  function deleteCategory(id) {
    fetch("inc/php/adminGestion.php?delCategory=" + id)
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();
        if (response === "ok") {
          displayCategories();
        } else {
          display.nextElementSibling.innerHTML = "Error during suppression";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  function addCategories() {
    const formAddCateg = document.querySelector("#addCategories");
    let data = new FormData(formAddCateg);
    console.log(data);
    data.append("addCategories", "ok");
    fetch("inc/php/adminGestion.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        response = response.trim();

        if (response === "ok") {
          displayCategories();
        } else {
          display.nextElementSibling.innerHTML = "Error during suppression";
          setTimeout(() => {
            display.nextElementSibling.innerHTML = "";
          }, "2000");
        }
      });
  }

  // ----------------------------------------------------------FUNCTIONS CALL--------------------------------------------------

  //USERS//
  users.addEventListener("click", function (e) {
    e.preventDefault();
    displayUsers();
  });

  display.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("delUser")) {
      const id = e.target.getAttribute("data-id");
      deleteUsers(id);
    }
  });

  display.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("changeDroit")) {
      const id = e.target.getAttribute("data-id");
      changeRole(id);
    }
  });

  //PRODUCT//

  products.addEventListener("click", function (e) {
    e.preventDefault();
    displayProducts();
  });

  display.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("delProduct")) {
      const idProduct = e.target.getAttribute("data-id");
      deleteProduct(idProduct);
    }
  });

  display.addEventListener("change", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("displayStock")) {
      const idProduct = e.target.getAttribute("data-id");
      const idSize = e.target.value;
      const stock = e.target.parentNode.nextElementSibling;
      fetch(
        "inc/php/adminGestion.php?getStock&idProduct=" +
          idProduct +
          "&idSize=" +
          idSize
      )
        .then((response) => response.json())
        .then((response) => {
          stock.innerHTML = response["stock"];
        });
    } else if (e.target.classList.contains("filterCateg")) {
      const idCategory = e.target.value;
      displayProducts(idCategory);
    }
  });

  gestion.addEventListener("click", function (e) {
    if (e.target.classList.contains("submitAdd")) {
      e.preventDefault();
      addProduct();
    }
    // ajout d'une taille
    else if (e.target.classList.contains("addSize")) {
      e.preventDefault();
      const target = e.target;
      // récupération du parent de target
      const div = target.parentNode;
      const sizeNb = e.target.getAttribute("data-id");
      div.removeChild(target);
      addSelectSize(sizeNb, div);
    }
  });

  // si on sélectionne une taille sur un select, on ne doit pas pouvoir sélectionner la même taille sur les autres selects
  gestion.addEventListener("change", function (e) {
    if (e.target.classList.contains("selectSize")) {
      const target = e.target;
      const div = target.parentNode;
      const selectSize = div.querySelectorAll(".selectSize");
      const size = [];
      // on récupère la valeur de chaque select dans des variables différentes
      for (let i = 0; i < selectSize.length; i++) {
        size[i] = selectSize[i].value;
      }
      // on parcourt les options de chaque select et on les désactive si la valeur de l'option est dans le tableau size
      for (let i = 0; i < selectSize.length; i++) {
        const options = selectSize[i].querySelectorAll("option");
        for (let j = 0; j < options.length; j++) {
          if (size.includes(options[j].value)) {
            options[j].hidden = true;
          } else {
            options[j].hidden = false;
          }
        }
      }
    }
  });

  //CATEGORIES//

  categories.addEventListener("click", function (e) {
    e.preventDefault();
    displayCategories();
  });

  display.addEventListener("click", function (e) {
    e.preventDefault();
    if (e.target.classList.contains("delCategory")) {
      const idCategory = e.target.getAttribute("data-id");
      deleteCategory(idCategory);
    }
  });

  //ajout de categories
  gestion.addEventListener("click", function (e) {
    e.preventDefault();

    if (e.target.classList.contains("validate")) {
      e.preventDefault();
      addCategories();
    }
  });

  // Size (en plus, sera supp)//
  sizes.addEventListener("click", function (e) {
    e.preventDefault();
    fetch("inc/php/adminGestion.php?sizes")
      .then((response) => response.text())
      .then((response) => {
        console.log(response);
      });
  });
});
