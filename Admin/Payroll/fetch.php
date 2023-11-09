<?php
sleep(1);
include('../../cookies/session3.php');

if (isset($_POST['request'])) {

    $request = $_POST['request'];

    $query = "SELECT * FROM payroll_process WHERE department = '$request'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);




?>

    <table class="table">
        <?php
        if ($count) {
        ?>
            <thead>
                <tr>
                    <th rowspan="2">الرقم</th>
                    <th rowspan="2">اسم الموظف</th>
                    <th rowspan="2">الراتب الاساسي</th>
                    <th rowspan="2">اضافات</th>
                    <th rowspan="2">اجمالي الراتب</th>
                    <th colspan="4">الاقتطاعات </th>
                    <th rowspan="2">مجموع الاقتطاعات</th>
                    <th rowspan="2">صافي الراتب المستحق</th>
                    <th rowspan="2">عدد الايام</th>
                </tr>
                <tr>
                    <th>مخالفات</th>
                    <th>غيابات</th>
                    <th>تاخير</th>
                    <th>سلف و اخرى</th>
                </tr>
            <?php
        } else {
            echo "Sorry! No record Found";
        }
            ?>
            </thead>
            <?php
            while ($rr = mysqli_fetch_assoc($result)) {
            ?>
                <tbody class=" text-center">

                    <tr>
                        <th scope="row"><?= $rr['id'] ?></th>
                        <td class="border-1"><?= $rr['emp_name'] ?></td>
                        <td class="border-1"><?= $rr['salary'] ?></td>
                        <td class="border-1"><?= $rr['extra'] ?></td>
                        <td class="border-1"><?= $rr['total_salary'] ?></td>
                        <td class="border-1"><?= $rr['fees'] ?></td>
                        <td class="border-1"><?= $rr['absend'] ?></td>
                        <td class="border-1"><?= $rr['late'] ?></td>
                        <td class="border-1"><?= $rr['advanced'] ?></td>
                        <td class="border-1"><?= $rr['deductions_total'] ?></td>
                        <td class="border-1"><?= $rr['net_salary'] ?></td>
                        <td class="border-1"><?= $rr['work_days'] ?></td>


                    </tr>
                <?php
            }
                ?>

                </tbody>


    </table>
<?php
}
?>