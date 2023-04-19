document.addEventListener("DOMContentLoaded", function () {
  const pageTitle = document.querySelector("head title").innerHTML;

  if (pageTitle == "Product") {
    const cart = document.querySelector("#add_to_cart");
    const str = window.location.href;
    const url = new URL(str);
    const id_product = url.searchParams.get("id");
    const quantityInput = document.querySelector("#quantity");
    const sizeSelect = document.querySelector("#size");

    //-------------------Functions-------------------------

    function addToCart(id_product, quantity, size) {
      let data = new FormData();
      data.append("id", id_product);
      data.append("quantity", quantity);
      data.append("size", size);
      data.append("addToCart", "ok");

      fetch("inc/php/process-order.php", {
        method: "POST",
        body: data,
      })
        .then((response) => response.text())
        .then((data) => {
          data = data.trim();
          if (data === "ok") {
            history.back();
          } else {
            cart.nextElementSibling.innerHTML =
              "There was an error, please retry later";
          }
        });
    }

    //-------------------Calls-------------------------

    cart.addEventListener("click", function (e) {
      e.preventDefault();
      quantity = quantityInput.value;
      size = sizeSelect.value;

      addToCart(id_product, quantity, size);
    });
  }

  if (pageTitle == "Cart") {
    const divCart = document.querySelector(".productsCart");
    const divPay = document.querySelector(".pay");

    //-------------------Functions-------------------------
    function displayCart() {
      fetch("inc/php/process-order.php?cart")
        .then((response) => response.text())
        .then((data) => {
          divCart.innerHTML = data;
        });

      fetch("inc/php/process-order.php?pay")
        .then((response) => response.text())
        .then((data) => {
          divPay.innerHTML = data;
        });
    }

    function delFromCart(id_product, size, id_order) {
      let data = new FormData();
      data.append("id", id_product);
      data.append("size", size);
      data.append("id_order", id_order);
      data.append("delFromCart", "ok");

      fetch("inc/php/process-order.php", {
        method: "POST",
        body: data,
      })
        .then((response) => response.text())
        .then((data) => {
          data = data.trim();

          if (data === "ok") {
            displayCart();
          } else {
            alert("There was an error, please retry later");
          }
        });
    }

    function updateQuantity(id_product, size_product, id_order, quantity){
        let data = new FormData();

        data.append("id", id_product);
        data.append("size", size_product);
        data.append("id_order", id_order);
        data.append("quantity", quantity)
        data.append("updateProduct", "ok");

        fetch("inc/php/process-order.php",{
            method: "POST",
            body: data,
        })
        .then((response)=>response.text())
        .then((data)=>{
            data = data.trim();
            if (data === "ok") {
                displayCart();
              } else {
                alert("There was an error, please retry later");
              }
        })



    }
    //-------------------Calls-------------------------

    displayCart();

    divCart.addEventListener("click", function (e) {
      e.preventDefault();

      if (e.target.id == "delProduct") {
        let delProduct = e.target;
        const id_product = delProduct.getAttribute("data-id");
        const size_product = delProduct.getAttribute("data-size");
        const order_product = delProduct.getAttribute("data-order");

        delFromCart(id_product, size_product, order_product);
      }
    });

    divCart.addEventListener("change", function(e){
        e.preventDefault();

        if(e.target.classList.contains("quantity")){
            const quantity = e.target.value
            const id_product = e.target.getAttribute("data-id");
            const size_product = e.target.getAttribute("data-size");
            const order_product = e.target.getAttribute("data-order");

            updateQuantity(id_product ,size_product, order_product, quantity)


        }
    })

  }
});
