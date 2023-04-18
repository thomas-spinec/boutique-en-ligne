// Lancer le DOM
document.addEventListener('DOMContentLoaded', () => {
    
    const love = document.querySelector(".love");

    love.addEventListener('click', event => {
        event.preventDefault();
        if (event.target.classList.contains('heart')) {
            const productId = event.target.getAttribute('data-id');
            console.log(productId);

            let data = new FormData();
            data.append('productId', productId);

            fetch('inc/php/addToWishlist.php', {
                method: 'POST',
                body: data,
            })
            .then((response) => response.text())
            .then((response) => {
                response = response.trim();
                // If the request was successful, toggle the heart icon state
                if (response === "ok") {
                    if(event.target.classList.contains('clicked')){
                        event.target.classList.remove('clicked');
                    }
                    else{
                        event.target.classList.add('clicked');
                    }
                } else {
                    console.log(response);
                }
            })
            .catch(error => {
                console.error(error);
            });


        }
    });


}); // End of DOM