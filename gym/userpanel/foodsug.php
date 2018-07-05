<?php 
 error_reporting(1);
    session_start();

    $email = $_SESSION['username']; 

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


    $query = "SELECT * from `tbl_userreg` where `email`='$email'";

        $result=mysqli_query($db,$query);

        if(mysqli_num_rows($result) == 1){


        while ($row = $result->fetch_assoc()) {

            $weight = $row['weight'];
            $height = $row['height'];
            $age = $row['age'];
            $gender = $row['sex'];
            $activity = $row['activity'];

            if(empty($weight)){

                header("location: updateprofile.php");

            }


        }


    }


    if($gender == 'male'){

    #$bmr  = 88.362 + (13.397 * (float)$weight) + (3.098 * (float)$height) - (5.677*(int)$age);

    $bmr = 10 * $weight + 6.25 * $height - 5 * $age + 5;



    }else if($gender == 'female'){

    $bmr  = 447.593 + (9.247 * (float)$weight) + (3.098 * (float)$height) - (4.330*(int)$age);
}

$bmr = (int)$bmr;

$actVaribale = 0;

if((int)$activity == 1){

    $actVaribale = 1.2;

}else if((int)$activity == 2){

    $actVaribale = 1.375;
    
}else if((int)$activity == 3){

    $actVaribale = 1.55;
    
}else if((int)$activity == 4){

    $actVaribale = 1.725;
    
}else if((int)$activity == 5){

    $actVaribale = 1.9;
    
}


$activityFactor = $bmr * $actVaribale;
$activityFactor = (int)$activityFactor;

error_log("Activity Factor:".$activityFactor);


$er = $bmr * $activityFactor;

$er= (int)$er;

if($age >= 3){

$baseCarbo  = 45;
$baseProtein = 5;
$baseFat = 30;
    
    if($activity == 1){

    $carboper = $baseCarbo + 5;
    $proper = $baseProtein + 5;
    $fatper = $baseFat + 5;

    }else if($activity == 2){

    $carboper = $baseCarbo + 10;
    $proper = $baseProtein + 10;
    $fatper = $baseFat + 10;



    }else if($activity == 3){

    $carboper = $baseCarbo + 15;
    $proper = $baseProtein + 15;
    $fatper = $baseFat + 15;

    }else if($activity == 4){

    $carboper = $baseCarbo + 20;
    $proper = $baseProtein + 20;
    $fatper = $baseFat + 20;    

    }else if($activity == 5){

    $carboper = $baseCarbo + 25;
    $proper = $baseProtein + 25;
    $fatper = $baseFat + 25;

    }else{

}

}

if($age < 3 || $age <= 18){

$baseCarbo  = 45;
$baseProtein = 10;
$baseFat = 25;
    
    if($activity == 1){

    $carboper = $baseCarbo + 5;
    $proper = $baseProtein + 5;
    $fatper = $baseFat + 5;

    }else if($activity == 2){

    $carboper = $baseCarbo + 10;
    $proper = $baseProtein + 10;
    $fatper = $baseFat + 10;



    }else if($activity == 3){

    $carboper = $baseCarbo + 15;
    $proper = $baseProtein + 15;
    $fatper = $baseFat + 15;

    }else if($activity == 4){

    $carboper = $baseCarbo + 20;
    $proper = $baseProtein + 20;
    $fatper = $baseFat + 20;    

    }else if($activity == 5){

    $carboper = $baseCarbo + 25;
    $proper = $baseProtein + 25;
    $fatper = $baseFat + 25;

    }else{

}

}




if($age > 18){

$baseCarbo  = 45;
$baseProtein = 5;
$baseFat = 10;
    
    if($activity == 1){

    $carboper = $baseCarbo + 5;
    $proper = $baseProtein + 5;
    $fatper = $baseFat + 5;

    }else if($activity == 2){

    $carboper = $baseCarbo + 10;
    $proper = $baseProtein + 10;
    $fatper = $baseFat + 5;



    }else if($activity == 3){

    $carboper = $baseCarbo + 15;
    $proper = $baseProtein + 15;
    $fatper = $baseFat + 5;

    }else if($activity == 4){

    $carboper = $baseCarbo + 20;
    $proper = $baseProtein + 20;
    $fatper = $baseFat + 20;    

    }else if($activity == 5){

    $carboper = $baseCarbo + 25;
    $proper = $baseProtein + 25;
    $fatper = $baseFat + 25;

    }else{

}

}

$er = $activityFactor;

$cer = $er * ($carboper/100);

error_log("ER>>>>>>>>".$er);
#$cer = $er * 0.6;


$per = $er * ($proper/100);
$fer = $er * ($fatper/100);

