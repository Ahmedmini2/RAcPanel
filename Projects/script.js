document.addEventListener("DOMContentLoaded", function () {
    const addProductButton = document.querySelector(".add_product");
    const productDetails = document.querySelector("#product_details");

   // Function to calculate and update the total for each item
    addProductButton.addEventListener("click", function () {
        const productClone = document.querySelector(".product").cloneNode(true);
        productDetails.appendChild(productClone);
    });

    // Assuming you have a counter variable to generate unique IDs
        let counter = 1;
        let isCloning = false;

        productDetails.addEventListener("click", function (e) {
            if (e.target.classList.contains("add_iron") && !isCloning) {
                isCloning = true;
                setTimeout(function () {
                    const itemDetails = e.target.parentElement.querySelector(".iron_details");
                    const itemClone = document.querySelector(".iron").cloneNode(true);
                    
                    // Generate unique IDs for the cloned elements
                    itemClone.querySelectorAll("[id]").forEach((element) => {
                        element.id += counter;
                    });
                    
                    // Update the name attributes if needed
                    itemClone.querySelectorAll("[name]").forEach((element) => {
                        // Modify the name attribute based on your naming convention
                        element.name += "_" + counter;
                    });
                    
                    itemDetails.appendChild(itemClone);
                    counter++;
                    isCloning = false;
                }, 1000); // Adjust the delay time (in milliseconds) as needed
            }

    

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