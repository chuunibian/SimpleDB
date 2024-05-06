<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "ip2"; //CHANGE DATABASE!

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //print_r($_POST);
    $SSN = $_POST['SSN'];
    $Pnumber = $_POST['Pnumber'];
    $Hours = $_POST['hours'];

    $sql = "SELECT COUNT(*) FROM WORKS_ON WHERE Pno = '$Pnumber' AND Essn = '$SSN'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];
    if($count > 0){ //test if worker with this ssn is already working on this Porject number
        echo "This worker is already working on the project number!";
    } else {
    $sql = "INSERT INTO WORKS_ON (Essn, Pno, Hours) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sid",$SSN, $Pnumber, $Hours);
    $stmt->execute();
    $stmt->close();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Add New Employee</title>
    </head>
    <body>
        <p2> SUCCESS! Check below of output of current SSN, Project Number, and Hour </p>
    </body>
    </html>
    <?php
    $sql = "SELECT * FROM WORKS_ON"; //print out all emp
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo $row[0]."  ".$row[1]."  ".$row[2]. "<br>";
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