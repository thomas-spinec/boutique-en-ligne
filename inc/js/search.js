"use strict";

document.addEventListener("DOMContentLoaded", (event) => {
  const search = document.querySelector("#search");
  const matchList = document.querySelector("#matchList");
  const matchList2 = document.querySelector("#matchList2");

  //Cherche suggest.php et le filtre
  const searchProduct = async (searchText) => {
    const response = await fetch("inc/php/suggest.php");
    const product = await response.json();

    // Vérifie si le texte saisi correspond à un produit
    let matches = product.filter((title) => {
      // première proposition (le ^ désigne le premier caractère)
      const regex = new RegExp(`^${searchText}`, "gi");
      // Le premier argument de la fonction RegExp() est le motif de l'expression régulière utilisé pour rechercher des correspondances. Le second argument représente les options de l'expression régulière (ici 'gi' pour global et ignorer la casse).
      return title.title.match(regex);
    });
    // seconde proposition
    let matches2 = product.filter((title) => {
      const regex = new RegExp(`${searchText}`, "gi");
      return title.title.match(regex);
    });
    // Si le texte saisi est vide, on ne propose rien
    if (searchText.length === 0) {
      matches = [];
      matchList.innerHTML = "";
    }
    // Génère le html pour chaque valeur
    outputHtml(matches);
    outputHtml2(matches2);
  };

  // Renvoie le html pour chaque valeur
  const outputHtml = (matches) => {
    // Si il y a des résultats, on les affiche
    if (matches.length > 0) {
      // Réduit le nombre de résultats
      const html = matches
        .slice(0, 5)
        .map(
          (match) => `
                <li class="card card-body bg-dark mb-1">
                    <a class="text-decoration-none link-light" href="product.php?id=${match.id_product}">${match.title}</a>
                </li>
            `
        )
        .join("");
      matchList.innerHTML = html;
    }
  };

  const outputHtml2 = (matches) => {
    if (matches.length > 0) {
      const html = matches
        .slice(0, 5)
        .map(
          (match) => `
                <li class="card card-body text-white bg-secondary mb-1">
                    <a class="text-decoration-none link-light" href="product.php?id=${match.id_product}">${match.title}</a>
                </li>
            `
        )
        .join("");
      matchList2.innerHTML = html;
    }
  };

  const hideLists = () => {
    matchList.innerHTML = "";
    matchList2.innerHTML = "";
  };

  // Ecoute l'évènement keyup
  search.addEventListener("keyup", () => searchProduct(search.value));

  // Ecoute l'évènement keydown pour détecter la touche "Entrée"
  search.addEventListener("keydown", (event) => {
    if (event.keyCode === 13) {
      window.location.href = "search.php?search=" + search.value;
    }
  });

  search.addEventListener("blur", () => {
    hideLists();
  });
}); // Fin de l'écouteur d'évènement DOMContentLoaded
