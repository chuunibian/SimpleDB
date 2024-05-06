<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "ip2"; //CHANGE DATABASE!

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Dnumber = $_POST['Dnumber'];
    $Dname = $_POST['Dname'];
    $Mgr_ssn = $_POST['Mgr_ssn'];
    $Mgr_start_date = $_POST['Mgr_start_date'];

    //Info checks
    //First check if department number already used
    $sql = "SELECT COUNT(*) FROM DEPARTMENT WHERE Dnumber = '$Dnumber'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];
    if($count > 0 || empty($Dnumber)){ //CHECK IF SSN ALREADY EXISTS
        echo "Department Number Duplicate Error or Empty!";
    } else {
        //Check if input manager exists
        $sql = "SELECT COUNT(*) FROM EMPLOYEE WHERE SSN = '$Mgr_ssn'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_fetch_array($result)[0];
        if($count == 0 || empty($Mgr_ssn)){
            echo "Input Manager SSN Does Not Exist In Employees or no ssn provided!";
        }else{
            if(empty($Mgr_start_date)){ $Mgr_start_date = NULL;}
            $sql = "INSERT INTO DEPARTMENT(Dname, Dnumber, Mgr_ssn, Mgr_start_date) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siss", $Dname, $Dnumber, $Mgr_ssn, $Mgr_start_date);
            $stmt->execute();
            $stmt->close();

            $sql = "INSERT INTO DEPT_LOCATIONS(Dnumber, Dlocation) VALUES ('$Dnumber','Columbus')";
            $result = mysqli_query($conn, $sql);

            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Add New Department</title>
            </head>
            <body>
                <p2> SUCCESS! Check below of output of current departments </p>
            </body>
            </html>
            <?php

            $sql = "SELECT * FROM DEPARTMENT"; //print out all emp
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                echo $row[0]." ".$row[1]. "<br>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Company Database Management Function</title>
</head>
<body>
    <p><a href="IP2.php">Go back to Database Management Function Board</a></p>
</body>
</html>
