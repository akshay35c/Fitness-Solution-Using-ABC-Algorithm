<?php 
error_reporting(0);
    session_start(); 

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }

?>

<?php

include 'dbconnect.php';
$db = dbConnection();

    if (isset($_POST['updateprofile'])) {
        // receive all input values from the form
        $weight = mysqli_real_escape_string($db, $_POST['weight']);
        $height = mysqli_real_escape_string($db, $_POST['height']);
        // $username = mysqli_real_escape_string($db, $_POST['username']);

        $age = mysqli_real_escape_string($db, $_POST['age']);
        $gender = mysqli_real_escape_string($db, $_POST['gender']);

        $activity = mysqli_real_escape_string($db, $_POST['activity']);
      

        // form validation: ensure that the form is correctly filled
        if (empty($weight)) { array_push($errors, "weight is required"); }
        if (empty($height)) { array_push($errors, "height is required"); }
        if (empty($age)) { array_push($errors, "age is required"); }
        if (empty($gender)) { array_push($errors, "gender is required"); }

        if ($gender == "select") {
            array_push($errors, "Please select valid gender!");
        }

        if ($activity == "select") {
            array_push($errors, "Please select valid activity factor!");
        }    

        // register user if there are no errors in the form
        if (count($errors) == 0) {
            // $password = md5($password_1);//encrypt the password before saving in the database
            session_start();
            $email = $_SESSION['username'];
            $query = "UPDATE `tbl_userreg` SET `age`='$age',`sex`='$gender',`height`='$height',`weight`='$weight', `activity`= '$activity' WHERE `email`='$email'";

                if($db->query($query) === TRUE){

                    // $_SESSION['username'] = $email;
                    // $_SESSION['success'] = "You are now logged in";
                    header('location: index.php');

                }else{

                error_log("ERROR!");
                error_log("Error description: " . mysqli_error($db));
                
                }


        }

    }


?>

<?php

           session_start();

if(isset($_SESSION['weight']) && !empty($_SESSION['weight'])) {
    
            $weight =  $_SESSION["weight"];
            $height = $_SESSION["height"];
            $age = $_SESSION["age"];
            $sex = $_SESSION["sex"];
            $activity = $_SESSION["activity"];

}

            

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Userpanel</title>
    <meta name="description" content="A Bootstrap 4 admin dashboard theme that will get you started. The sidebar toggles off-canvas on smaller screens. This example also include large stat blocks, modal and cards. The top navbar is controlled by a separate hamburger toggle button." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Codeply">



    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body >
    <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-primary mb-3">
    <div class="flex-row d-flex">
        <a class="navbar-brand" href="#" title="Free Bootstrap 4 Admin Template">Userpanel</a>
        <button type="button" class="navbar-toggler" data-toggle="offcanvas" title="Toggle responsive left sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="collapsingNavbar">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">Home</span></a>
            </li>
           <!--  <li class="nav-item">
                <a class="nav-link" href="//www.codeply.com">Codeply</a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="#myAlert" data-toggle="collapse">Alert</a>
            </li> -->
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="" data-target="#myModal" data-toggle="modal"><?php echo $_SESSION['username']; ?></a>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left">
    <?php include 'sidebar.php' ?>
        <!--/col-->

        <div class="col-md-9 col-lg-10 main">

            <!--toggle sidebar button
            <p class="hidden-md-up">
                <button type="button" class="btn btn-primary-outline btn-sm" data-toggle="offcanvas"><i class="fa fa-chevron-left"></i> Menu</button>
            </p>-->

            <h1 class="display-4 d-none d-sm-block">
           Update Your Profile
            </h1>
            <hr>

<div class="col-md-7">
        <form method="post" name="updateprofile" action="" >

<?php include('errors.php'); ?>

  <div class="form-group">
    <label for="exampleInputEmail1">Age</label>
    <input type="text" name="age" id="age" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Age">
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Weight</label>
    <input type="text" name="weight" class="form-control" id="weight" placeholder="Enter weight in kilogram">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">height</label>
    <input type="text" name="height" class="form-control" id="height" placeholder="Enter height in centimeter">
  </div>

  <div class="form-group">
    <br>
    <label for="exampleInputPassword1">Gender</label>&nbsp;
    <select name="gender" id="gender">
    <option value="select">Select</option>
  <option value="male">Male</option>
  <option value="female">Female</option>

</select>
  </div>

  <div class="form-group">
    <br>
    <label for="exampleInputPassword1">Activity Level</label>&nbsp;
    <select name="activity" id="activity">
    <option value="select">Select</option>
  <option value="1">Litile or No Exercise</option>
  <option value="2">Light Exercise</option>
  <option value="3">Moderate Exercise</option>
  <option value="4">Heavy Exercise</option>
  <option value="5">Very Heavy Exercise</option>

</select>
  </div>

<!--   <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <hr>
  <button type="submit" name="updateprofile" class="btn btn-primary">Submit</button>
</form>

</div>




            <a id="features"></a>






        </div>
        <!--/main col-->
    </div>

</div>



<!-- Modal -->
<?php include 'model.php' ?>
    <!--scripts loaded here-->
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
        
        $('#age').val("<?php echo $age; ?>");
        $('#weight').val("<?php echo $weight; ?>");
        $('#height').val("<?php echo $height; ?>");

        $("#gender").val("<?php echo $sex; ?>").change();
        $("#activity").val("<?php echo $activity; ?>").change();



    </script>
  </body>
</html>