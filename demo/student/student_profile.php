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
	   body {
      font-family: Arial, sans-serif;
 
	overflow:hidden;
	 background-color: #e7f2fd;
      text-align: center;
    }
        .card {
            width: 400px;
            margin: 20px auto;
			margin-top:0px;
			
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.5s ease;
			display:block;
        }

        h2 {
            
            font-size: 24px;
           color: var(--color-black);
			margin-top:100px;
			font-weight: bold;
        }

        label {
            font-weight: bold;
			text-align:center;
			margin-top:20px;
        }
	  </style>
  </head>
  
  <body>
 <!--side bar Start-->

   
    <h2>Student Details</h2>

    <div class="card">
        <?php
        // Start the session
        session_start();

        // Check if the user is logged in
        if (!isset($_SESSION["user_id"])) {
            // Redirect or handle the case when the user is not logged in
            // For example, you can redirect them to a login page
            header("Location: login.php");
            exit();
        }

        // Assuming you have already started the session and have $student_id in the session variable
        $student_id = $_SESSION["user_id"];

        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "STUDENT_MARKS_MANAGEMENT";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute SQL query to fetch student details
        $sql = "SELECT * FROM USER_DETAILS WHERE USER_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();

        // Get result set
        $result = $stmt->get_result();

        // Check if any result is returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Display the student details
                echo "<label>Student ID:</label> " . $row["USER_ID"] . "<br>";
                echo "<label>Student Name:</label> " . $row["USER_NAME"] . "<br>";
                echo "<label>Gender:</label> " . $row["USER_GENDER"] . "<br>";
                echo "<label>Date of Birth:</label> " . substr($row["USER_DOB"], 0, 2) . '/' . substr($row["USER_DOB"], 2, 2) . '/' . substr($row["USER_DOB"], 4, 4) . "<br>";
                echo "<label>Phone Number:</label> " . $row["USER_PH"] . "<br><br>";

                // Edit link
                
            }
        } else {
            echo "0 results";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </section>

	   
	  
	<!--content part end -->
	

    
    </script>
  </body>
</html>