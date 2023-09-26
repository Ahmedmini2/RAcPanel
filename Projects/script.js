document.addEventListener("DOMContentLoaded", function () {
    const addProductButton = document.querySelector(".add_product");
    const productDetails = document.querySelector("#product_details");

   // Function to calculate and update the total for each item
    addProductButton.addEventListener("click", function () {
        const productClone = document.querySelector(".product").cloneNode(true);
        productDetails.appendChild(productClone);
    });

    productDetails.addEventListener("click", function (e) {
        if (e.target.classList.contains("add_iron")) {
            var i=$('#rowcount').val();
            i++;
            const itemDetails = e.target.parentElement.querySelector(".iron_details");
           $("#main-iron").append('<div class="row" id="row'+i+'"><div class="col-md-2 col-sm-6"> <div class="form-group"><label for="iron">مقاس الحديد</label><select class="form-control" name="iron[]" id="iron"><option value="0.395">8مم</option><option value="0.617">10مم</option><option value="0.888">12مم</option><option value="1.21">14مم</option><option value="1.58">16مم</option><option value="2">18مم</option><option value="2.47">20مم</option><option value="2.984">22مم</option><option value="3.85">25مم</option><option value="6.41">32مم</option>     </select>   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_price">سعر طن الحديد لليوم</label>     <input type="text" class="form-control" name="iron_price[]" id="iron_price">   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_quantity">كمية الحديد</label>     <input type="text" class="form-control" name="iron_quantity[]" id="iron_quantity">   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_long">طول الحديد</label>     <input type="text" class="form-control" name="iron_long[]" id="iron_long">   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_tn">السعر الطن</label>     <input type="text" class="form-control" name="iron_tn[]" id="iron_tn" disabled>   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_tot">السعر الكلي</label>     <input type="text" class="form-control" name="iron_tot[]" id="iron_tot" disabled>     <input type="number" value="'+i+'" id="rowcount" disabled>   </div> </div></div>');
           
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