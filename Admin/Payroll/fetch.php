<?php
sleep(1);
include('../../cookies/session3.php');

if (isset($_POST['request'])) {

    $request = $_POST['request'];

   










echo '<table class="table table-hover table-bordered table-fixed">
                                    <thead class="bg-dark text-light table-bordered text-center">
                                        <tr>
                                            <th rowspan="2">الرقم</th>
                                            <th rowspan="2">إسم الموظف</th>
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
                                    </thead>

                                    <tbody class="text-center">
                                        <?php
                                        $show_products_status = mysqli_query($conn, "SELECT * FROM `employee` WHERE `department` = \'$request\'");
                                        while ($r = mysqli_fetch_array($show_products_status)) {

                                        ?>
                                            <tr>
                                                <th class="text-secondary" scope="row">RA-EMP-<?= $r["id"] ?></th>
                                                <td class="border-1"><input type="text" class="form-control" name="name[]" value="<?= $r["name"] ?>" readonly></td>
                                                <td class="border-1"><input type="text" class="form-control" name="salary[]" value="<?= $r["salary"] ?>" readonly></td>
                                                <td class="border-1"><input type="text" class="form-control" name="extra[]" value="0"></td>
                                                <td class="border-1"><input type="text" class="form-control" name="total_salary[]" value="0"></td>
                                                <td class="border-1"><input type="text" class="form-control" name="fee[]" value="0"></td>
                                                <td class="border-1"><input type="text" class="form-control" name="absend[]" value="0"></td>
                                                <td class="border-1"><input type="text" class="form-control" name="latee[]" value="0"></td>
                                                <?php
                                                $user_id = $r["user_id"];
                                                $query = "SELECT * FROM `advance_status` WHERE `emp_id` = $user_id";
                                                $res = $conn->query($query);
                                                $advanced = $res->fetch_assoc();
                                                ?>
                                                <td class="border-1"><input type="text" class="form-control" name="advancedd[]" value="<?php if ($advanced["amount"] != "") {
                                                                                                                                            echo $advanced["amount"];
                                                                                                                                        } else echo "0"; ?>"></td>
                                                <td class="border-1"><input type="text" class="form-control" name="deductions_total[]" value="0"></td>
                                                <td class="border-1"><input type="text" class="form-control" name="net_salary[]" value="0"></td>
                                                <td class="border-1"><input type="text" class="form-control" name="work_days[]" value="0"></td>
                                            </tr>
                                            <input type="text" class="form-control" name="emp_id[]" value="<?= $r["user_id"] ?>" hidden>                                                                                              
                                        <?php } ?>
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                            $(document).on("change", "input", function() {
                                                var salary = $("input[name="salary[]"]");
                                                var extra = $("input[name="extra[]"]");
                                                var total_salary = $("input[name="total_salary[]"]");
                                                var fee = $("input[name="fee[]"]");
                                                var absend = $("input[name="absend[]"]");
                                                var latee = $("input[name="latee[]"]");
                                                var advancedd = $("input[name="advancedd[]"]");
                                                var deductions_total = $("input[name="deductions_total[]"]");
                                                var net_salary = $("input[name="net_salary[]"]");
                                                var work_days = $("input[name="work_days[]"]");
                                                var salary_per_day = 0
                                                for (var i = 0; i < salary.length; i++) {
                                                    salary_per_day = (parseFloat(salary[i].value) / 30);
                                                    $("input[name="absend[]"]").eq(i).val(parseFloat((salary[i].value) - (salary_per_day * work_days[i].value)).toFixed(2));

                                                    $("input[name="total_salary[]"]").eq(i).val(parseFloat(salary[i].value) + parseFloat(extra[i].value));
                                                    $("input[name="deductions_total[]"]").eq(i).val(parseFloat(fee[i].value) + parseFloat(absend[i].value) + parseFloat(latee[i].value) + parseFloat(advancedd[i].value));
                                                    $("input[name="net_salary[]"]").eq(i).val(parseFloat(total_salary[i].value - deductions_total[i].value).toFixed(2));
                                                }
                                            });
                                        </script>
                                </table>';

}

?>