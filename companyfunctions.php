<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "IP2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_function = $_POST['function'];
    switch ($selected_function) {
        case 'a': //////////////////////////////////////////////////////////////////////////////////////////////////////////
            // Display the form for adding a new employee
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Add New Employee</title>
                <style>
                .sql-results {
                    float: Middle;
                    margin-top: 15px; /* Adjust as needed */
                    padding: 10px;
                    background-color: #f5f5f5;
                    border: 5px solid #ccc;
                }
                .submit-button {
                    padding: 10px 20px;
                    font-size: 16px;
                    background-color: #28a745; /* Green color */
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }
                .submit-button:hover {
                    background-color: #218838; /* Darker shade of green on hover */
                }
                </style>
            </head>
            <body>
                <h2>Add New Employee</h2>
                <p>* denotes required fields</p>
                <form action="add_employee.php" method="post">
                    <label for="fname">*First Name:</label>
                    <input type="text" id="fname" name="fname"><br><br>

                    <label for="Minit">Middle Initial:</label>
                    <input type="text" id="Minit" name="Minit"><br><br>

                    <label for="lname">*Last Name:</label>
                    <input type="text" id="lname" name="lname"><br><br>

                    <label for="SSN">*SSN (No Dash):</label>
                    <input type="text" id="SSN" name="SSN"><br><br>

                    <label for="Bdate">Birth Date (!MUST FOLLOW! YYYY-MM-DD):</label>
                    <input type="text" id="Bdate" name="Bdate"><br><br>

                    <label for="Address">Address (Number Street, City, State Abbreviation):</label>
                    <input type="text" id="Address" name="Address"><br><br>
                    
                    <label for="Sex">Sex (M/F):</label>
                    <input type="text" id="Sex" name="Sex"><br><br>

                    <label for="Salary">Salary (!MUST FOLLOW! XXXX.XX):</label>
                    <input type="text" id="Salary" name="Salary"><br><br>

                    <label for="Super_ssn">Super_ssn (Must already be employee):</label>
                    <input type="text" id="Super_ssn" name="Super_ssn"><br><br>

                    <label for="Dno">*Department Number (Dnum must already exit):</label>
                    <select name="Dno" id="Dno">
                    <?php
                    $sql = "SELECT * FROM DEPARTMENT";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $ProjName = $row['Dname'];
                    $Pnumber = $row['Dnumber'];
                    echo "<option value='$Pnumber'>$ProjName    $Pnumber</option>";
                    }
            ?>
            </select>
            <br>
            <br>
                    <input type="submit" value="Submit" class="submit-button">
                </form>
            </body>
            </html>
            <?php
            break;
        case 'b': //////////////////////////////////////////////////////////////////////////////////////////////////////////
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Add New Department</title>
                <style>
                .sql-results {
                    float: Middle;
                    margin-top: 15px; /* Adjust as needed */
                    padding: 10px;
                    background-color: #f5f5f5;
                    border: 5px solid #ccc;
                }
                .submit-button {
                    padding: 10px 20px;
                    font-size: 16px;
                    background-color: #28a745; /* Green color */
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }
                .submit-button:hover {
                    background-color: #218838; /* Darker shade of green on hover */
                }
                </style>
            </head>
            <body>
                <h2>Add New Department</h2>
                <p> Location will always be set to "COLUMBUS"</p>
                <p>* denotes required fields</p>
                <form action="add_department.php" method="post">
                    <label for="Dnumber">*Enter Department Number (Number must not already be assigned):</label>
                    <input type="text" id="Dnumber" name="Dnumber"><br><br>
                    <label for="Dname">*Enter Department Name (Preferably a name that is not already used):</label>
                    <input type="text" id="Dname" name="Dname"><br><br>
                    <label for="Mgr_ssn">*Manager SSN (Must be a SSN of an existing employee):</label>
                    <input type="text" id="Mgr_ssn" name="Mgr_ssn"><br><br>
                    <label for="Mgr_start_date">Manager start date(!MUST FOLLOW! YYYY-MM-DD):</label>
                    <input type="text" id="Mgr_start_date" name="Mgr_start_date"><br><br>
                    <input type="submit" value="Submit" class="submit-button">
                </form>
                <h3> Current Department Numbers</h3>
                <div class="sql-results">
                    <?php
                        $sql = "SELECT * FROM DEPARTMENT";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo $row[0]." ".$row[1]. "<br>";
                        }
                    ?>
                    </div>
            </body>
            </html>
            <?php
            break;
        case 'c': //////////////////////////////////////////////////////////////////////////////////////////////////////////
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Add New Works_On</title>
                <style>
                .sql-results {
                    float: Middle;
                    margin-top: 15px; /* Adjust as needed */
                    padding: 10px;
                    background-color: #f5f5f5;
                    border: 5px solid #ccc;
                }
                .submit-button {
                    padding: 10px 20px;
                    font-size: 16px;
                    background-color: #28a745; /* Green color */
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }
                .submit-button:hover {
                    background-color: #218838; /* Darker shade of green on hover */
                }
                </style>
            </head>
            <body>
                <h2>Add New Works On</h2>
                <p>* denotes required fields</p>
                <form action="add_workson.php" method="post">
                    <label for="SSN">*Enter SSN of Employee you want to make a works on: (SSN Must exist):</label>
                    <input type="text" id="SSN" name="SSN"><br><br>
                    <input type="submit" value="Submit" class="submit-button">
                </form>
            </body>
            </html>
            <?php
            break;
        case 'd': //////////////////////////////////////////////////////////////////////////////////////////////////////////
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Remove Employee</title>
                <style>
                .sql-results {
                    float: Middle;
                    margin-top: 15px; /* Adjust as needed */
                    padding: 10px;
                    background-color: #f5f5f5;
                    border: 5px solid #ccc;
                }
                .submit-button {
                    padding: 10px 20px;
                    font-size: 16px;
                    background-color: #28a745; /* Green color */
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }
                .submit-button:hover {
                    background-color: #218838; /* Darker shade of green on hover */
                }
                </style>
            </head>
            <body>
                <h2>Remove Employee</h2>
                <p>* denotes required fields</p>
                <form action="remove_employee.php" method="post">
                    <label for="SSN">*Enter SSN of Employee you want to remove: (SSN Must exist, If SSN is manager he/she will only be removed if nobody works in department managed):</label>
                    <input type="text" id="SSN" name="SSN"><br><br>
                    <input type="submit" value="Submit" class="submit-button">
                </form>
            </body>
            </html>
            <?php
            break;
        default:
            echo "Invalid function option selected";
            break;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Company Database Management Function</title>
    <style>
    .go-back-link {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .go-back-link:hover {
        background-color: #0056b3;
    }
    </style>
</head>
<body>
    <p><a href="IP2.php" class="go-back-link">Go back to Database Management Function Board</a></p>
</body>
</html>
