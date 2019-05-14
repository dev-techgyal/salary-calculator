<!--*
check for database connection by including this file
-->
<?php
/*
 * check the database connection
 * */
require('databaseConnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!--Include the header files here-->
    <?php
    /**
     * This file includes all the header files to be used
     * that is both the css and javascript files
     *
     * The key word require means the file has
     * to be there in order for the application to proceed
     * CTR+RIGHT CLICK TO ACCESS THE FILE
     */
    require 'headerUrls.php';
    ?>

</head>

<body>

<!--Interface-->
<div class="container">
    <div class="row">
        <!--span all page by using col-md-12-->
        <div class="col-md-12">
            <h1 class="text-center text-uppercase"><strong>Salary Calculator</strong></h1>
            <div class="col-sm-5">
                <h3 class="text-center">Organization XYZ</h3>
                <!--
                Starting point of form design
                -->
                <form action="process_salary.php" method="post" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="bookSalary">Book Salary</label>
                        <input type="number" name="bookSalary" placeholder="Enter book salary" required
                               class="form-control" min="0" >
                    </div>

                    <br>
                    <h4 class="text-center">Allowances</h4>
                    <div class="form-group">
                        <label for="houseAllowance">House Allowance</label>
                        <input type="number" name="houseAllowance" placeholder="Enter house allowance" required
                               class="form-control" min="0">
                    </div>
                    <div class="form-group">
                        <label for="medicalAllowance">Medical Allowance</label>
                        <input type="number" name="medicalAllowance" placeholder="Enter medical allowance" required
                               class="form-control" min="0">
                    </div>

                    <br>
                    <h4 class="text-center">Deductions</h4>
                    <div class="form-group">
                        <label for="NHIF">NHIF</label>
                        <input type="number" name="NHIF" placeholder="Enter NHIF" required class="form-control"
                               min="500">
                    </div>
                    <div class="form-group">
                        <label for="NSSF">NSSF</label>
                        <input type="number" name="NSSF" placeholder="Enter NSSF" required class="form-control"
                               min="200">
                    </div>

                    <!--put submit button-->
                    <div class="form-group">
                        <!--
                    We check if data exists in the table if yes we disable the button else enable
                    -->
                        <?php
                        $result = mysqli_query($connection, "SELECT * FROM  table_salary");
                        if (mysqli_num_rows($result) > 0) {
                            echo '
                        <button type="submit" name="processData" class="btn btn-md btn-primary btn-block" disabled><strong>PROCESS</strong>
                        </button>';
                        } else {
                            echo '
                        <button type="submit" name="processData" class="btn btn-md btn-primary btn-block"><strong>PROCESS</strong>
                        </button>';
                        }
                        ?>
                    </div>
                </form>
                <!--
                End point of form design
                -->
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-5">
                <h3 class="text-center">Analysis</h3>
                <hr>
                <!--
                 check if records in table_salary
                 -->
                <?php
                $allowances = 0;
                $deductions = 0;
                $total_salary = 0;
                $net_pay_per_annum = 0;
                $result = mysqli_query($connection, "SELECT * FROM  table_Salary WHERE ID = '1'");
                if (mysqli_num_rows($result) > 0) {
                    /**
                     * code for calculating the entries
                     * That is
                     *  $allowances = 0;
                     * $deductions = 0;
                     * $total_salary = 0;
                     * $net_pay_per_annum = 0;
                     */
                    while ($row = mysqli_fetch_array($result)) {
                        $houseAllowance = $row['houseAllowance'];//get the stored houseAllowance
                        $medicalAllowance = $row['medicalAllowance'];//get the stored medicalAllowance
                        $bookSalary = $row['bookSalary'];//get the stored bookSalary
                        $NHIF = $row['NHIF'];//get the stored NHIF
                        $NSSF = $row['NSSF'];//get teh stored NSSF

                        $PAYE = (0.3 * $bookSalary);//Calculate the PAYE
                        $allowances = $houseAllowance + $medicalAllowance;//Calculate the all allowances
                        $deductions = $PAYE + $NSSF + $NHIF;//Calculate all the deductions
                        $total_salary = ($allowances + $bookSalary) - $deductions;//calculate the total_salary
                        $net_pay_per_annum = $total_salary * 12;//calculate the net_pay_per_annum
                    }

                }
                ?>

                <!--
                Table design for displaying the analysis
                $allowances = 0;
                $deductions = 0;
                $total_salary = 0;
                $net_pay_per_annum = 0;
                -->
                <table class="table-responsive table table-bordered">
                    <tr>
                        <td>Allowances:</td>
                        <td>KES <?php echo number_format($allowances) ?></td>
                    </tr>
                    <tr>
                        <td>Deductions:</td>
                        <td>KES <?php echo number_format($deductions) ?></td>
                    </tr>
                    <tr>
                        <td>Total Salary:</td>
                        <td>KES <?php echo number_format($total_salary) ?></td>
                    </tr>

                    <tr>
                        <td>Net Salary Per Annum:</td>
                        <td>KES <?php echo number_format($net_pay_per_annum) ?></td>
                    </tr>
                </table>
                <hr>
                <form action="truncateTable.php" method="post" class="form-horizontal" role="form">
                    <!--
                    We check if data exists in the table if yes we enable the button else disable
                    -->
                    <?php
                    $result = mysqli_query($connection, "SELECT *FROM table_salary");
                    if (mysqli_num_rows($result) > 0) {
                        echo '
                    <button class="btn btn-md btn-danger btn-block" name="truncateTable">EMPTY TABLE</button>
                ';
                    } else {
                        echo '
                    <button class="btn btn-md btn-danger btn-block" name="truncateTable" disabled>EMPTY TABLE</button>
               ';
                    }
                    ?> </form>
                <hr>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <br>
            <hr>
            <p class="text-center">Designed by Mercy</p>
            <hr>
            <br>
        </div>
    </div>
</div>


<!--Include the .js files here-->
<?php
/**
 * This file include all the javascript files to be used in the design
 * from the specific folders.
 *
 * The key word require means the file has
 * to be there in order for the application to proceed
 * CTR+RIGHT CLICK TO ACCESS THE FILE
 */
require 'javascriptUrls.php';
?>

</body>
</html>