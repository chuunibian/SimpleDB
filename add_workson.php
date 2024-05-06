<!DOCTYPE html>
<html>
<head>
    <title>Company Database Management Function</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "ip2"; //CHANGE DATABASE!

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SSN = $_POST['SSN'];
    //Info checks
    //First check if SSN exists
    $sql = "SELECT COUNT(*) FROM EMPLOYEE WHERE SSN = '$SSN'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];
    if ($count == 0 || empty($SSN)) { //CHECK IF SSN ALREADY EXISTS
        echo "This SSN does not correspond to any employee or empty!";
    } else {
        $sql = "SELECT Dno FROM EMPLOYEE WHERE SSN = '$SSN'";
        $SSN_Dno_result = mysqli_query($conn, $sql);
        $SSN_Dno_row = mysqli_fetch_array($SSN_Dno_result);
        $SSN_Dno = $SSN_Dno_row[0];

        ?>
        <form method="post" action="add_workson_selected.php">
            <input type="hidden" name="SSN" value="<?php echo $SSN; ?>">
            <label for="emplist">Select one Project In SSN's Department [Proj_Name Proj_Number] (Note: Entered SSN's Department may not have any projects): </label>
            <select name="Pnumber" id="Pnumber">
            <?php

            $sql = "SELECT Pname, Pnumber FROM PROJECT WHERE Dnum = $SSN_Dno";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $ProjName = $row['Pname'];
                $Pnumber = $row['Pnumber'];
                echo "<option value='$Pnumber'>$ProjName $Pnumber</option>";
            }
            ?>
            </select>
            <?php
            if ($count > 0) {
                echo "<label for='hours'><br><br>*Enter Number of Hours XX.00 (MAX 40 HOURS):</label>";
                echo "<input type='text' name='hours' id='hours'>";
                echo "<input type='submit' value='SUBMIT'>";
            }
            ?>
        </form>
        <?php
    }
}
?>
<p><a href="IP2.php">Go back to Database Management Function Board</a></p>
</body>
</html>
