document.addEventListener("DOMContentLoaded", event => {
    const allProducts = document.getElementById("allProducts");
    // limiter la taille des images
    //allProducts.image.style.maxWidth = "300px";
    //allProducts.image.style.maxHeight = "500px";
    const bestSales = document.getElementById("best_sales");
    //bestSales.image.style.maxWidth = "300px";    
    //bestSales.image.style.maxHeight = "500px";
    const newCollection = document.getElementById("new_collection");
    //newCollection.image.style.maxWidth = "300px";
    //newCollection.image.style.maxHeight = "500px";
    const productContainer = document.getElementById("product_container");
    //productContainer.image.style.maxWidth = "300px";
    //productContainer.image.style.maxHeight = "500px";


    $displayMode = "allProducts";

    if(isset($_GET['displayMode'])){
        $displayMode = $_GET['displayMode'];
    }

    if($displayMode == "allProducts"){
        allProducts.classList.add("active");
        bestSales.classList.remove("active");
        newCollection.classList.remove("active");
        productContainer.innerHTML = "allProducts";
    }else if($displayMode == "best_sales"){
        allProducts.classList.remove("active");
        bestSales.classList.add("active");
        newCollection.classList.remove("active");
        productContainer.innerHTML = "best_sales";
    }else if($displayMode == "new_collection"){
        allProducts.classList.remove("active");
        bestSales.classList.remove("active");
        newCollection.classList.add("active");
        productContainer.innerHTML = "new_collection";
    }


    
}); //end DOMContentLoaded