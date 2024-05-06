<html>
<head>
    <title>Company Database Management Function</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            margin-bottom: 20px;
            color: #666;
	    text-align: center;
        }
        form {
            text-align: center;
        }
        label {
            font-size: 18px;
            color: #333;
        }
        select {
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Company Database Management Function Board</h1>
        <p>Select the function to apply to SQL database</p>
        
        <!-- Form to select a function -->
        <form action="companyfunctions.php" method="post">
            <label for="function">Choose an option:</label><br>
            <select name="function" id="function">
                <option value="a">Add A New Employee</option>
                <option value="b">Add A New Department</option>
                <option value="c">Add New Working Project For An Employee</option>
                <option value="d">Remove An Employee</option>
            </select><br><br>
            <input type="submit" value="Choose">
        </form>
    </div>
</body>
</html>