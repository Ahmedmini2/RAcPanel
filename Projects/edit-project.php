<?php
include('../cookies/session2.php');
include('../cookies/insert-method2.php');
$_SESSION['sidebar'] = "Projects";

if(isset($_GET['project_id']) && isset($_GET['item_id'])){
    $project_id = $_GET['project_id'];
    $item_id = $_GET['item_id'];
    $query = "SELECT * FROM projects WHERE `id` = $project_id";
    $res = $conn->query($query);
    $project = $res->fetch_assoc();

    $project_cost = $project['project_cost'];
    $total_without_tax = $project['total_without_tax'];
    $total_with_tax = $project['total_with_tax'];
    $net_total = $project['net_total'];
    $valid_till = $project['valid_till'];
    $duration = $project['duration'];
    $payment_type = $project['payment_type'];


    $query_pro = "SELECT * FROM products WHERE `project_id` = $project_id AND `id` = $item_id";
    $res_pro = $conn->query($query_pro);
    $item = $res_pro->fetch_assoc();

    $query_cover = "SELECT * FROM covers_band WHERE  `product_id` = $item_id";
    $res_cover = $conn->query($query_cover);
    $cover_band = $res_cover->fetch_assoc();

    $query_delivery = "SELECT * FROM delivery WHERE  `product_id` = $item_id";
    $res_delivery = $conn->query($query_delivery);
    $delivery_band = $res_delivery->fetch_assoc();

}



