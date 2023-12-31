<?php
include('../cookies/session2.php');
$_SESSION['sidebar'] = "Factory";

    $id = $_GET['project_id'];

    if(isset($_GET['edit']) && isset($_GET['project_id'])){
        $project_id = $_GET['project_id'];
        $status_id = $_GET['edit'];
        $query = "SELECT * FROM product_status WHERE id = $status_id AND project_id = $project_id";
        $res = $conn->query($query);
        $editData = $res->fetch_assoc();
        $product_id = $status_id;
        $product_name = $editData['name'];
        $description = $editData['description'];
        $quantity = $editData['quantity'];
        $product_quantity = $editData['product_quantity'];
        $type = $editData['kharasana_type'];
        $price = $editData['kharasana_price'];
        $used = $editData['kharasana_used'];
        $kh_text = $editData['kh_text'];
        $extra = $editData['extra_price'];
        $total_price = $editData['total_price'];

        if(isset($_POST['submit'])){
            $str = explode(",",$_POST['name']);
            $product_id_new = $str[0];
            $product_name = $str[1];
            $description = $_POST['description'];
            $product_quantity = $_POST['product_quantity'];
            $type = $_POST['type'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $kh_text = $_POST['kh_text'];
            $extra = $_POST['extra'];
            $total_price = $_POST['total_price'];
            
            if($description == "صب كامل"){
                $status = "إنتاج";
                $update_product_status = "UPDATE product_status SET `product_id` = '$product_id_new', `status` = '$status' , `name` = '$product_name' , `description` = '$description' , `quantity` = '$product_quantity' ,
                 `kharasana_type` = '$type' , `kharasana_price` = '$price' , `kharasana_used` = '$quantity' , `total_price` = '$total_price' , `extra_price` = '$extra' ,  `production` = '$product_quantity' ,  `warehouse` = '$product_quantity' WHERE `id` = $status_id";
                $res = $conn->query($update_product_status);
            }else{
                $status = "قيد التصنيع";
                $update_product_status = "UPDATE product_status SET `product_id` = '$product_id_new' , `status` = '$status' , `name` = '$product_name' , `description` = '$description' ,
                 `quantity` = '$product_quantity' , `kharasana_type` = '$type' , `kharasana_price` = '$price' , `kharasana_used` = 0 , `kh_text` = '$kh_text' , `total_price` = '$total_price' 
                 , `extra_price` = '$extra' , `production` = 0 , `warehouse` = 0  WHERE `id` = $status_id";
                $res = $conn->query($update_product_status);
            }
            if ($res) {
                $_SESSION['notification'] = "تم تعديل تقرير الانتاج بنجاح";
                header('location: ../Projects/view-projects.php?id='.$project_id.'');
                exit();
              } else {
                $_SESSION['notification'] = "خطأ في الادخال " . mysqli_error($conn). "";
                header('location: ../Projects/view-projects.php?id='.$project_id.'');
                exit();
              }
        
        }
    
    } 

    else if(isset($_POST['submit'])){

        $str = explode(",",$_POST['name']);
        $product_id = $str[0];
        $product_name = $str[1];
        $description = $_POST['description'];
        $product_quantity = $_POST['product_quantity'];
        $type = $_POST['type'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $kh_text = $_POST['kh_text'];
        $extra = $_POST['extra'];
        $total_price = $_POST['total_price'];

        if($description == "صب كامل"){
            $status = "إنتاج";
            $insert_product_status = "INSERT INTO product_status (`id`, `project_id`, `product_id`, `status`, `name`, `description`, `quantity`, `kharasana_type`, `kharasana_price`, `kharasana_used`,`total_price`,`extra_price`,`production`,`warehouse`, `created_at`)
            VALUES (NULL,'$id', '$product_id' ,'$status', '$product_name' , '$description' , '$product_quantity' , '$type' , '$price' ,'$quantity','$total_price','$extra','$product_quantity','$product_quantity', NOW())";
            $res = $conn->query($insert_product_status);
        }else{
            $status = "قيد التصنيع";
            $insert_product_status = "INSERT INTO product_status (`id`, `project_id`, `product_id`, `status`, `name`, `description`, `quantity`, `kharasana_type`, `kharasana_price`,`kh_text`,`extra_price`,`production`,`warehouse`, `created_at`)
          VALUES (NULL,'$id', '$product_id' ,'$status', '$product_name' , '$description' , '$product_quantity' , '$type' , '$price' ,'$kh_text','$extra','0','0', NOW())";
          $res = $conn->query($insert_product_status);
        }
        if ($res) {
            $_SESSION['notification'] = "تم اضافة تقرير الانتاج بنجاح";
            header('location: view-factory.php?id='.$id.'');
            exit();
          } else {
            $_SESSION['notification'] = "خطأ في الادخال";
            header('location: view-factory.php?id='.$id.'');
            exit();
          }

        

    } else{

        $product_id = '';
        $product_name = '';
        $description = '';
        $quantity = '';
        $product_quantity = '';
        $type = '';
        $price = '';
        $used = '';
        $kh_text = '';
        $extra = '';
        $total_price = '';
    }

    


 

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        تقرير المشروع
    </title>
    <!--     Fonts and icons     -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show rtl ">

    <!-- Side Bar -->
    <?php require_once('../components/sidebar.php'); ?>
    <!-- End Of side Bar -->

    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
        <!-- Navbar --> 
        <?php
        $titleNav = 'تقرير المشروع';
        require_once('../components/navbar.php');
        ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="block block-themed">
                    <div class="block-header bg-warning col-lg-3 col-md-4 col-sm-6 col-xs-6 rounded">
                        <?php require_once('../components/notification.php'); ?>
                    </div>
                    <div class="block-header bg-gradient-dark col-md-3 col-sm-6 col-xs-6  rounded-pill">
                        <h6 class="block-title text-center text-white py-2 px-4 ">اضافة تقرير جديد عن الانتاج</h6>
                    </div>
                    <form method="post" action="">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>اختيار الصنف</label>
                                    <select name="name" id="name" class="form-control" placeholder="اختيار النوع" >
                                        <option value="<?=$status_id?>,<?=$product_name?>"><?=$product_name?></option>
                                        <?php
                                        $s_items = mysqli_query($conn, "SELECT * FROM products WHERE `project_id` = $id ");
                                        while ($item = mysqli_fetch_array($s_items)){
                                            echo '<option value="'.$item['id'].','.$item['product_name'].'">'.$item['product_name'].'</option>';
                                        }

                                        ?>

                                    </select>

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>نوع الاجراء</label>
                                    <select name="description" id="description" class="form-control" placeholder="نوع الاجراء" onchange="showDiv2(this)">
                                        <option value="<?=$description?>"><?=$description?></option>
                                        <option value="صب ارضية">صب ارضية</option>
                                        <option value="صب جوانب">صب جوانب</option>
                                        <option value="صب سقفية">صب سقفية</option>
                                        <option value="صب رقبية">صب رقبية</option>
                                        <option value="صب كامل">صب كامل</option>
                                    </select>
                                    <script>
                                        function showDiv2(select) {
                                            if (select.value == "صب كامل") {
                                                document.getElementById('kh-row1').style.display = "block";
                                                document.getElementById('kh-row2').style.display = "block";
                                                document.getElementById('kh-row3').style.display = "none";
                                            } else {
                                                document.getElementById('kh-row1').style.display = "none";
                                                document.getElementById('kh-row2').style.display = "none";
                                                document.getElementById('kh-row3').style.display = "block";
                                            }
                                        }
                                    </script>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> كمية الاصناف </label>
                                    <input type="text" placeholder="الرجاء كتابة كمية الاصناف    " class="form-control" name="product_quantity" id="product_quantity" value="<?=$quantity?>">
                                    <input type="text" placeholder="" class="form-control" name="kh_per_peice" id="kh_per_peice" hidden>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>نوع الخرسانة</label>
                                    <select name="type" id="type" class="form-control" placeholder="نوع الخرسانة">
                                        <option value="<?=$type?>"><?=$type?></option>
                                        <option value="خرسانة شركة">خرسانة شركة</option>
                                        <option value="خرسانة رجيع">خرسانة رجيع</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> سعر الخرسانة </label>
                                    <input type="text" placeholder="الرجاء كتابة سعر الخرسانة " class="form-control" name="price" id="price" value="<?=$price?>">

                                </div>
                            </div>

                            <div class="col" id="kh-row3">
                                <div class="form-group">
                                    <label> وصف كمية الخرسانة المستخدمة</label>
                                    <input type="text" placeholder="الرجاء كتابة وصف كمية الخرسانة المستخدمة " class="form-control" name="kh_text" name="kh_text" value="<?=$kh_text?>">

                                </div>
                            </div>

                            <div class="col" id="kh-row1" style="display:none">
                                <div class="form-group" >
                                    <label> كمية الخرسانة </label>
                                    <input type="text" placeholder="الرجاء كتابة كمية الخرسانة " class="form-control" name="quantity" id="quantity" value="<?=$used?>" readonly>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> مبلغ اضافي </label>
                                    <input type="text" placeholder="الرجاء كتابة المبلغ " class="form-control" name="extra" id="extra" value="<?=$extra?>">

                                </div>
                            </div>
                            <div class="col"  id="kh-row2" style="display:none">
                                <div class="form-group">
                                    <label>المجموع</label>
                                    <input type="text" placeholder="الرجاء كتابة المبلغ " class="form-control" name="total_price" id="total_price" value="<?=$total_price?>" readonly>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-secondary"> اضافه التقرير الانتاج</button>
                                </div>
                            </div>
                           
                        </div>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>

                            $(document).ready(function() {
                                $('#name').on('change', function() {
                                    var selectedOption = $(this).find('option:selected');
                                    var productId = selectedOption.val().split(',')[0];
                                    
                                    if (productId !== "") {
                                        $.ajax({
                                            type: 'POST',
                                            url: '../ajax/fetch_kh_per_peice.php', // Create this PHP file to handle the AJAX request
                                            data: { product_id: productId },
                                            success: function(response) {
                                                $('#kh_per_peice').val(response);
                                            }
                                        });
                                    } else {
                                        $('#kh_per_peice').val(''); // Clear the display if no option is selected
                                    }
                                });
                            });
                           

                            $(document).on('change', 'input , select', function() {
                            var quantity = $('#product_quantity').val();
                            var kh_per_peice = $('#kh_per_peice').val();
                            var price = $('#price').val();
                            var extra = $('#extra').val();

                            $('#quantity').val(quantity*kh_per_peice);
                            var used_quantity = $('#quantity').val();  
                            
                            var total = (Number(used_quantity) * Number(price)) + Number(extra);

                            $('#total_price').val(total);
                            
                            


                            
                            });
                        </script>
                    </form>
                </div>
            </div>
        </div>

    </main>
    
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
    <script src="../Admin/darkmode.js"></script>
</body>

</html>