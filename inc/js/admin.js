document.addEventListener("DOMContentLoaded", function(){
// ----------------------------------------------------------VARIABLES------------------------------------------------------
//LIEN ONGLET//
    const users = document.querySelector('#users');
    const products = document.querySelector('#products');
    const categories = document.querySelector('#categories');
//SECTION D'AFFICHAGE//
    const display = document.querySelector('#display');
    const gestion = document.querySelector('#gestion');
// -----------------------------------------------------------FUNCTIONS-------------------------------------------------------


// USERS//
function displayUsers(){
    display.innerHTML="";
    gestion.innerHTML="";
    fetch("inc/php/adminGestion.php?users")

    .then((response)=> response.text())
    .then((table)=>
    display.innerHTML = table)
}

//PRODUCTS//
function displayProducts(){
    display.innerHTML="";
    gestion.innerHTML="";
    fetch("inc/php/adminGestion.php?products")
    .then((response)=>response.text())
    .then((table)=>
    display.innerHTML=table
    );
    fetch("inc/php/adminGestion.php?addProducts")
    .then((response)=>response.text())
    .then((form)=>
    gestion.innerHTML=form);
}



//CATEGORIES//

function displayCategories(){
    display.innerHTML="";
    gestion.innerHTML="";

    fetch("inc/php/adminGestion.php?categories")
    .then((response)=>response.text())
    .then((table)=>
    display.innerHTML=table)

    fetch("inc/php/adminGestion.php?addCategories")
    .then((response)=>response.text())
    .then((form)=>
    gestion.innerHTML=form)

}




// ----------------------------------------------------------FUNCTIONS CALL--------------------------------------------------

//USERS//
users.addEventListener("click", function(e){
    e.preventDefault();
    displayUsers();
})


//PRODUCT//


products.addEventListener("click", function(e){
    e.preventDefault();
    displayProducts();
})





//CATEGORIES//

categories.addEventListener("click", function(e){
    e.preventDefault();
    displayCategories();
})









})

