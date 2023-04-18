document.addEventListener("DOMContentLoaded", function(){

    const pageTitle = document.querySelector('head title').innerHTML;

    if(pageTitle == "Product"){
        const cart = document.querySelector('#add_to_cart');
        const str = window.location.href;
        const url = new URL(str);
        const id_product = url.searchParams.get('id');
        const quantityInput = document.querySelector("#quantity")
        const sizeSelect = document.querySelector("#size");
        
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
            .then((response)=> response.text())
            .then((data)=> {
                data = data.trim();
                if(data ==="ok"){
                    history.back()
                } else {
                    cart.nextElementSibling.innerHTML = "There was an error, please retry later"
                }
            })
        }

        //-------------------Calls-------------------------

        cart.addEventListener("click", function (e) {
            e.preventDefault();
            quantity = quantityInput.value;
            size = sizeSelect.value;

            addToCart(id_product, quantity, size)
        
        })
    }

    if(pageTitle == "Cart"){
        const divCart = document.querySelector('.productsCart')

        //-------------------Functions-------------------------
        function displayCart() 
        {
            fetch("inc/php/process-order.php?cart")
            .then((response)=> response.text())
            .then((data) => {
                divCart.innerHTML = data
            })
        }
        
        //-------------------Calls-------------------------

        displayCart()
    }




})