document.addEventListener("DOMContentLoaded", function(){

const cart = document.querySelector('#add_to_cart');


//-------------------Functions-------------------------

function addToCart(id_product, quantity, size){

    let data = new FormData();
    data.append("id", id_product);
    data.append("quantity", quantity);
    data.append("size", size);
    data.append("addToCart", "ok");

    fetch("inc/php/process-order.php",{
        method: "POST",
        body: data,
    })


}































})