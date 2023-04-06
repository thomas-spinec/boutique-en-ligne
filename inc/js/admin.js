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
    fetch("inc/php/templateAdmin.php?users")

    .then((response)=> response.text())
    .then((table)=>
    display.innerHTML = table)
}



function deleteUsers(id){
    fetch("inc/php/adminGestion.php?delUser=" + id)

    .then((response)=>response.text())
    .then((response)=>{
        response = response.trim()
        if(response === "ok"){
            displayUsers();
        }
        else{
            display.nextElementSibling.innerHTML = "Error during suppression";
            setTimeout(()=>{
                display.nextElementSibling.innerHTML = ""}, "2000")  
        }
    })
}

//PRODUCTS//
function displayProducts(){
    display.innerHTML="";
    gestion.innerHTML="";
    fetch("inc/php/templateAdmin.php?products")
    .then((response)=>response.text())
    .then((table)=>
    display.innerHTML=table
    );
    fetch("inc/php/templateAdmin.php?addProducts")
    .then((response)=>response.text())
    .then((form)=>
    gestion.innerHTML=form);
}

function deleteProduct(id){
    fetch("inc/php/adminGestion.php?delProduct=" + id)

    .then((response)=>response.text())
    .then((response)=>{
        response = response.trim()
        if(response === "ok"){
            displayProducts();
        }
        else{
            display.nextElementSibling.innerHTML = "Error during suppression";
            setTimeout(()=>{
                display.nextElementSibling.innerHTML = ""}, "2000")  
        }
    })
}


//CATEGORIES//

function displayCategories(){
    display.innerHTML="";
    gestion.innerHTML="";

    fetch("inc/php/templateAdmin.php?categories")
    .then((response)=>response.text())
    .then((table)=>
    display.innerHTML=table)

    fetch("inc/php/templateAdmin.php?addCategories")
    .then((response)=>response.text())
    .then((form)=>
    gestion.innerHTML=form)

}

function deleteCategory(id){
    fetch("inc/php/adminGestion.php?delCategory=" + id)

    .then((response)=>response.text())
    .then((response)=>{
        response = response.trim()
        if(response === "ok"){
            displayCategories();
        }
        else{
            display.nextElementSibling.innerHTML = "Error during suppression";
            setTimeout(()=>{
                display.nextElementSibling.innerHTML = ""}, "2000")  
        }
    })
}



// ----------------------------------------------------------FUNCTIONS CALL--------------------------------------------------

//USERS//
users.addEventListener("click", function(e){
    e.preventDefault();
    displayUsers();
})

display.addEventListener("click", function(e){
    e.preventDefault();
    if(e.target.classList.contains("delUser")){
        const id = e.target.getAttribute("data-id");
        deleteUsers(id)
    }
})
//PRODUCT//


products.addEventListener("click", function(e){
    e.preventDefault();
    displayProducts();
})

display.addEventListener("click", function(e){
    e.preventDefault();
    if(e.target.classList.contains("delProduct")){
        const idProduct = e.target.getAttribute("data-id");
        deleteProduct(idProduct)
        
    }
})  





//CATEGORIES//

categories.addEventListener("click", function(e){
    e.preventDefault();
    displayCategories();
})

display.addEventListener("click", function(e){
    e.preventDefault();
    if(e.target.classList.contains("delCategory")){
        const idCategory = e.target.getAttribute("data-id");
        deleteCategory(idCategory);
    }
})









})

