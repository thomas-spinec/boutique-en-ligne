document.addEventListener("DOMContentLoaded", function(){
    let productsContainer = document.getElementById("products_container");
    let links = document.querySelectorAll('.category_link');

    let url = new URL(window.location.href);
    let idCateg = url.searchParams.get("category_id");

    // FUNCTIONS
    function getAllProducts(){
        fetch("inc/php/getProductsByCategory.php")
        .then(response => response.text())
        .then(data => {
            productsContainer.innerHTML = data;
        });
    }

    function getProductsByCategory(idCateg){
        fetch("inc/php/getProductsByCategory.php?category_id="+idCateg)
        .then(response => response.text())
        .then(data => {
            productsContainer.innerHTML = data;
        });
    }

    // EVENTS

    // Get all products on page load
    if(idCateg == null){
        getAllProducts();
    }
    else{
        getProductsByCategory(idCateg);
    }

    links.forEach(link => {
        link.addEventListener('click', function(e){
            e.preventDefault();
            console.log(e.target);
            let idCateg = e.target.getAttribute('data-id');
            getProductsByCategory(idCateg);
        });
    });

    // <scroll to top 

    $(document).ready(function(){

        $(function(){
            $(document).on( 'scroll', function(){
                if ($(window).scrollTop() > 100) {
                    $('.scroll-top-wrapper').addClass('show');
                } else {
                    $('.scroll-top-wrapper').removeClass('show');
                }
            });

            $('.scroll-top-wrapper').on('click', scrollToTop);
        });

        function scrollToTop() {
            verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
            element = $('body');
            offset = element.offset();
            offsetTop = offset.top;
            $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
        }
    });


});
