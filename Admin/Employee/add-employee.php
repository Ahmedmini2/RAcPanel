<?php
include('../../cookies/session3.php');
include('../../cookies/insert-method.php');
$_SESSION['sidebar_admin'] = "employee";
if (isset($_GET['edit'])) {

    $id = $_GET['edit'];
    $query = "SELECT * FROM employee WHERE id=$id";
    $res = $conn->query($query);
    $editData = $res->fetch_assoc();
    $name_en = $editData['name_en'];
    $name_ar = $editData['name_ar'];
    $email = $editData['email'];
    $phone = $editData['phone'];
    $phone_code = $editData['phone_code'];
    $nationality = $editData['nationality'];
    $gender = $editData['gender'];
    $birth = $editData['birth'];
    $address = $editData['address'];
    $social_status = $editData['social_status'];
    $id_number = $editData['id_number'];
    $id_issue_date = $editData['id_issue_date'];
    $id_source = $editData['id_source'];
    $position = $editData['position'];
    $department = $editData['department'];
    $salary = $editData['salary'];
    $start_date = $editData['start_date'];
    $contract_period = $editData['contract_period'];
    $contract_type = $editData['contract_type'];
    $trial_period = $editData['trial_period'];
    $working_hours = $editData['working_hours'];
    $working_days = $editData['working_days'];
    $car_insurance = $editData['car_insurance'];
    $gas_insurance = $editData['gas_insurance'];
    $medical_insurance = $editData['medical_insurance'];
    $extra_perc = $editData['extra_perc'];
    $phone_and_sim = $editData['phone_and_sim'];
    $house_insurance = $editData['house_insurance'];
    $auto_renew = $editData['auto_renew'];
    $vication_year = $editData['vication_year'];
    $tickets = $editData['tickets'];

    if (isset($_POST['submit'])) {
        extract($_POST);

        // UPDATE EMPLOYEE DATA
        $employee_data = [
            'name_en' => $name_en,
            'name_ar' => $name_ar,
            'email' => $email,
            'phone' => $phone,
            'phone_code' => $phone_code,
            'nationality' => $nationality,
            'gender' => $gender,
            'birth' => $birth,
            'address' => $address,
            'social_status' => $social_status,
            'id_number' => $id_number,
            'id_issue_date' => $id_issue_date,
            'id_source' => $id_source,
            'position' => $position,
            'department' => $department,
            'salary' => $salary,
            'start_date' => $start_date,
            'contract_period' => $contract_period,
            'contract_type' => $contract_type,
            'trial_period' => $trial_period,
            'working_days' => $working_days,
            'working_hours' => $working_hours,
            'car_insurance' => $car_insurance,
            'gas_insurance' => $gas_insurance,
            'medical_insurance' => $medical_insurance,
            'extra_perc' => $extra_perc,
            'phone_and_sim' => $phone_and_sim,
            'house_insurance' => $house_insurance,
            'auto_renew' => $auto_renew,
            'vication_year' => $vication_year,
            'tickets' => $tickets,
        ];

        $employee_table = 'employee';

        if (!empty($employee_data) && !empty($employee_table) && !empty($id)) {
            $updateData = update_data($employee_data, $employee_table, $id);
            if ($updateData) {
                $_SESSION['notification'] = "تم تعديل الموظف بنجاح";
                header('location: view-employee.php');
                exit();
            } else {
                $_SESSION['notification'] = "يوجد خلل في النظام";
                header('location: view-employee.php');
                exit();
            }
        }
    }
} else if (isset($_POST['submit'])) {
    extract($_POST);

    // INSERT NEW USER
    $data = [
        'full_name' => $name_ar,
        'email' => $email,
        'username' => $name_en,
        'phone' => $phone,
        'role' => 3,
        'position' => 'Employee',
        'status' => 1,
        'password' => md5('Ruknamial@123')

    ];


    $tableName = 'users';
    if (!empty($data) && !empty($tableName)) {
        $insertData = insert_data($data, $tableName);
        if ($insertData) {
            $_SESSION['notification'] = "User Profile Added sucessfully";
        } else {
            $_SESSION['notification'] = "Error!.. check your query";
        }
    }
    $inserted_id = $db->insert_id;

    // INSERT EMPTY ADVANCE SALARY
    $advance_status_data = [
        'emp_id' => $inserted_id,
        'amount' => 0,
    ];
    $tableName2 = 'advance_status';
    if (!empty($advance_status_data) && !empty($tableName2)) {
        $insertData2 = insert_data($advance_status_data, $tableName2);
        if ($insertData2) {
            $_SESSION['notification'] = "User Profile Added sucessfully";
        } else {
            $_SESSION['notification'] = "Error!.. check your query";
        }
    }

    // INSERT EMPLOYEE DATA
    $employee_data = [
        'user_id' => $inserted_id,
        'name_en' => $name_en,
        'name_ar' => $name_ar,
        'email' => $email,
        'phone' => $phone,
        'phone_code' => $phone_code,
        'nationality' => $nationality,
        'gender' => $gender,
        'birth' => $birth,
        'address' => $address,
        'social_status' => $social_status,
        'id_number' => $id_number,
        'id_issue_date' => $id_issue_date,
        'id_source' => $id_source,
        'position' => $position,
        'department' => $department,
        'salary' => $salary,
        'start_date' => $start_date,
        'contract_period' => $contract_period,
        'contract_type' => $contract_type,
        'trial_period' => $trial_period,
        'working_days' => $working_days,
        'working_hours' => $working_hours,
        'car_insurance' => $car_insurance,
        'gas_insurance' => $gas_insurance,
        'medical_insurance' => $medical_insurance,
        'extra_perc' => $extra_perc,
        'phone_and_sim' => $phone_and_sim,
        'house_insurance' => $house_insurance,
        'auto_renew' => $auto_renew,
        'vication_year' => $vication_year,
        'tickets' => $tickets,

    ];

    $employee_table = 'employee';

    if (!empty($employee_data) && !empty($employee_table)) {
        $insertData = insert_data($employee_data, $employee_table);
        if ($insertData) {
            $_SESSION['notification'] = "تم اضافة الموظف بنجاح";
            header('location: view-employee.php');
            exit();
        } else {
            $_SESSION['notification'] = "يوجد خلل في النظام";
            header('location: view-employee.php');
            exit();
        }
    }
} else {

    $name_en = "";
    $name_ar = "";
    $email = "";
    $phone = "";
    $phone_code = "";
    $nationality = "";
    $gender = "";
    $birth = "";
    $social_status = "";
    $address = "";
    $id_number = "";
    $id_issue_date = "";
    $id_source = "";
    $position = "";
    $department = "";
    $salary = "";
    $start_date = "";
    $contract_type = "";
    $contract_period = "";
    $trial_period = "";
    $working_hours = "";
    $working_days = "";
    $car_insurance = "";
    $gas_insurance = "";
    $medical_insurance = "";
    $extra_perc = "";
    $phone_and_sim = "";
    $house_insurance = "";
    $auto_renew = "";
    $vication_year = "";
    $tickets = "";
}
?>

