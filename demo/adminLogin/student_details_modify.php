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
	background: #e7f2fd;
}

 p {
  font-size: 20px;
  font-weight: 500;
  color: var(--color-black);
  display: inline-block;
  margin: 20px;
  white-space: nowrap;
}

	
 h1 {
            text-align: center;
			margin-top:100px;
            margin-bottom: 10px;
			font-size: 20Px;
            color: var(--color-black);
            text-align: center;
			font-weight:bold;

        }
 form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			margin-top:20px;
			
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
			margin-top:25px;
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
            margin-bottom: 10px;
			font-size: 20Px;
            color: var(--color-black);
            text-align: center;
			font-weight:bold;

        }
		 h3 {
            text-align: center;
			margin-top:10px;
            margin-bottom: 10px;
			font-size: 20Px;
            color: var(--color-black);
            text-align: center;
			font-weight:bold;

        }
	  </style>
  </head>
  <body>
 <!--side bar Start-->

    
		<!--navbar end--> 
		<!--content part start -->
     <h1>EDIT STUDENT DETAILS</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="student_id">Enter Student ID:</label>
        <input type="text" name="student_id" required>
        <br>

        <button  class="button-5" role="button" type="submit">Search</button>
    </form>

    <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Include your database connection file
            include 'db_connection.php';

            // Get the input value
            $studentId = $_POST["student_id"];

            // Retrieve student details from the database
            $query = "SELECT * FROM USER_DETAILS WHERE USER_ID = '$studentId'";
            $result = mysqli_query($connection, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
    ?>
                <!-- Display the student details with edit form -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="student_id" value="<?php echo $row['USER_ID']; ?>">
                    <label for="student_name">Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="student_name" value="<?php echo $row['USER_NAME']; ?>" required>
                    <br>

                    <label for="student_gender">Gender:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="student_gender" value="<?php echo $row['USER_GENDER']; ?>" required>
                    <br>

                    <label for="student_phone">Phone Number:&nbsp;</label>
                    <input type="text" name="student_phone" value="<?php echo $row['USER_PH']; ?>" required>
                    <br>

                    <button class="button-5" role="button" type="submit" name="edit_submit">Update</button>
                </form>
    <?php
            } else {
                echo "<p>Student with ID $studentId not found.</p>";
            }

            // Close the database connection
            mysqli_close($connection);
        }
    ?>

    <?php
        // Check if the edit form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_submit"])) {
            // Include your database connection file
            include 'db_connection.php';

            // Get the input values
            $editedId = $_POST["student_id"];
            $editedName = $_POST["student_name"];
            $editedGender = $_POST["student_gender"];
            $editedPhone = $_POST["student_phone"];

            // Update student details in the database
            $updateQuery = "UPDATE USER_DETAILS SET USER_NAME='$editedName', USER_GENDER='$editedGender', USER_PH='$editedPhone' WHERE USER_ID='$editedId'";
            $updateResult = mysqli_query($connection, $updateQuery);

            if ($updateResult) {
                echo "<p>Student details updated successfully.</p>";
            } else {
                echo "<p>Error updating student details: " . mysqli_error($connection) . "</p>";
            }

            // Close the database connection
            mysqli_close($connection);
        }
    ?>
	</section>

	<!--content part end -->

    <script>
	var userName = localStorage.getItem("userName");
        if (userName) {
            // Update the content of the "user" element
            document.getElementById("user").innerHTML = "WELCOME, " + userName;
        }
      const btn_menu = document.querySelector(".btn-menu");
      const side_bar = document.querySelector(".sidebar");

      btn_menu.addEventListener("click", function () {
        side_bar.classList.toggle("expand");
        changebtn();
      });

      function changebtn() {
        if (side_bar.classList.contains("expand")) {
          btn_menu.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
          btn_menu.classList.replace("bx-menu-alt-right", "bx-menu");
        }
      }

      const btn_theme = document.querySelector(".theme-btn");
      const theme_ball = document.querySelector(".theme-ball");

      const localData = localStorage.getItem("theme");

      if (localData == null) {
        localStorage.setItem("theme", "light");
      }

      if (localData == "dark") {
        document.body.classList.add("dark-mode");
        theme_ball.classList.add("dark");
      } else if (localData == "light") {
        document.body.classList.remove("dark-mode");
        theme_ball.classList.remove("dark");
      }

      btn_theme.addEventListener("click", function () {
        document.body.classList.toggle("dark-mode");
        theme_ball.classList.toggle("dark");
        if (document.body.classList.contains("dark-mode")) {
          localStorage.setItem("theme", "dark");
        } else {
          localStorage.setItem("theme", "light");
        }
      });
    </script>
  </body>
</html>