if (isset($_POST['add-project'])) {


    $old_project_cost = $project_cost - ($item['cost_price'] * $item['quantity']);
    $old_total_without_tax = $total_without_tax - ($item['sell_price'] * $item['quantity']);
    
    $old_net_toti = $net_total - ($item['net_profit'] * $item['quantity']);

  $iron1 = 1;
  $accessory1 = 1;
  $band1 = 1;


    $product_name = $_POST['product_name'];
    $dimensions = $_POST['dimensions'];
    $quantity = $_POST['quantity'];
    $sell_price = str_replace(',', '', $_POST['sell_price']);
    $cost_price = $_POST['prod_peice'];
    $cost_price = str_replace(',', '', $cost_price);
    $net_perc = $_POST['net_peice'];
    $net_toti = str_replace(',', '', $_POST['net_toti_peice']);

    

    $update_product = "UPDATE products SET `product_name` = '$product_name', `quantity` ='$quantity' , `dimensions` = '$dimensions' , `cost_price` = '$cost_price' ,`sell_price` = '$sell_price' ,`net_profit` = '$net_toti' ,`net_perc` = '$net_perc' WHERE `id` = $item_id";
    $product_res = $conn->query($update_product);

    $final_project_cost = $old_project_cost + str_replace(',', '', $_POST['prod_peice_tot']);
    $final_total_without_tax = $old_total_without_tax + str_replace(',', '', $_POST['sell_price_tot']);
    $final_total_with_tax = (($final_total_without_tax * 15) /100);
    $final_net_toti = $old_net_toti + str_replace(',', '', $_POST['net_toti']);

    $update_project = "UPDATE `projects` SET `project_cost` = '$final_project_cost' , `total_without_tax` = '$final_total_without_tax' , `total_with_tax` = '$final_total_with_tax' , `net_total` = '$final_net_toti' WHERE `id` = '$project_id'";
    $project_res = $conn->query($update_project);

      $kharasana = $_POST['kharasana'];
      $kh_price = str_replace(',', '', $_POST['kh_price']);
      $kh_per = str_replace(',', '', $_POST['kh_per']);
      $kh_peice = str_replace(',','',$_POST['kh_peice']);
      $kh_tot = str_replace(',','',$_POST['kh_tot']);

      $update_kh = "UPDATE kharasana SET `type` = '$kharasana', `price` = '$kh_price' , `quantity_per_piece` = '$kh_per' , `price_per_piece` = '$kh_peice' , `total_price` = '$kh_tot' WHERE `product_id` = $item_id";
      
      $kh_res = $conn->query($update_kh);
      if ($kh_res) {

      }

        $iron_raws = $_POST['iron-rr'];
        $iron_new_raws = $_POST['iron-new-rr'];
        if ($iron_raws == "") {
          $iron_raws = 1;
        }
        while ($iron1 <= $iron_new_raws) {
          $iron = $_POST['iron_' . $iron1];
          $iron_price = str_replace(',', '', $_POST['iron_price_' . $iron1]);
          $iron_quantity = $_POST['iron_quantity_' . $iron1];
          $iron_long = $_POST['iron_long_' . $iron1];
          $iron_tn = $_POST['iron_tn_' . $iron1];
          $iron_tot = str_replace(',', '', $_POST['iron_tot_' . $iron1]);
          $iron_id = $_POST['iron_id_'.$iron1];

          $sizeText = [
            "0.395" => "8مم",
            "0.617" => "10مم",
            "0.888" => "12مم",
            "1.21" => "14مم",
            "1.58" => "16مم",
            "2" => "18مم",
            "2.47" => "20مم",
            "2.984" => "22مم",
            "3.85" => "25مم",
            "6.41" => "32مم",
          ];

          $selectedSizeText = $sizeText[$iron];

          if($iron1 <= $iron_raws){
          
            $update_iron = "UPDATE  iron_band  SET  size ='$selectedSizeText', price_today ='$iron_price', quantity ='$iron_quantity', iron_height ='$iron_long', tn_price ='$iron_tn', total_price ='$iron_tot' WHERE  id  = $iron_id ";
            $iron_res = $conn->query($update_iron);
            if ($iron_res){
              
              $iron1++;
            }else{
              $_SESSION['notification'] =  $conn->error;
                    header('location: index.php');
                    exit();
              }
          }else {
            $data = [
              'product_id' => $item_id,
              'size'=> $selectedSizeText,
              'price_today'=> $iron_price,
              'quantity'=> $iron_quantity,
              'iron_height'=> $iron_long,
              'tn_price'=> $iron_tn,
              'total_price'=> $iron_tot,
            ];
            $tableName='iron_band';
            if(!empty($data) && !empty($tableName)){
              $insertData=insert_data($data,$tableName);
              if($insertData){
              
                $iron1++;
              }else{
                $_SESSION['notification'] =  $conn->error;
                header('location: index.php');
                exit();
              
              }
          }
          }
        }
          $accessory_raws = $_POST['ac-rr'];
          if ($accessory_raws == "") {
            $accessory_raws = 1;
          }
          while ($accessory1 <= $accessory_raws) {
            $accessory = $_POST['accessory_' . $accessory1];
            $acc_quantity = $_POST['acc_quantity_' . $accessory1];
            $acc_price = str_replace(',', '', $_POST['acc_price_' . $accessory1]);
            $acc_tot = str_replace(',', '', $_POST['acc_tot_' . $accessory1]);
            $accessory_id = $_POST['accessory_id_'. $accessory1];


            $update_accessory = "UPDATE `accessory_band` SET  `name` = '$accessory' , `quantity` = '$acc_quantity' , `price_per_piece` = '$acc_price' , `total_price` = '$acc_tot' WHERE `id` = '$accessory_id'";
            $accessory_res = $conn->query($update_accessory);
            if($accessory_res){
              $accessory1++;
            }
            else{
              $_SESSION['notification'] = "تعديل خطأ في الاكسسوارات الاضافيه";
                    header('location: index.php');
                    exit();
              }
            
          }

        $cover_type = $_POST['cover_type'];
        $cover_price = str_replace(',', '', $_POST['cover_price']);
        $cover_tot = str_replace(',', '', $_POST['cover_tot']);

        $update_cover = "UPDATE `covers_band` SET `type` = '$cover_type' , `price_per_piece` = '$cover_price' , `total_price` = '$cover_tot' WHERE `product_id` = $item_id";
        $cover_res = $conn->query($update_cover);
        if ($cover_res) {

        }

          $band_raws = $_POST['band-rr'];
          if ($band_raws == "") {
            $band_raws = 1;
          }
          while ($band1 <= $band_raws) {
            $band = $_POST['band_' . $band1];
            $band_price = str_replace(',', '', $_POST['band_price_' . $band1]);
            $band_tot = str_replace(',', '', $_POST['band_tot_' . $band1]);
            $extra_id = $_POST['extra_id_'.$band1];

            $update_band = "UPDATE `extra_band` SET  `name` = '$band' , `price_per_piece` = '$band_price' , `total_price` = '$band_tot' WHERE `id` = '$extra_id'";
            $band_res = $conn->query($update_band);
            if ($band_res) {
              $band1++;
            }else{
            $_SESSION['notification'] = "تعديل خطأ في البنود الاضافيه";
                  header('location: index.php');
                  exit();
            }
          }
          

              if (isset($_POST['deliverable'])) {
                $deliverable = 1;
                $quantity_of_track = $_POST['quantity_of_track'];
                $delivery_to = $_POST['delivery_to'];
                $track_price = str_replace(',', '', $_POST['track_price']);
                $piece_price = str_replace(',', '', $_POST['piece_price']);
                $total_track_price = str_replace(',', '', $_POST['total_price']);
                $peice_per_track = $_POST['peice_per_track'];
                
                
                $update_delivery = "UPDATE `delivery` SET `deliverable` = '$deliverable' , `peice_per_track` = '$peice_per_track' , `quantity_of_track` = '$quantity_of_track' , `delivery_to` = '$delivery_to' , `piece_price` = '$piece_price', `track_price` = '$track_price', `total_price` = '$total_track_price' WHERE `product_id` = '$item_id'";
                $delivery_res = $conn->query($update_delivery);
                if ($delivery_res){
                  $_SESSION['notification'] = "تم التعديل بنجاح";
                  header('location: index.php');
                  exit();
                }
              } else {
                $deliverable = 0;
                $update_delivery = "UPDATE `delivery` SET `deliverable` = '$deliverable' WHERE `product_id` = $item_id";
                $delivery_res = $conn->query($update_delivery);
                if ($delivery_res){
                  $_SESSION['notification'] = "تم التعديل بنجاح";
                  header('location: index.php');
                  exit();
                }
              }
//             } else {
//               $_SESSION['notification'] = "يوجد خلل في ادخال البنود الاضافية";
//               header('location: index.php');
//             }
//             $band1++;
//           }
//           $_SESSION['notification'] = "تمت اضافة المشروع بنجاح";
//           unset($_SESSION['last_insert_project']);
//           header('location: index.php');
//           exit();
//         } else {
//           $_SESSION['notification'] = "يوجد خلل في ادخال الاغطية";
//           header('location: index.php');
//         }
//       } else {
//         $_SESSION['notification'] = "يوجد خلل في ادخال الخرسانة";
//         header('location: index.php');
//       }
//     } else {
//       $_SESSION['notification'] = "يوجد خلل في ادخال الصنف";
//       header('location: index.php');
//     }
//   } else {
//     $_SESSION['notification'] = "يوجد خلل في ادخال المشروع";
//     header('location: index.php');
//   }

}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <title>
    طلب إعتماد مشروع جديد
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
  <style>
    /* Red border */
    hr.new1 {
      border-top: 1px solid red;
    }

    /* Dashed red border */
    hr.new2 {
      border-top: 3px dashed black;
      background: blanchedalmond;

    }

    /* Dotted red border */
    hr.new3 {
      border-top: 1px dotted red;
    }

    /* Thick red border */
    hr.new4 {
      border: 1px solid red;
    }

    /* Large rounded green border */
    hr.new5 {
      border: 10px solid green;
      border-radius: 5px;
    }
  </style>
