<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <!-- Linking Google font link for icons -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: Arial, sans-serif;
 
	overflow:hidden;
	 background-color: #e7f2fd;
      text-align: center;
    }

    

    h1 {

      font-size: 30px;
      color: var(--color-black);
      margin-top: 200px;
      font-weight: bold;
	  margin-left:200px;
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
		  h2 {

      font-size: 20px;
      color: var(--color-black);
      margin-top: 100px;
      font-weight: bold;
	  margin-left:200px;
    }
        
  </style>
</head>

<body>
  <!--side bar Start-->

  


    <?php

    session_start();

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "STUDENT_MARKS_MANAGEMENT";

    // Establishing a connection to the database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
      die ("Connection failed: " . $conn->connect_error);
    }

    // Function to retrieve failed subjects for a given user ID
    function getFailedSubjects($conn, $userID)
    {
      // SQL query to retrieve failed subjects with subject code and semester information
      $sql = "SELECT SUBJECT_TABLE.SUBJECT_CODE, SUBJECT_TABLE.SUBJECT_NAME, STUDENT_MARKS.SEM_ID
            FROM STUDENT_MARKS
            INNER JOIN SUBJECT_TABLE ON STUDENT_MARKS.SUBJECT_NO = SUBJECT_TABLE.SUBJECT_NO
            WHERE USER_ID = '$userID'
            AND (CAST(STUDENT_MARKS.INTERNAL_MARKS AS INT) + CAST(STUDENT_MARKS.EXTERNAL_MARKS AS INT)) < 40
            AND STUDENT_MARKS.EXTERNAL_MARKS != '-'"; // Exclude rows with EXTERNAL_MARKS as '-'
    
      // Execute the query
      $result = $conn->query($sql);

      // Check if there are failed subjects
      if ($result->num_rows > 0) {
        echo "<h2>Failed Subjects:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Subject Code</th><th>Subject Name</th><th>Semester</th></tr>";
        // Output each failed subject with subject code, name, and semester in a table row
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["SUBJECT_CODE"] . "</td><td>" . $row["SUBJECT_NAME"] . "</td><td>" . $row["SEM_ID"] . "</td></tr>";
        }
        echo "</table>";
      } else {
        echo "<h1>No failed subjects found for this student.</h1>";
      }
    }

    // Assuming you have a session variable for user ID
// Replace 'your_user_id' with the actual user ID from your session
    $userID = $_SESSION['user_id'];

    // Call the function to get failed subjects
    getFailedSubjects($conn, $userID);

    // Close the database connection
    $conn->close();

    ?>




    <!--content part end -->


    
</body>

</html>