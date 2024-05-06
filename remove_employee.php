<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "ip2"; //CHANGE DATABASE!

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = '';
$flag = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //print_r($_POST);
    $SSN = $_POST['SSN'];

    //Info checks
    //First check if SSN exists
    $sql = "SELECT COUNT(*) FROM EMPLOYEE WHERE SSN = '$SSN'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];
    if ($count == 0) { //CHECK IF SSN ALREADY EXISTS
        echo "This SSN does not correspond to any employee there is nothing to remove!";
    } else {
        $sql = "SELECT COUNT(*) FROM DEPARTMENT WHERE Mgr_ssn = '$SSN'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_fetch_array($result)[0];
        if($count != 0){ //is manager
            $sql = "SELECT Dnumber FROM DEPARTMENT WHERE Mgr_ssn = '$SSN'"; //get dept number this mgr manages
            $result = mysqli_query($conn, $sql);
            $Dnumber = mysqli_fetch_array($result)[0];
            $sql = "SELECT COUNT(*) FROM EMPLOYEE WHERE Dno = '$Dnumber'";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_fetch_array($result)[0];
            if($count > 1){//1 since mgr is there so sum minimum will always be 1
                echo "Person with SSN: $SSN NOT deleted because he/she is manager and people still wonder under the department he/she manage.";
                echo "<br>";
            } else {//Nobody working under this mgr so delete from employee, delete from work on, delete department that they manage
                $sql = "DELETE FROM EMPLOYEE WHERE SSN = '$SSN'";
                $result = mysqli_query($conn, $sql);
                $sql = "DELETE FROM Works_on WHERE Essn = '$SSN'";
                $result = mysqli_query($conn, $sql);
                $sql = "DELETE FROM Department WHERE Mgr_ssn = '$SSN'";
                $result = mysqli_query($conn, $sql);
                $sql = "DELETE FROM dept_locations WHERE Dnumber = '$Dnumber'";
                $result = mysqli_query($conn, $sql);
                $sql = "DELETE FROM PROJECT WHERE Dnum = '$Dnumber'";
                $result = mysqli_query($conn, $sql);
            }
        } else { //is not manager
            $sql = "DELETE FROM EMPLOYEE WHERE SSN = '$SSN'";
            $result = mysqli_query($conn, $sql);
            $sql = "DELETE FROM Works_on WHERE Essn = '$SSN'";
            $result = mysqli_query($conn, $sql);
        }

        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Add New Employee</title>
        </head>
        <body>
            <p2>Possible changes made to employees list. Please confirm below. If manager was deleted then department and all traces of department are deleted. Also possible no change made, read above message if there is.</p>
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Employee</title>
</head>
<body>
    <p><a href="IP2.php">Go back to Database Management Function Board</a></p>
</body>
</html>
