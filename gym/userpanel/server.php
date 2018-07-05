<?php 

include 'dbconnect.php';

	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	//$db = mysqli_connect('localhost', 'root', '', 'gym');
	$db = dbConnection();

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$fname = mysqli_real_escape_string($db, $_POST['fname']);
		$lname = mysqli_real_escape_string($db, $_POST['lname']);
		// $username = mysqli_real_escape_string($db, $_POST['username']);

		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($fname)) { array_push($errors, "FirstName is required"); }
		if (empty($lname)) { array_push($errors, "LastName is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			// $password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO tbl_userreg (`firstname`,`lastname`, `email`, `password`) 
					  VALUES('$fname','$lname', '$email', '$password_1')";

		        if($db->query($query) === TRUE){

					$_SESSION['username'] = $email;
					$_SESSION['success'] = "You are now logged in";
					header('location: index.php');

		        }else{

			    error_log("unable to save at register table");
	            error_log("Error description: " . mysqli_error($db));
	            
		        }


		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Email is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			// $password = md5($password);
			$query = "SELECT * FROM tbl_userreg WHERE email='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			$ar = mysqli_fetch_array($results);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['userid'] = $ar['userid'];
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong email/password combination");
			}
		}
	}

?>