<html lang="ar" dir="rtl">

<head>
    <!-- Blazor -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="_content/Blazor.Bootstrap/blazor.bootstrap.css" rel="stylesheet" /> -->
    <!-- Blazor js -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
    <!-- Add chart.js reference if chart components are used in your application. -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.js" integrity="sha512-gQhCDsnnnUfaRzD8k1L5llCCV6O9HN09zClIzzeJ8OJ9MpGmIlCxm+pdCkqTwqJ4JcjbojFr79rl2F1mzcoLMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- Add chartjs-plugin-datalabels.min.js reference if chart components with data label feature is used in your application. -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="_content/Blazor.Bootstrap/blazor.bootstrap.js"></script> -->

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <title>
       سكايب  | Skype Contracting
    </title>
    <!--     Fonts and icons     -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="../../assets/css/custom.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
</head>


<body class="g-sidenav-show rtl ">



    <!-- Side Bar -->
    <?php require_once('../../components/sidebar_admin.php'); ?>


    <!-- End Of side Bar -->
    <main class="main-content position-relative lg:max-height-vh-100 lg:h-100 mt-1 border-radius-lg overflow-hidden" style="-webkit-overflow-scrolling: touch;overflow-y: scroll;">
        <!-- Navbar -->
        <?php
        $titleNav = 'اضافه موظف';
        require_once('../../components/navbar.php');
        ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="block block-themed">

                    <div class="block-header bg-gradient-dark  col-md-4 col-sm-6 col-xs-6  rounded-pill">

                        <h6 class="block-title text-white py-2 px-4">إضافة موظف جديد</h6>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">

                        <div class="row">

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>اسم الموظف بالانجليزي</label>
                                    <input type="text" placeholder=" الرجاء ادخال اسم الموظف بالانجليزي" class="form-control" name="name_en" value="<?= $name_en ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> اسم الموظف بالعربي</label>
                                    <input type="text" placeholder="الرجاء ادخال اسم الموظف بالعربي" class="form-control" name="name_ar" value="<?= $name_ar ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>رقم الهاتف</label>
                                    <input type="text" placeholder="رقم الهاتف الخاص بالموظف" class="form-control" name="phone" value="<?= $phone ?>">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>رقم تحويلة الهاتف</label>
                                    <input type="text" placeholder="رقم الهاتف الخاص بالموظف" class="form-control" name="phone_code" value="<?= $phone_code ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>البريد الإلكتروني</label>
                                    <input type="email" placeholder="البريد الإلكتروني" class="form-control" name="email" value="<?= $email ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>القسم</label>
                                    <select name="department" class="form-control">
                                        <option value="<?= $department ?>"><?= $department ?></option>

                                        <?php
                                        $select = mysqli_query($conn, "select * from departments");
                                        while ($r = mysqli_fetch_array($select)) {

                                            echo '<option value="' . $r['name'] . '">' . $r['name'] . '</option>';
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>الوظيفة</label>
                                    <input type="text" placeholder="المسمى الوظيفي" class="form-control" name="position" value="<?= $position ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> راتب الموظف</label>
                                    <input type="text" placeholder=" مرتب الموظف" class="form-control" name="salary" value="<?= $salary ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> عدد ساعات العمل</label>
                                    <select name="working_hours" class="form-control">
                                        <option value="<?= $working_hours ?>"><?= $working_hours ?></option>
                                        <option value="6 ساعات">6 ساعات</option>
                                        <option value="8 ساعات">8 ساعات</option>
                                        <option value="10 ساعات">10 ساعات</option>
                                        <option value="12 ساعة">12 ساعة</option>

                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>الجنسية</label>
                                    <input type="text" placeholder="اكتب جنسية الموظف" class="form-control" name="nationality" value="<?= $nationality ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> تاريخ الميلاد</label>
                                    <input type="date" class="form-control" name="birth" value="<?= $birth ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>رقم الهوية / جواز السفر</label>
                                    <input type="text" placeholder="اكتب رقم الهوية" class="form-control" name="id_number" value="<?= $id_number ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> الجنس</label>
                                    <select name="gender" class="form-control">
                                        <option value="<?= $gender ?>"><?= $gender ?></option>
                                        <option value="ذكر">ذكر</option>
                                        <option value="انثى">انثى</option>


                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> الحالة الإجتماعية</label>
                                    <select name="social_status" class="form-control">
                                        <option value="<?= $social_status ?>"><?= $social_status ?></option>
                                        <option value="متزوج">متزوج</option>
                                        <option value="اعزب">اعزب</option>
                                        <option value="أرملة">أرملة</option>
                                        <option value="مطلق">مطلق</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> نوع العقد</label>
                                    <select name="contract_type" class="form-control">
                                        <option value="<?= $contract_type ?>"><?= $contract_type ?></option>
                                        <option value="كامل">دوام كامل</option>
                                        <option value="جزئي">دوام جزئي</option>
                                        <option value="مؤقت">دوام مؤقت</option>
                                            <!-- use if to -->
                                        <option value="عن بعد">دوام عن بعد</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> تاريخ بداية التوظيف</label>
                                    <input type="date" class="form-control" name="start_date" value="<?= $start_date ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> مدة العقد </label>
                                    <select name="contract_period" class="form-control">
                                        <option value="<?= $contract_period ?>"><?= $contract_period ?></option>
                                        <option value="سنة">سنة</option>
                                        <option value="سنتين">سنتين</option>
                                        <option value="ثلاثة سنين">ثلاثة سنين</option>
                                        <option value="اربعة سنين">اربعة سنين</option>
                                        <option value="خمسة سنين">خمسة سنين</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> تاريخ نهاية فترة التجربة</label>
                                    <select name="trial_period" class="form-control">
                                        <option value="<?= $trial_period ?>"><?= $trial_period ?></option>
                                        <option value="شهر">شهر</option>
                                        <option value="شهرين">شهرين</option>
                                        <option value="ثلاثة شهور">ثلاثة شهور</option>
                                        <option value="اربعة شهور">اربعة شهور</option>
                                        <option value="خمسة شهور">خمسة شهور</option>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>تاريخ اصدار الاقامة </label>
                                    <input type="date" placeholder="الرجاء ادخال تاريخ اصدار الاقامة" class="form-control" name="id_issue_date" value="<?= $id_issue_date ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>مصدر الاقامة</label>
                                    <input type="text" placeholder="الرجاء ادخال مصدر الاقامة" class="form-control" name="id_source" value="<?= $id_source ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>العنوان</label>
                                    <input type="text" placeholder="الرجاء ادخال عنوان السكن" class="form-control" name="address" value="<?= $address ?>">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> تأمين السيارة </label>
                                    <select name="car_insurance" class="form-control">
                                        <option value="<?= $car_insurance ?>"><?= $car_insurance ?></option>
                                        <option value="يوجد">يوجد</option>
                                        <option value="لا يوجد">لا يوجد</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> تأمين محروقات السيارة </label>
                                    <select name="gas_insurance" class="form-control">
                                        <option value="<?= $gas_insurance ?>"><?= $gas_insurance ?></option>
                                        <option value="يوجد">يوجد</option>
                                        <option value="لا يوجد">لا يوجد</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> التأمين الطبي </label>
                                    <select name="medical_insurance" class="form-control">
                                        <option value="<?= $medical_insurance ?>"><?= $medical_insurance ?></option>
                                        <option value="تأمين شخصي">تأمين شخصي</option>
                                        <option value="تأمين طبى له ولأفراد العائلة">تأمين طبى له ولأفراد العائلة</option>
                                        <option value="لا يوجد">لا يوجد</option>

                                    </select>
                                </div>

                            </div>

                            <div class="row">

                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> نسبة الحافز </label>
                                    <select name="extra_perc" class="form-control">
                                        <option value="<?= $extra_perc ?>"><?= $extra_perc ?></option>
                                        <option value="1%">1%</option>
                                        <option value="2%">2%</option>
                                        <option value="3%">3%</option>
                                        <option value="4%">4%</option>
                                        <option value="5%">5%</option>
                                        <option value="5%">7%</option>
                                        <option value="5%">10%</option>
                                        <option value="5%">20%</option>
                                        <option value="5%">25%</option>
                                        <option value="5%">30%</option>
                                        <option value="5%">40%</option>
                                        <option value="5%">50%</option>
                                        <option value="لا يوجد">لا يوجد</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> توفير جوال وشريحة اتصال </label>
                                    <select name="phone_and_sim" class="form-control">
                                        <option value="<?= $phone_and_sim ?>"><?= $phone_and_sim ?></option>
                                        <option value="يوجد">يوجد</option>
                                        <option value="لا يوجد">لا يوجد</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> توفير بدل سكن </label>
                                    <select name="house_insurance" class="form-control">
                                        <option value="<?= $house_insurance ?>"><?= $house_insurance ?></option>
                                        <option value="يوجد">يوجد</option>
                                        <option value="لا يوجد">لا يوجد</option>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> هل يجدد مدة العقد؟ </label>
                                    <select name="auto_renew" class="form-control">
                                        <option value="<?= $auto_renew ?>"><?= $auto_renew ?></option>
                                        <option value="تلقائيا">تلقائيا</option>
                                        <option value="لا ">لا </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> استحقاق الاجازة </label>
                                    <select name="vication_year" class="form-control">
                                        <option value="<?= $vication_year ?>"><?= $vication_year ?></option>
                                        <option value="سنوية">سنة</option>
                                        <option value="كل سنتين">سنتين</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> تذاكر السفر </label>
                                    <select name="tickets" class="form-control">
                                        <option value="<?= $tickets ?>"><?= $tickets ?></option>
                                        <option value="ذهاب واياب">ذهاب واياب</option>
                                        <option value="ذهاب فقط">ذهاب فقط</option>
                                        <option value="ذهاب واياب له ولافرادعائلته">ذهاب واياب له ولافرادعائلته</option>
                                        <option value="ذهاب واياب له ولزوجته وطفلين">ذهاب واياب له ولزوجته وطفلين</option>

                                        <option value="لا يوجد">لا يوجد</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">


                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> عدد ايام العمل </label>
                                    <select name="working_days" class="form-control">
                                        <option value="<?= $working_days ?>"><?= $working_days ?></option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>

                                    </select>
                                </div>
                            </div>

                        </div>




                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-secondary">Save</button>
                                </div>
                            </div>
                            <div class="col">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php require_once('../../components/footer.php'); ?>
        </div>

    </main>



    <!--   Core JS Files   -->
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../../assets/js/plugins/chartjs.min.js"></script>

    <script src="../../assets/js/plugins/choices.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').dataTable();
        });
    </script>
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
    <script src="../../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to fetch notifications from the server
        function fetchNotifications() {
            // Make an AJAX request to the server to fetch notifications
            $.ajax({
                url: 'scripts/notifications/fetch_notification.php', // Replace with the actual URL
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Process the notifications data and update the notification UI
                    updateNotificationUI(data);

                },
                error: function(error) {
                    console.error('Error fetching notifications:', error);
                },
            });
        }

        // Function to update the notification UI with new data
        function updateNotificationUI(data) {
            $('#notifications-container').empty();
            let unreadCount = 0;
            console.log(data);
            // Clear the existing notifications
            $('#notifications-container').empty();

            // Loop through the received notifications and add them to the UI
            data.forEach(function(notification) {
                const notificationItem = $('<li>').addClass('mb-2');
                const notificationLink = $('<a>').addClass('dropdown-item border-radius-md').attr('href', 'javascript:;');
                notificationLink.html('<h6>' + notification.title + '</h6><p>' + notification.message + '</p>');
                if (notification.read_at !== null) {
                    notificationLink.addClass('read-notification');
                } else {
                    unreadCount++;
                }
                const markAsReadButton = $('<button>').text('Mark as Read').addClass('btn btn-sm btn-primary');
                markAsReadButton.on('click', function() {
                    markNotificationAsRead(notification.id); // Mark notification as read when clicked
                });

                notificationItem.append(notificationLink);
                notificationItem.append(markAsReadButton);
                $('#notifications-container').append(notificationItem);

                console.log(notification);
            });
            $('#notification-count').text(unreadCount); // Update the notification count
        }

        function markNotificationAsRead(notificationId) {
            $.ajax({
                url: 'scripts/notifications/mark_notification_as_read.php', // Replace with the actual URL
                method: 'POST',
                data: {
                    notification_id: notificationId
                },
                dataType: 'json',
                success: function(response) {
                    // Handle the response (e.g., display a success message)
                    console.log(response.message);



                    // Refresh the notifications to reflect the updated status
                    fetchNotifications();
                },
                error: function(error) {
                    console.error('Error marking notification as read:', error);
                },
            });
        }

        // Fetch notifications initially
        fetchNotifications();

        // Poll for new notifications every 5 minutes (adjust the interval as needed)
        setInterval(fetchNotifications, 10000); // 5 minutes = 300,000 milliseconds
    </script>
    <script src="../darkmode.js"></script>
</body>

</html>