</head>

<body class="g-sidenav-show rtl bg-gray-100">

  <!-- Side Bar -->
  <?php require_once('../components/sidebar.php'); ?>
  <!-- End Of side Bar -->
  <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden">
    <!-- Navbar -->
    <?php
    $titleNav = 'طلب إعتماد مشروع جديد';
    require_once('../components/navbar.php');
    ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="block block-themed">

          <div class="block-header bg-gradient-dark col-lg-3 col-md-2 col-sm-6 col-xs-6  rounded-pill">

            <h5 class="block-title text-white py-2 px-4 ">طلب تعديل مشروع</h5>
          </div>
          <form id="<?php echo $idAttr; ?>" action="#" method="post" enctype="multipart/form-data">
            
           
            <!-- Product Details -->
            <div id="product_details">
              <div class="product">
                <h4>الأصناف</h4>
                <div class="row">
                  <div class="col-md-8 col-sm-6">
                    <div class="form-group">
                      <label for="product_name">أسم الصنف</label>
                      <input class="form-control" type="text" name="product_name" value="<?=$item['product_name']?>">
                      <!-- Add more fields for product details here -->
                    </div>
                  </div>
                  <div class="col-md-8 col-sm-6">
                    <div class="form-group">
                      <label for="dimensions">المقاسات</label>
                      <input class="form-control" type="text" name="dimensions" value="<?=$item['dimensions']?>">
                      <!-- Add more fields for product details here -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8 col-sm-6">
                    <div class="form-group">
                      <label for="quantity">كمية الصنف</label>
                      <input class="form-control" type="text" name='quantity' id="quantity" value="<?=$item['quantity']?>">
                      <!-- Add more fields for product details here -->
                    </div>
                  </div>
                </div>
                <hr>
               <!-- Item Details -->
               <?php
               
               $kh = "SELECT * FROM `kharasana` WHERE `product_id` = $item_id";
               $res_kh = $conn->query($kh);
               $kharasan = $res_kh->fetch_assoc();
               ?>
                <div class="kh_details">
                  <h5>بند الخرسانة</h5>
                  <div class="item">
                    <div class="row">
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="kharasana">نوع الخرسانة</label>
                          <select class="form-control" name="kharasana">
                            <option value="<?=$kharasan['type']?>"><?=$kharasan['type']?></option>
                            <option value="خرسانة شركة">خرسانة شركة</option>
                            <option value="خرسانة رجيع">خرسانة رجيع</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="kh_price">سعر الخرسانة</label>
                          <input type="text" class="form-control" name='kh_price' id="kh_price" value="<?=$kharasan['price']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="kh_per">كمية الخرسانة للصنف الواحد</label>
                          <input type="text" class="form-control" name='kh_per' id="kh_per" value="<?=$kharasan['quantity_per_piece']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="kh_quantity_tot">كمية الخرسانة لجميع الاصناف</label>
                          <input type="text" class="form-control" name='kh_quantity_tot' id="kh_quantity_tot" readonly>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="kh_peice">السعر للمنتج الفردي</label>
                          <input type="text" class="form-control" name='kh_peice' id="kh_peice" readonly value="<?=$kharasan['price_per_piece']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="kh_tot">السعر الكلي</label>
                          <input type="text" class="form-control" name='kh_tot' id="kh_tot" readonly value="<?=$kharasan['total_price']?>">
                        </div>
                      </div>
                    </div>
                    <script>
                      $("input").on("change", function() {
                        var peice = ((parseFloat($("#kh_price").val()) * parseFloat($("#kh_per").val())) || 0)
                        var ret = ((parseFloat($("#kh_price").val()) * parseFloat($("#kh_per").val())) || 0) * parseFloat($("#quantity").val())
                        var qunt = (parseFloat($("#quantity").val()) || 0);
                        var qty_tot = ((parseFloat($("#quantity").val()) * parseFloat($("#kh_per").val())) || 0)
                        $("#kh_quantity_tot").val(qty_tot);
                        ret = ret.toLocaleString("en-US");
                        peice = peice.toLocaleString("en-US");
                        $("#kh_tot").val(ret);
                        $("#kh_peice").val(peice);
                      })

                      $( document ).ready(function() {
                       var peice = ((parseFloat($("#kh_price").val()) * parseFloat($("#kh_per").val())) || 0)
                        var ret = ((parseFloat($("#kh_price").val()) * parseFloat($("#kh_per").val())) || 0) * parseFloat($("#quantity").val())
                        var qunt = (parseFloat($("#quantity").val()) || 0);
                        var qty_tot = ((parseFloat($("#quantity").val()) * parseFloat($("#kh_per").val())) || 0)
                        $("#kh_quantity_tot").val(qty_tot);
                        ret = ret.toLocaleString("en-US");
                        peice = peice.toLocaleString("en-US");
                        $("#kh_tot").val(ret);
                        $("#kh_peice").val(peice);
                      });
                    </script>

                  </div>
                 
                </div>

                <div class="iron_details">
                  <hr>
                  <h5>بند الحديد</h5>
                  <div class="iron" id="main-iron">
                  <?php 
                    $i = 0;
                    $res_iron = mysqli_query($conn, "SELECT * FROM iron_band WHERE `product_id` = $item_id ");
                    while ($iron_band = mysqli_fetch_array($res_iron)) {
                      $i++;
                      $iron_size = $iron_band['size'];
                      $sizeText = [
                                      "8مم" => "0.395",
                                      "10مم" => "0.617",
                                      "12مم" => "0.888",
                                      "14مم" => "1.21",
                                      "16مم" => "1.58",
                                      "18مم" => "2",
                                      "20مم" => "2.47",
                                      "22مم" => "2.984",
                                      "25مم" => "3.85",
                                      "32مم" => "6.41",
                                  ];
                                  $selectedSizeText = $sizeText[$iron_size];
                    ?>
                    <div class="row" id="row<?= $i ?>">
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron">مقاس الحديد</label>
                          <select class="form-control" name="iron_<?= $i ?>" id="iron_<?= $i ?>">
                            <option value="<?=$selectedSizeText?>"><?=$iron_size?></option>
                            <option value="0.395">8مم</option>
                            <option value="0.617">10مم</option>
                            <option value="0.888">12مم</option>
                            <option value="1.21">14مم</option>
                            <option value="1.58">16مم</option>
                            <option value="2">18مم</option>
                            <option value="2.47">20مم</option>
                            <option value="2.984">22مم</option>
                            <option value="3.85">25مم</option>
                            <option value="6.41">32مم</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron_price">سعر طن الحديد لليوم</label>
                          <input type="text" class="form-control" name='iron_price_<?= $i ?>' id="iron_price_<?= $i ?>" value="<?=$iron_band['price_today']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron_quantity">كمية الحديد</label>
                          <input type="text" class="form-control" name='iron_quantity_<?= $i ?>' id="iron_quantity_<?= $i ?>" value="<?=$iron_band['quantity']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron_long">طول الحديد</label>
                          <input type="text" class="form-control" name='iron_long_<?= $i ?>' id="iron_long_<?= $i ?>" value="<?=$iron_band['iron_height']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron_tn">السعر الطن</label>
                          <input type="text" class="form-control" name='iron_tn_<?= $i ?>' id="iron_tn_<?= $i ?>" readonly value="<?=$iron_band['tn_price']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="iron_tot">السعر</label>
                          <input type="text" class="form-control" name='iron_tot_<?= $i ?>' id="iron_tot_<?= $i ?>" readonly value="<?=$iron_band['total_price']?>">
                          <input type="hidden"  name="iron_id_<?=$i?>" value="<?=$iron_band['id']?>" readonly>
                          
                        </div>
                      </div>
                    </div>
                    <hr class="new2">
                    <?php } ?>
                  </div>
                </div>
                <input type="hidden" name="iron-rr" id="iron-rr" readonly value="<?=$i?>">
                <input type="hidden" name="iron-new-rr" id="iron-new-rr" readonly value="<?=$i?>">
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                  var i = $("#iron-rr").val();




                  $(document).on('change', 'input , select', function() {
                    var total_iron = 0;

                    for (var z = 1; z <= $("#iron-new-rr").val() ; z++) {
                      var iron = ($("#iron_" + z).val() || 0);
                      var kg = ((parseFloat($("#iron_quantity_" + z).val()) * parseFloat($("#iron_long_" + z).val()) || 0) * iron)
                      var tn = kg / 1000;
                      var total = ((tn * parseFloat($("#iron_price_" + z).val())) || 0)
                      total_iron += total;
                      tn = tn.toLocaleString("en-US");
                      total = total.toLocaleString("en-US");
                      $("#iron_tn_" + z).val(tn);
                      $("#iron_tot_" + z).val(total);
                    }

                    total_iron = total_iron.toLocaleString("en-US");

                    $("#total_iron").val(total_iron);
                  });

                  $( document ).ready(function() {
                    var total_iron = 0;

                    for (var z = 1; z <= <?=$i?>; z++) {
                      var iron = ($("#iron_" + z).val() || 0);
                      var kg = ((parseFloat($("#iron_quantity_" + z).val()) * parseFloat($("#iron_long_" + z).val()) || 0) * iron)
                      var tn = kg / 1000;
                      var total = ((tn * parseFloat($("#iron_price_" + z).val())) || 0)
                      total_iron += total;
                      tn = tn.toLocaleString("en-US");
                      total = total.toLocaleString("en-US");
                      $("#iron_tn_" + z).val(tn);
                      $("#iron_tot_" + z).val(total);
                    }

                    total_iron = total_iron.toLocaleString("en-US");

                    $("#total_iron").val(total_iron);
                  });


                  document.addEventListener("DOMContentLoaded", function() {
                    const productDetails = document.querySelector("#product_details");
                    productDetails.addEventListener("click", function(e) {
                      if (e.target.classList.contains("add_iron")) {

                        i++;
                        $("#iron-new-rr").val(i);
                      }
                    });
                  });

                 
                </script>
                
                

                <button type="button" class="btn btn-secondary rounded-pill add_iron">أضافة بند حديد</button>
                <div class="row">
                  السعر الكلي للحديد
                  <input type="text" class="form-control" placeholder="Total" name="total_iron" id="total_iron" readonly>
                </div>
               
                <hr>
               
                <div class="accessory_details">
                  <h5>بند الاكسسوارات</h5>
                  <div class="accessory" id="main-accessory">
                  <?php 
                    $y = 0;
                    $res_accessory = mysqli_query($conn, "SELECT * FROM accessory_band WHERE `product_id` = $item_id ");
                    while ($accessory_band = mysqli_fetch_array($res_accessory)) {
                      $y++;

                    ?>
                    <div class="row ">
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="accessory">أسم الاكسسوار</label>
                          <input type="text" class="form-control" name='accessory_<?= $y ?>' id="accessory_<?= $y ?>" value="<?=$accessory_band['name']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="acc_quantity">كمية الاكسسوار</label>
                          <input type="text" class="form-control" name='acc_quantity_<?= $y ?>' id="acc_quantity_<?= $y ?>" value="<?=$accessory_band['quantity']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="acc_price">سعر الاكسسوار الفردي</label>
                          <input type="text" class="form-control" name='acc_price_<?= $y ?>' id="acc_price_<?= $y ?>" value="<?=$accessory_band['price_per_piece']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="acc_tot">السعر</label>
                          <input type="text" class="form-control" name='acc_tot_<?= $y ?>' id="acc_tot_<?= $y ?>" readonly value="<?=$accessory_band['total_price']?>">
                          <input type="hidden"   name="accessory_id_<?= $y ?>" value="<?=$accessory_band['id']?>" readonly>
                          
                        </div>
                      </div>
                    </div>
                    <hr class="new2">
                    <?php  } ?>
                    <input type="hidden" name="ac-rr" id="ac-rr" readonly value="<?=$y?>">
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                      var a = 1;

                      $(document).on('change', 'input', function() {
                        var total_accessory = 0;
                        for (var z = 1; z <= <?=$y?>; z++) {

                          var peice = ((parseFloat($("#acc_quantity_" + z).val()) * parseFloat($("#acc_price_" + z).val()) || 0));
                          total_accessory += peice
                          peice = peice.toLocaleString("en-US");
                          $("#acc_tot_" + z).val(peice);
                        }

                        total_accessory = total_accessory.toLocaleString("en-US");
                        $("#accessory_iron").val(total_accessory);
                      })
                     
                      

                      $( document ).ready(function() {
                        var total_accessory = 0;
                        for (var z = 1; z <= <?=$y?>; z++) {

                          var peice = ((parseFloat($("#acc_quantity_" + z).val()) * parseFloat($("#acc_price_" + z).val()) || 0));
                          total_accessory += peice
                          peice = peice.toLocaleString("en-US");
                          $("#acc_tot_" + z).val(peice);
                        }

                        total_accessory = total_accessory.toLocaleString("en-US");
                        $("#accessory_iron").val(total_accessory);
                      });
                    </script>
                    
                  </div>



                </div>
                
                <div class="row">
                  السعر الكلي للإكسسوارات
                  <input type="text" class="form-control" placeholder="Total" name="accessory_iron" id="accessory_iron" readonly>
                </div>
                
                <hr>

                <div class="accessory_details">
                  <h5>بند الاغطية</h5>
                  <div class="covers">
                    <div class="row">
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_type">نوع الغطاء</label>
                          <select class="form-control" name="cover_type" id="cover_type">
                            <option value="<?=$cover_band['type']?>"><?=$cover_band['type']?></option>
                            <option value="بدون اغطية">بدون اغطية</option>
                            <option value="غطاء واحد">غطاء واحد</option>
                            <option value="غطائين">غطائين</option>
                            <option value="غطاء دائري">غطاء دائري</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_price">سعر الغطاء الفردي</label>
                          <input type="text" class="form-control" name='cover_price' id="cover_price" value="<?=$cover_band['price_per_piece']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_tot">السعر الكلي</label>
                          <input type="text" class="form-control" name='cover_tot' id="cover_tot" readonly value="<?=$cover_band['total_price']?>">
                        </div>
                      </div>
                    </div>
                    <script>
                      $("input").on("change", function() {
                        var peice = ((parseFloat($("#cover_price").val()) * parseFloat($("#quantity").val()) || 0))

                        peice = peice.toLocaleString("en-US");
                        $("#cover_tot").val(peice);
                      });

                      $( document ).ready(function() {
                        var peice = ((parseFloat($("#cover_price").val()) * parseFloat($("#quantity").val()) || 0))

                        peice = peice.toLocaleString("en-US");
                        $("#cover_tot").val(peice);
                      });
                    </script>

                  </div>
                </div>
                <hr>

                <div class="band_details">
                  <h5>بنود اخرى</h5>
                  <div class="band" id="main-band">
                  <?php 
                    $x = 0;
                    $res_extra = mysqli_query($conn, "SELECT * FROM extra_band WHERE `product_id` = $item_id ");
                    while ($extra_band = mysqli_fetch_array($res_extra)) {
                      $x++;
                      ?>
                    <div class="row">
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="band">أسم البند</label>
                          <input type="text" class="form-control" name="band_<?= $x ?>" id="band_<?= $x ?>" value="<?=$extra_band['name']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="band_price">سعر البند</label>
                          <input type="text" class="form-control" name="band_price_<?= $x ?>" id="band_price_<?= $x ?>" value="<?=$extra_band['price_per_piece']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label for="band_tot">السعر </label>
                          <input type="text" class="form-control" name="band_tot_<?= $x ?>" id="band_tot_<?= $x ?>" readonly value="<?=$extra_band['total_price']?>">
                          <input type="hidden" name="extra_id_<?= $x ?>" value="<?=$extra_band['id']?>" readonly>
                          
                        </div>
                      </div>
                    </div>
                    <hr class="new2">
                    <?php } ?>
                    <input type="hidden" name="band-rr" id="band-rr" readonly value="<?=$x?>">
                    <script>
                      b = 1;
                      $(document).on('change', 'input', function() {
                        var total_bands = 0;
                        for (var z = 1; z <= <?=$x?>; z++) {
                          var peice = ((parseFloat($("#band_price_" + z).val()) * parseFloat($("#quantity").val()) || 0))
                          total_bands += peice
                          peice = peice.toLocaleString("en-US");
                          $("#band_tot_" + z).val(peice);
                        }
                        total_bands = total_bands.toLocaleString("en-US");
                        $("#accessory_tot").val(total_bands);
                      });

                      $( document ).ready(function() {
                        var total_bands = 0;
                        for (var z = 1; z <= <?=$x?>; z++) {
                          var peice = ((parseFloat($("#band_price_" + z).val()) * parseFloat($("#quantity").val()) || 0))
                          total_bands += peice
                          peice = peice.toLocaleString("en-US");
                          $("#band_tot_" + z).val(peice);
                        }
                        total_bands = total_bands.toLocaleString("en-US");
                        $("#accessory_tot").val(total_bands);
                      });

                      
                      </script>

                  </div>

                </div>
                
                <div class="row">
                  السعر الكلي للبنود الاضافية
                  <input type="text" class="form-control" placeholder="Total" name="accessory_tot" id="accessory_tot" readonly>
                </div>
                <hr>
                        
                <div class="Delivery-details">
                  <h5>التوصيل</h5>
                  <div class="delivery">
                  <div class="row">
                      <label for="">هل الصنف قابل للتوصيل ؟</label>
                      <div class="form-check form-switch col-md-2 col-sm-6">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="deliverable" <?php if ($delivery_band['deliverable'] == 1){ echo 'checked';} ?>>
                        <label class="form-check-label" id="toggle_ch" for="flexSwitchCheckDefault">لا</label>
                      </div>
                      <script>
                        $(document).ready(function() {
                          $('input[type="checkbox"]').click(function() {
                            if (document.getElementById("flexSwitchCheckDefault").checked == true) {
                              
                              document.getElementById("toggle_ch").innerText = "نعم";
                            } else {
                              
                              document.getElementById("toggle_ch").innerText = "لا";
                            }
                          });
                        });
                      </script>
                  </div>
                    <div class="row" id="delivery-div">
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="peice_per_track">عدد القطع للتريلة</label>
                          <input type="text" class="form-control" name='peice_per_track' id="peice_per_track" value="<?=$delivery_band['peice_per_track']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="quantity_of_track">عدد التريلات</label>
                          <input type="text" class="form-control" name='quantity_of_track' id="quantity_of_track" value="<?=$delivery_band['quantity_of_track']?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="delivery_to">التوصيل الى</label>
                          <input type="text" class="form-control" name='delivery_to' id="delivery_to" value="<?=$delivery_band['delivery_to']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="track_price">سعر توصيل التريلة</label>
                          <input type="text" class="form-control" name='track_price' id="track_price" value="<?=$delivery_band['track_price']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="piece_price">سعر توصيل القطعة</label>
                          <input type="text" class="form-control" name='piece_price' id="piece_price" value="<?=$delivery_band['piece_price']?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="total_price">سعر التوصيل الكلي</label>
                          <input type="text" class="form-control" name='total_price' id="total_price" value="<?=$delivery_band['total_price']?>" readonly>
                        </div>
                      </div>
                    </div>
                    <script>
                      $("input").on("change", function() {
                        var quan = ($("#quantity").val() || 0) ;
                        var del_peice = ($("#peice_per_track").val() || 0) ;
                        var tracks = ((quan / del_peice) || 0) ;
                        tracks = Math.ceil(tracks);
                         $("#quantity_of_track").val(tracks) ;
                        var track_price = ($("#track_price").val() || 0) ;
                        var del_peice_price = ((track_price / del_peice)|| 0);
                        $("#piece_price").val(del_peice_price);
                        var del_total = track_price * tracks ; 
                        $("#total_price").val(del_total);

                       
                        
                      });

                      $( document ).ready(function() {
                        var quan = ($("#quantity").val() || 0) ;
                        var del_peice = ($("#peice_per_track").val() || 0) ;
                        var tracks = ((quan / del_peice) || 0) ;
                        tracks = (Math.ceil(tracks) || 0) ;
                         $("#quantity_of_track").val(tracks) ;
                        var track_price = ($("#track_price").val() || 0) ;
                        var del_peice_price = ((track_price / del_peice)|| 0);
                        $("#piece_price").val(del_peice_price);
                        var del_total = track_price * tracks ; 
                        $("#total_price").val(del_total);
                      });
                    </script>

                  </div>
                </div>
                <hr>
               

                <!-- Item End -->

                <div class="Final_details">
                  <h5>الحساب النهائي</h5>
                  <div class="final">
                    <div class="row">


                      <div class="col-md-2 col-sm-6 ">
                      <div class="form-group">
                          <label for="cover_price">تكلفة الصنف الواحد</label>
                          <input type="text" class="form-control" name='prod_peice' id="prod_peice" readonly >
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                      <div class="form-group">
                          <label for="cover_price">تكلفة جميع الاصناف</label>
                          <input type="text" class="form-control" name='prod_peice_tot' id="prod_peice_tot" readonly >
                        </div>
                        
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_tot">سعر البيع للصنف</label>
                          <input type="text" class="form-control" name='sell_price' id="sell_price" value="<?=$item['sell_price']?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_tot">مجموع سعر البيع</label>
                          <input type="text" class="form-control" name='sell_price_tot' id="sell_price_tot" readonly >
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_tot">نسبة الربح</label>
                          <input type="text" class="form-control" name='net_peice' id="net_peice" readonly >
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_tot">الربح للصنف الواحد</label>
                          <input type="text" class="form-control" name='net_toti_peice' id="net_toti_peice" readonly>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 ">
                        <div class="form-group">
                          <label for="cover_tot">إجمالي الربح</label>
                          <input type="text" class="form-control" name='net_toti' id="net_toti" readonly >
                        </div>
                      </div>
                    </div>
                    <script>
                      $(document).on("change", "input", function() {
                        var kh = (parseFloat($("#kh_tot").val().replace(/\,/g, "")) || 0);

                        var iro = (parseFloat($("#total_iron").val().replace(/\,/g, "")) || 0);

                        var acce = (parseFloat($("#accessory_iron").val().replace(/\,/g, "")) || 0);

                        var cov = (parseFloat($("#cover_tot").val().replace(/\,/g, "")) || 0);

                        var exband = (parseFloat($("#accessory_tot").val().replace(/\,/g, "")) || 0);
                        var quan = (parseFloat($("#quantity").val()) || 0);

                        var grand_tot = (kh + iro + acce + cov + exband) / quan;
                        var grand_tot2 = (kh + iro + acce + cov + exband);




                        var sel_price = $("#sell_price").val();
                        var ful_price = sel_price * quantity;
                        ful_price = ful_price.toLocaleString("en-US");
                        $("#sell_price_tot").val(sel_price * quan);
                        if (sel_price != "") {
                          var net_peice = (((sel_price - grand_tot) / grand_tot) * 100).toFixed(2);
                          $("#net_peice").val(net_peice + "%");
                          net_tot = ((sel_price * quan) - (grand_tot * quan)).toFixed(2);
                          net_tot_piece = ((sel_price) - (grand_tot)).toFixed(2);
                          net_tot = net_tot.toLocaleString("en-US");
                          net_tot_piece = net_tot_piece.toLocaleString("en-US");
                          $("#net_toti").val(net_tot);
                          $("#net_toti_peice").val(net_tot_piece);
                        }
                        grand_tot = grand_tot.toLocaleString("en-US");
                        grand_tot2 = grand_tot2.toLocaleString("en-US");
                        $("#prod_peice").val(grand_tot);
                        $("#prod_peice_tot").val(grand_tot2);


                      });




                      $( document ).ready(function() {
                        var kh = (parseFloat($("#kh_tot").val().replace(/\,/g, "")) || 0);

                        var iro = (parseFloat($("#total_iron").val().replace(/\,/g, "")) || 0);

                        var acce = (parseFloat($("#accessory_iron").val().replace(/\,/g, "")) || 0);

                        var cov = (parseFloat($("#cover_tot").val().replace(/\,/g, "")) || 0);

                        var exband = (parseFloat($("#accessory_tot").val().replace(/\,/g, "")) || 0);
                        var quan = (parseFloat($("#quantity").val()) || 0);

                        var grand_tot = (kh + iro + acce + cov + exband) / quan;
                        var grand_tot2 = (kh + iro + acce + cov + exband);




                        var sel_price = $("#sell_price").val();
                        var ful_price = sel_price * quantity;
                        ful_price = ful_price.toLocaleString("en-US");
                        $("#sell_price_tot").val(sel_price * quan);
                        if (sel_price != "") {
                          var net_peice = (((sel_price - grand_tot) / grand_tot) * 100).toFixed(2);
                          $("#net_peice").val(net_peice + "%");
                          net_tot = ((sel_price * quan) - (grand_tot * quan)).toFixed(2);
                          net_tot_piece = ((sel_price) - (grand_tot)).toFixed(2);
                          net_tot = net_tot.toLocaleString("en-US");
                          net_tot_piece = net_tot_piece.toLocaleString("en-US");
                          $("#net_toti").val(net_tot);
                          $("#net_toti_peice").val(net_tot_piece);
                        }
                        grand_tot = grand_tot.toLocaleString("en-US");
                        grand_tot2 = grand_tot2.toLocaleString("en-US");
                        $("#prod_peice").val(grand_tot);
                        $("#prod_peice_tot").val(grand_tot2);
                      });
                    </script>

                  </div>
                </div>



             
              </div>
              <!-- Product End -->


              <br><br>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <style>
                      .myButton {
                        border: none;
                        cursor: pointer;
                        background: #8392AB;
                        color: #fff;
                        border-radius: 20px;
                        transition: 0.5s;
                      }

                      .myButton:hover {
                        background: #344767;
                        letter-spacing: 1px;
                      }
                    </style>
                    <button type="submit" class="myButton col-md-6 col-sm-6 mt-5 btn btn-secondary rounded-pill" name="add-project">
                      تعديل الصنف
                    </button>

                    
                  </div>
                </div>
                <div class="col">

                </div>
              </div>
            </div>
            
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
  <script src="script.js"></script>
  <script src="../assets/js/plugins/choices.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>