#$cer = (int)$cer/4;
#$per = (int)$per/4;
#$fer = (int)$fer/9;

$cer = (int)$cer;
$per = (int)$per;
$fer = (int)$fer;

$energyConsume  = $fer+$per+$cer;
$energyRequired = round($fer/9)+round($per/4)+round($cer/4);


$totalR = $energyConsume + $energyRequired;

$db = dbConnection();


    $query = "SELECT * from `food` where `food_type`='veg' order by `calories` desc";

    $resultk=mysqli_query($db,$query);


    $query2 = "SELECT * from `data_set` where `total_calories` BETWEEN '$totalR'-10 AND '$totalR'+10 order by RAND() LIMIT 1";

    $result2=mysqli_query($db,$query2);

        if(mysqli_num_rows($result2)){


        while ($row = $result2->fetch_assoc()) {

            $jsonArray[]= $row;
        }


        }


      // print_r($jsonArray);



function fetch_food_details($f_id){

$db = dbConnection();

    $query = "SELECT * from `food` where `f_id`='$f_id'";

    $resultk=mysqli_query($db,$query);

    return $resultk;

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

<!--  -->
        <!--/col-->

        <div class="col-md-9 col-lg-10 main">

            <!--toggle sidebar button
            <p class="hidden-md-up">
                <button type="button" class="btn btn-primary-outline btn-sm" data-toggle="offcanvas"><i class="fa fa-chevron-left"></i> Menu</button>
            </p>-->

            <h1 class="display-4 d-none d-sm-block">
            Food Suggestions
            </h1>
            <!-- <p class="lead d-none d-sm-block">(with off-canvas sidebar, based on BS v4.0.0)</p> -->

   <!--          <div class="alert alert-warning fade collapse" role="alert" id="myAlert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Holy guacamole!</strong> It's free.. this is an example theme.
            </div> -->
            <div class="row mb-3">
                <div class="col-xl-3 col-sm-6">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body bg-success">
                            <div class="rotate">
                                <!-- <i class="fa fa-user fa-3x"></i> -->
                            </div>
                            <h6 class="text-uppercase">Weight</h6>
                            <h1 class="display-4"><?php echo $weight ?> KG</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <div class="rotate">
                                <!-- <i class="fa fa-list fa-3x"></i> -->
                            </div>
                            <h6 class="text-uppercase">Height</h6>
                            <h1 class="display-4"><?php echo $height ?> CM</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <!-- <i class="fa fa-twitter fa-3x"></i> -->
                            </div>
                            <h6 class="text-uppercase">Age</h6>
                            <h1 class="display-4"><?php echo $age ?> Year</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-white bg-warning h-100">
                        <div class="card-body bg-warning">
                            <div class="rotate">
                                <!-- <i class="fa fa-share fa-3x"></i> -->
                            </div>
                            <h6 class="text-uppercase">Gender</h6>
                            <h1 class="display-4"><?php echo $gender ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->

            <hr>
            <div class="row placeholders mb-3">
                <div class="col-6 col-sm-3 placeholder text-center">
                    <!-- <img src="//placehold.it/200/dddddd/fff?text=<?php echo $bmr ?>" class="mx-auto img-fluid rounded-circle" alt="Generic placeholder thumbnail"> -->
                    <h4>BMR</h4>
                    <span class="text-muted"><?php echo $bmr ?></span>
                    <!-- <span class="text-muted">Device agnostic</span> -->
                </div>
                <div class="col-6 col-sm-3 placeholder text-center">
                    <!-- <img src="//placehold.it/200/e4e4e4/fff?text=<?php echo $activityFactor ?>" class="mx-auto img-fluid rounded-circle" alt="Generic placeholder thumbnail"> -->
                    <h4>Activity Factor</h4>
                    <span class="text-muted"><?php echo $actVaribale ?></span>
                </div>
              <!--   <div class="col-6 col-sm-3 placeholder text-center">
                   
                    <h4>ER(Energy Required)</h4>
                    <span class="text-muted"><?php echo $activityFactor;  ?></span>
                </div> -->
               <!--  <div class="col-6 col-sm-3 placeholder text-center">
                    <img src="//placehold.it/200/e0e0e0/fff?text=4" class="center-block img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                    <h4>Framework</h4>
                    <span class="text-muted">CSS and JavaScript</span>
                </div> -->
            </div>

<div class="hide" style="display: none;">
    

<hr>
<h2>Energy Consume</h2>
            <div class="row mb-3">
                <div class="col-xl-3 col-sm-6">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body bg-success">
                            <div class="rotate">
                                <!-- <i class="fa fa-user fa-3x"></i> -->
                            </div>
                            <h6 class="text-uppercase">Carbohydrate</h6>
                            <h1 class="display-4"><?php echo $cer ?> Grams</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <div class="rotate">
                                <!-- <i class="fa fa-list fa-3x"></i> -->
                            </div>
                            <h6 class="text-uppercase">Protein</h6>
                            <h1 class="display-4"><?php echo $per ?> Grams</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <!-- <i class="fa fa-twitter fa-3x"></i> -->
                            </div>
                            <h6 class="text-uppercase">FAT</h6>
                            <h1 class="display-4"><?php echo $fer ?> Grams</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-white bg-warning h-100">
                        <div class="card-body bg-warning">
                            <div class="rotate">
                               
                            </div>
                            <h6 class="text-uppercase">Nutrition Needed</h6>
                            <h1 class="display-4"><?php echo $fer+$per+$cer; ?> Grams</h1>
                        </div>
                    </div>
                </div>
            </div>


<hr>
<h2>Energy needed</h2>
            <div class="row mb-3">
                <div class="col-xl-3 col-sm-6">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body bg-success">
                            <div class="rotate">
                                <!-- <i class="fa fa-user fa-3x"></i> -->
                            </div>
                            <h6 class="text-uppercase">Carbohydrate</h6>
                            <h1 class="display-4"><?php echo round($cer/4) ?> Grams</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <div class="rotate">
                                <!-- <i class="fa fa-list fa-3x"></i> -->
                            </div>
                            <h6 class="text-uppercase">Protein</h6>
                            <h1 class="display-4"><?php echo round($per/4) ?> Grams</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <!-- <i class="fa fa-twitter fa-3x"></i> -->
                            </div>
                            <h6 class="text-uppercase">FAT</h6>
                            <h1 class="display-4"><?php echo round($fer/9) ?> Grams</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-white bg-warning h-100">
                        <div class="card-body bg-warning">
                            <div class="rotate">
                               
                            </div>
                            <h6 class="text-uppercase">Nutrition Needed</h6>
                            <h1 class="display-4"><?php echo round($per/4)+round($fer/9)+round($cer/4) ?> Grams</h1>
                        </div>
                    </div>
                </div>
            </div>




</div>









            <a id="features"></a>
            <hr>
            <p class="lead mt-5">
                Total Required Energy : <?php echo $totalR; ?>
            </p>
            <div class="row my-4">

                <div class="col-lg-12 col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th>foooditem</th>
                                    <th>protein</th>
                                    <th>fat</th>
                                    <th>carbohydrates</th>
                                    <th>calories</th>
                                </tr>
                            </thead>
                            <tbody>

<?php
$cn = 1;
for($i = 1; $i <= 12; $i++){




$ik = (string)$i;
$f_id = (int)$jsonArray[0]['f'.$ik];
$resultk = fetch_food_details($f_id);
if(mysqli_num_rows($resultk)){

    

        
        while ($row = $resultk->fetch_assoc()) {


            if(1==1)

            {


            echo '<tr>';

            echo '<td>'.$cn.'</td>';

            echo '<td>'.$row['foooditem'].'</td>';
            echo '<td>'.$row['protein'].'</td>';
            echo '<td>'.$row['fat'].'</td>';
            echo '<td>'.$row['carbohydrates'].'</td>';
            echo '<td>'.$row['calories'].'</td>';
            echo '</tr>';
            $cn++;

          }



        }

        


    }

}
            echo '<tr></tr>';
            echo '<tr>';

            echo '<td>'.$cn.'</td>';

            echo '<td>'.'<B>TOTAL</B>'.'</td>';
            echo '<td>'.$jsonArray[0]['total_protein'].'</td>';
            echo '<td>'.$jsonArray[0]['total_fat'].'</td>';
            echo '<td>'.$jsonArray[0]['total_carbohydrates'].'</td>';
            echo '<td>'.$jsonArray[0]['total_calories'].'</td>';
            echo '</tr>';

?>

                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>








            <!--/row-->

            <a id="more"></a>
            <hr>


  



        </div>
        <!--/main col-->
    </div>

</div>
<!--/.container-->
<footer class="container-fluid">
    <p class="text-right small">©2018 Company</p>
</footer>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <p>This is a dashboard layout for Bootstrap 4. This is an example of the Modal component which you can use to show content.
                Any content can be placed inside the modal and it can use the Bootstrap grid classes.</p> -->
                <p>
                    <a href="index.php?logout='1'" style="color: red;">Logout</a>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary-outline" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
    <!--scripts loaded here-->
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <script src="js/scripts.js"></script>
  </body>
</html>