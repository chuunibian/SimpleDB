<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "ip2"; //CHANGE DATABASE!

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = $_POST['fname'];
    $minit = $_POST['Minit'];
    $lname = $_POST['lname'];
    $SSN = $_POST['SSN'];
    $Bdate = date($_POST['Bdate']);
    $Address = $_POST['Address'];
    $Sex = $_POST['Sex'];
    $Salary = $_POST['Salary'];
    $Super_ssn = $_POST['Super_ssn'];
    $Dno = $_POST['Dno'];

    //Info checks
    //First check if false the fall through to produce go back button
    $sql = "SELECT COUNT(*) FROM EMPLOYEE WHERE SSN = '$SSN'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];
    if($count > 0 || empty($SSN)){ //CHECK IF SSN ALREADY EXISTS
        echo "SSN Duplicate Error Or SSN Empty!";
    } else {
        $sql = "SELECT COUNT(*) FROM DEPARTMENT WHERE Dnumber = '$Dno'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_fetch_array($result)[0];
        if($count == 0){ //CHECK IF DNO EXISTS
            echo "Unidentified Department Number Error!";
        } else {
            $sql = "SELECT COUNT(*) FROM EMPLOYEE WHERE SSN = '$Super_ssn'";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_fetch_array($result)[0];
            if(!empty($Super_ssn) && $count == 0){ //CHECK IF SUPERVISOR ENTERED (if Super SSN is empty still go through it will be NULL)
                echo "Manager SSN not found as EMPLOYEE";
            } else {//This is the actual insert query
                if(empty($minit)){ $minit = NULL;}
                if(empty($Bdate)){$Bdate = NULL;}
                if(empty($Address)){$Address = NULL;}
                if(empty($Sex)){$Sex = NULL;}
                if(empty($Salary)){$Salary = NULL;}
                if(empty($Super_ssn)){$Super_ssn = NULL;}
                
                //due to nulls I use this way 
                $sql = "INSERT INTO EMPLOYEE (Fname, Minit, Lname, SSN, Bdate, Address, Sex, Salary, Super_ssn, Dno) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssssdsi", $fname, $minit, $lname, $SSN, $Bdate, $Address, $Sex, $Salary, $Super_ssn, $Dno);
                $stmt->execute();
                $stmt->close();

                ?>
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Add New Employee</title>
                </head>
                <body>
                    <p2> SUCCESS! Check below of output of current employee names (SSN Not shown for safe) </p>
                </body>
                </html>
                <?php

                $sql = "SELECT * FROM EMPLOYEE"; //print out all emp
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo $row[0]." ".$row[2]. "<br>";
                }
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
