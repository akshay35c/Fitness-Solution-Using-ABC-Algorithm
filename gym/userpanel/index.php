<?php 
error_reporting(0);
    session_start();

    $email = $_SESSION['username']; 

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        
        unset($_SESSION['username']);
        unset($_SESSION['age']);
        unset($_SESSION['sex']);
        session_destroy();
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

            if(!empty($weight)){

            session_start();

            $_SESSION["weight"] = $weight;
            $_SESSION["height"] = $height;
            $_SESSION["age"] = $age;
            $_SESSION["sex"] = $gender;
            $_SESSION["activity"] = $activity;
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
            welcome to fitness club
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
                        <div class="card-body bg-light" style="color: black;">
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
                        <div class="card-body bg-light" style="color: black;">
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
                        <div class="card-body bg-light" style="color: black;">
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
                        <div class="card-body bg-light" style="color: black;">
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
               <!--  <div class="col-6 col-sm-3 placeholder text-center">
                  
                    <h4>ER(Energy Required)</h4>
                    <span class="text-muted"><?php echo $activityFactor;  ?></span>
                </div> -->
               <!--  <div class="col-6 col-sm-3 placeholder text-center">
                    <img src="//placehold.it/200/e0e0e0/fff?text=4" class="center-block img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                    <h4>Framework</h4>
                    <span class="text-muted">CSS and JavaScript</span>
                </div> -->
            </div>


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
                            <h6 class="text-uppercase">Nutrition</h6>
                            <h1 class="display-4"><?php echo $fer+$per+$cer; ?> Grams</h1>
                        </div>
                    </div>
                </div>
            </div>


<hr>
<h2>Extra Energy needed</h2>
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



<!--             <a id="features"></a>
            <hr>
            <p class="lead mt-5">
                Are you ready for Bootstap 4? It's the 4th generation of this popular responsive framework. Bootstrap 4 will include some interesting 
                new features such as flexbox, 5 grid sizes (now including xl), cards, `em` sizing, CSS normalization (reboot) and larger font
                sizes.
            </p> -->
           <!--  <div class="row my-4">
                <div class="col-lg-3 col-md-4">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="//placehold.it/740x180/bbb/fff?text=..." alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">Layouts</h4>
                            <p class="card-text">Flexbox provides simpler, more flexible layout options like vertical centering.</p>
                            <a href="#" class="btn btn-primary">Button</a>
                        </div>
                    </div>
                    <div class="card card-inverse bg-inverse mt-3">
                        <div class="card-body">
                            <h3 class="card-title">Flexbox</h3>
                            <p class="card-text">Flexbox is now the default, and Bootstrap 4 supports SASS out of the box.</p>
                            <a href="#" class="btn btn-outline-secondary">Outline</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th>Label</th>
                                    <th>Header</th>
                                    <th>Column</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1,001</td>
                                    <td>responsive</td>
                                    <td>bootstrap</td>
                                    <td>cards</td>
                                    <td>grid</td>
                                </tr>
                                <tr>
                                    <td>1,002</td>
                                    <td>rwd</td>
                                    <td>web designers</td>
                                    <td>theme</td>
                                    <td>responsive</td>
                                </tr>
                                <tr>
                                    <td>1,003</td>
                                    <td>free</td>
                                    <td>open-source</td>
                                    <td>download</td>
                                    <td>template</td>
                                </tr>
                                <tr>
                                    <td>1,003</td>
                                    <td>frontend</td>
                                    <td>developer</td>
                                    <td>coding</td>
                                    <td>card panel</td>
                                </tr>
                                <tr>
                                    <td>1,004</td>
                                    <td>migration</td>
                                    <td>bootstrap 4</td>
                                    <td>mobile-first</td>
                                    <td>design</td>
                                </tr>
                                <tr>
                                    <td>1,005</td>
                                    <td>navbar</td>
                                    <td>sticky</td>
                                    <td>jumbtron</td>
                                    <td>header</td>
                                </tr>
                                <tr>
                                    <td>1,006</td>
                                    <td>collapse</td>
                                    <td>affix</td>
                                    <td>submenu</td>
                                    <td>flexbox</td>
                                </tr>
                                <tr>
                                    <td>1,007</td>
                                    <td>layout</td>
                                    <td>examples</td>
                                    <td>themes</td>
                                    <td>grid</td>
                                </tr>
                                <tr>
                                    <td>1,008</td>
                                    <td>migration</td>
                                    <td>bootstrap 4</td>
                                    <td>flexbox</td>
                                    <td>design</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
            <!--/row-->

         <!--    <a id="more"></a>
            <hr>
            <h2 class="sub-header mt-5">Use card decks for equal height rows of cards</h2> -->
           <!--  <div class="mb-3">
                <div class="card-deck">
                    <div class="card card-inverse card-success text-center">
                        <div class="card-body">
                            <blockquote class="card-blockquote">
                                <p>It's really good news that the new Bootstrap 4 now has support for CSS 3 flexbox.</p>
                                <footer>Makes flexible layouts <cite title="Source Title">Faster</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                    <div class="card card-inverse card-danger text-center">
                        <div class="card-body">
                            <blockquote class="card-blockquote">
                                <p>The Bootstrap 3.x element that was called "Panel" before, is now called a "Card".</p>
                                <footer>All of this makes more <cite title="Source Title">Sense</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                    <div class="card card-inverse card-warning text-center">
                        <div class="card-body">
                            <blockquote class="card-blockquote">
                                <p>There are also some interesting new text classes for uppercase and capitalize.</p>
                                <footer>These handy utilities make it <cite title="Source Title">Easy</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                    <div class="card card-inverse card-info text-center">
                        <div class="card-body">
                            <blockquote class="card-blockquote">
                                <p>If you want to use cool icons in Bootstrap 4, you'll have to find your own such as Font Awesome or Ionicons.</p>
                                <footer>The Glyphicons are not <cite title="Source Title">Included</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--/row-->

            <!-- <a id="flexbox"></a>
            <hr>
            <h2 class="mt-5">Masonry-style grid columns</h2>
            <h6>with Bootstrap 4 flexbox</h6> -->

           <!--  <div class="card-columns mb-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="//placehold.it/600x200/444/fff?text=..." alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">New XL Grid Tier</h4>
                        <p class="card-text">With screens getting smaller, Bootstrap 4 introduces a new grid breakpoint with the col-xl-* classes. This extra tier extends the media query range all the way down to 576 px. Eventhough the new XL tier would make one think it’s been added to support extra large screens, it’s actually the opposite.</p>
                    </div>
                </div>
                <div class="card card-body">
                    <blockquote class="card-blockquote">
                        <p>Bootstrap 4 will be lighter and easier to customize.</p>
                        <footer>
                            <small class="text-muted">
                              Someone famous like <cite title="Source Title">Mark Otto</cite>
                            </small>
                        </footer>
                    </blockquote>
                </div>
                <div class="card">
                    <img class="card-img-top img-fluid" src="//placehold.it/600x200/bbb/fff?text=..." alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Card title</h4>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="card card-body card-inverse card-primary text-center">
                    <blockquote class="card-blockquote">
                        <p>Create masonry or Pinterest-style card layouts in Bootstrap 4.</p>
                        <footer>
                            <small>
                              Someone famous in <cite title="Source Title">Bootstrap</cite>
                            </small>
                        </footer>
                    </blockquote>
                </div>
                <div class="card card-body text-center">
                    <h4 class="card-title">Clever heading</h4>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <p class="card-text"><small class="text-muted">Last updated 5 mins ago</small></p>
                </div>
                <div class="card">
                    <img class="card-img img-fluid" src="//placehold.it/600x200/777/fff?text=..." alt="Card image">
                </div>
                <div class="card card-body text-right">
                    <blockquote class="card-blockquote">
                        <p>There are also some interesting new text classes to uppercase or capitalize.</p>
                        <footer>
                            <small class="text-muted">
                              Someone famous in <cite title="Source Title">Bootstrap</cite>
                            </small>
                        </footer>
                    </blockquote>
                </div>
                <div class="card card-body">
                    <h4 class="card-title">Responsive</h4>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
                <div class="card">
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="text-capitalize"><code class="text-lowercase">text-capitalize</code> Capitalize each word</li>
                            <li class="text-uppercase"><code class="text-lowercase">text-uppercase</code> Uppercase text</li>
                            <li class="text-success"><code>text-success</code> Contextual colors for text</li>
                            <li><code>text-muted</code> <span class="text-muted">Lighten with muted</span></li>
                            <li><code>text-info</code> <span class="text-muted">Info text color</span></li>
                            <li><code>text-danger</code> <span class="text-muted">Danger text color</span></li>
                            <li><code>text-warning</code> <span class="text-muted">Warning text color</span></li>
                            <li><code>text-primary</code> <span class="text-primary">Primary text color</span></li>
                        </ul>
                    </div>
                </div>
                <div class="card card-body">
                    <h4 class="card-title">Heading</h4>
                    <p class="card-text">So now that you've seen some of what Bootstrap 4 has to offer, are you going to give it a try?</p>
                    <p class="card-text"><small class="text-muted">Last updated 12 mins ago</small></p>
                </div>
            </div> -->
            <!--/card-columns-->

          <!--   <a id="layouts"></a>
            <hr>
            <h2 class="sub-header mt-5">Interesting layouts and elements</h2> -->
           <!--  --><!--/row-->

        </div>
        <!--/main col-->
    </div>

</div>
<!--/.container-->
<footer class="container-fluid">
    <p class="text-right small">©2016-2017 Company</p>
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