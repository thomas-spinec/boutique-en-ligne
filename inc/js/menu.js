document.addEventListener("DOMContentLoaded", event => {
    const allProducts = document.getElementById("allProducts");
    const bestSales = document.getElementById("best_sales");
    const newCollection = document.getElementById("new_collection");
    const productContainer = document.getElementById("product_container");

    $displayMode = "allProducts";

    // define isset function
    $_GET = event => {
        let url = new URL(event);
        let params = new URLSearchParams(url.search);
        return params.get('displayMode');
    }

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