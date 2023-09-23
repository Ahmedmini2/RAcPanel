document.addEventListener("DOMContentLoaded", function () {
    const addProductButton = document.querySelector(".add_product");
    const productDetails = document.querySelector("#product_details");

   // Function to calculate and update the total for each item
    addProductButton.addEventListener("click", function () {
        const productClone = document.querySelector(".product").cloneNode(true);
        productDetails.appendChild(productClone);
    });

    // Assuming you have a counter variable to generate unique IDs
       

        productDetails.addEventListener("click", function (e) {
        if (e.target.classList.contains("add_accessory")) {
            const itemDetails = e.target.parentElement.querySelector(".accessory_details");
            const itemClone = document.querySelector(".accessory").cloneNode(true);
            itemDetails.appendChild(itemClone);
        }
        if (e.target.classList.contains("add_band")) {
            const itemDetails = e.target.parentElement.querySelector(".band_details");
            const itemClone = document.querySelector(".band").cloneNode(true);
            itemDetails.appendChild(itemClone);
        }
    });
});