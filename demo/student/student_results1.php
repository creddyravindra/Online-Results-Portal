<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <!-- Linking Google font link for icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet" />
	  <style>
	  body{
	overflow:hidden;
	 background-color: #e7f2fd;
}
form {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			margin-top:10px;
			height:120px;
        }

        label {
            font-weight: bold;
        }

        input[type="file"] {
            margin-bottom: 20px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
			margin-top:5px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
		
    input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
			width:90px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
			
        }
		.btn {
		width:90px;
		}
		h2 {
            text-align: center;
			margin-top:80px;
           
			font-size: 20Px;
            
            text-align: center;
			font-weight:bold;

        }
		
		h3{
			margin-top: 20px;
			text-align:center;
			font-size:15px;
			font-weight:bold;
			color: var(--color-black);
		}
		h4{
			margin-top:10px;
			text-align:center;
			font-size:15px;
			font-weight:bold;
color: var(--color-black);			
		
       
        }
		table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
			margin-left:280px;
			color: var(--color-black);
			border:#000;
			height:20px;
			
        }
        th, td {
            padding: 8px;
            border: 1px solid #000;
            text-align: center;
			color: var(--color-black);
        }
        



        
	  </style>
	  
  </head>
  
  <body>
 <!--side bar Start-->

    
		<!--navbar end--> 
		<!--content part start -->
     <h2>Student Marks</h2>

    <form action="" method="post">
        <label for="sem_id">Select Semester:</label>
        <select id="sem_id" name="sem_id" required>
            <option value="1">Semester 1</option>
            <option value="2">Semester 2</option>
            <option value="3">Semester 3</option>
            <option value="4">Semester 4</option>
            <option value="5">Semester 5</option>
            <option value="6">Semester 6</option>
            <option value="7">Semester 7</option>
            <option value="8">Semester 8</option>
        </select>
        <br>
        <button type="submit" name="displayMarks">Display Marks</button>
    </form>

     <?php
    // Start the session
    session_start();

    // Include the PHP code here
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["displayMarks"])) {
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "STUDENT_MARKS_MANAGEMENT";

        // Create connection
        $connection = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Get input values from the form
        $student_id = $_SESSION["user_id"]; // Retrieve user ID from session
        $sem_id = $_POST["sem_id"];

        // Your SQL query
        $sql = "SELECT ST.SUBJECT_CODE, ST.SUBJECT_NAME, SM.INTERNAL_MARKS, SM.EXTERNAL_MARKS, ST.SUBJECT_CREDITS
                FROM USER_DETAILS SD
                INNER JOIN STUDENT_MARKS SM ON SD.USER_ID = SM.USER_ID
                INNER JOIN SUBJECT_TABLE ST ON SM.SUBJECT_NO = ST.SUBJECT_NO
                WHERE SD.USER_ID = '$student_id' AND SM.SEM_ID = $sem_id";
        
        // Execute the query
        $result = $connection->query($sql);

        // $student_name = $connection->query("SELECT SD.STUDENT_NAME FROM STUDENT_DETAILS SD WHERE SD.STUDENT_ID = '$student_id'");
        $nameResult = $connection->query("SELECT SD.USER_NAME FROM USER_DETAILS SD WHERE SD.USER_ID = '$student_id'");


        if ($nameResult) {
            // Fetch the result row
            $nameRow = $nameResult->fetch_assoc();
        
            // Display the student name
            $student_name = $nameRow['USER_NAME'];
        } else {
            // Handle the error if query fails
            echo "Error fetching student name: " . $connection->error;
        }

        // Check if there are any results
        if ($result) {
            // Display the results in a table
            echo "<h3>Student ID: $student_id  &nbsp&nbsp Student Name: $student_name</h3>";
            echo "<h3>Sem ID: $sem_id</h3>";
            
            echo "<table border='1'>
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Internal Marks</th>
                        <th>External Marks</th>
                        <th>Total Marks</th>
                        <th>Grade</th>
                        <th>Grade Points</th>
                        <th>Subject Credits</th>
                    </tr>";
        
            $totalCredits = 0;
            $weightedSum = 0;
			$total=0;
			$sgpa=0;
			
        
            while ($row = $result->fetch_assoc()) {
                // Calculate total marks
                $external = $row['EXTERNAL_MARKS'];
                if ($external == '-' || $external == 'MB' || $external == 'AB'){
                    $external = 0;
					
					
                }
                $totalMarks = $row['INTERNAL_MARKS'] + $external;
				$total=$total+$totalMarks;
        
                // Assign a grade based on the total marks
                if ($totalMarks >= 90) {
                    $grade = 'S';
                    $gradePoints = 10;
                } elseif ($totalMarks >= 80) {
                    $grade = 'A';
                    $gradePoints = 9;
                } elseif ($totalMarks >= 70) {
                    $grade = 'B';
                    $gradePoints = 8;
                } elseif ($totalMarks >= 60) {
                    $grade = 'C';
                    $gradePoints = 7;
                } elseif ($totalMarks >= 50) {
                    $grade = 'D';
                    $gradePoints = 6;
                } elseif ($totalMarks >= 40) {
                    $grade = 'E';
                    $gradePoints = 5;
                } else {
                    $grade = 'F';
                    $gradePoints = 0;
                }

                
        
                if ($row['EXTERNAL_MARKS'] == '-') {
                    $grade = 'P';
                }

                // Calculate subject points
                $subjectPoints = $gradePoints * $row['SUBJECT_CREDITS'];
        
                // Accumulate weighted sum and total credits
                $weightedSum += $subjectPoints;
                $totalCredits += $row['SUBJECT_CREDITS'];
        
                echo "<tr>
                        <td>{$row['SUBJECT_CODE']}</td>
                        <td>{$row['SUBJECT_NAME']}</td>
                        <td>{$row['INTERNAL_MARKS']}</td>
                        <td>{$row['EXTERNAL_MARKS']}</td>
                        <td>$totalMarks</td>
                        <td>$grade</td>
                        <td>$gradePoints</td>
                        <td>{$row['SUBJECT_CREDITS']}</td>
                    </tr>";
            }
        
            // Calculate SGPA
            if ($totalCredits > 0) {
                $sgpa = number_format($weightedSum / $totalCredits,2);
				
               
            }
        
            echo "</table>";
			 echo "<h4>Total Marks: $total</h4>";
		 echo "<h4>SGPA: $sgpa</h4>";
        } else {
            echo "Error executing the query: " . $connection->error;
        }
		 
		 

        // Close the database connection
        $connection->close();
    }
    ?>
	
    

	   
	  
	<!--content part end -->

   
  </body>
</html>