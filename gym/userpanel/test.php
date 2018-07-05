<?php

function dataset(){

include 'dbconnect.php';
$db = dbConnection();

//DM

    $query = "SELECT * from `food` where `f_group`='DM' order by RAND() LIMIT 2";

        $result=mysqli_query($db,$query);

        if(mysqli_num_rows($result) > 1){


        while ($row = $result->fetch_assoc()) {

            $jsonArray[]= $row;
        }


    }

$f1 =  (int)$jsonArray[0]['f_id'];  
$f2 =  (int)$jsonArray[1]['f_id']; 

$DM_total_protein = (int)$jsonArray[0]['protein'] + (int)$jsonArray[1]['protein'];

$DM_total_fat = (int)$jsonArray[0]['fat'] + (int)$jsonArray[1]['fat'];
$DM_total_carbohydrates = (int)$jsonArray[0]['carbohydrates'] + (int)$jsonArray[1]['carbohydrates'];
$DM_total_calories = (int)$jsonArray[0]['calories'] + (int)$jsonArray[1]['calories'];

echo "<br> f1 = ".$f1;
echo "<br> f2 = ".$f2;
echo "<br>DM_total_protein = ".$DM_total_protein;
echo "<br>DM_total_fat = ".$DM_total_fat;
echo "<br>DM_total_carbohydrates = ".$DM_total_carbohydrates;
echo "<br>DM_total_calories = ".$DM_total_calories;
echo '<br>';
    // print_r($jsonArray);

    // echo sizeof($jsonArray);


//EX

    $query = "SELECT * from `food` where `f_group`='EX' order by RAND() LIMIT 2";

        $result=mysqli_query($db,$query);

        if(mysqli_num_rows($result) > 1){


        while ($row = $result->fetch_assoc()) {

            $jsonArray2[]= $row;
        }


    }

$f3 =  (int)$jsonArray2[0]['f_id'];  
$f4 =  (int)$jsonArray2[1]['f_id']; 

$EX_total_protein = (int)$jsonArray2[0]['protein'] + (int)$jsonArray2[1]['protein'];

$EX_total_fat = (int)$jsonArray2[0]['fat'] + (int)$jsonArray2[1]['fat'];
$EX_total_carbohydrates = (int)$jsonArray2[0]['carbohydrates'] + (int)$jsonArray2[1]['carbohydrates'];
$EX_total_calories = (int)$jsonArray2[0]['calories'] + (int)$jsonArray2[1]['calories'];

echo "<br> f3 = ".$f3;
echo "<br> f4 = ".$f4;
echo "<br>EX_total_protein = ".$EX_total_protein;
echo "<br>EX_total_fat = ".$EX_total_fat;
echo "<br>EX_total_carbohydrates = ".$EX_total_carbohydrates;
echo "<br>EX_total_calories = ".$EX_total_calories;
echo '<br>';


//FR

    $query = "SELECT * from `food` where `f_group`='FR' order by RAND() LIMIT 2";

        $result=mysqli_query($db,$query);

        if(mysqli_num_rows($result) > 1){


        while ($row = $result->fetch_assoc()) {

            $jsonArray3[]= $row;
        }


    }

$f5 =  (int)$jsonArray3[0]['f_id'];  
$f6 =  (int)$jsonArray3[1]['f_id']; 

$FR_total_protein = (int)$jsonArray3[0]['protein'] + (int)$jsonArray3[1]['protein'];

$FR_total_fat = (int)$jsonArray3[0]['fat'] + (int)$jsonArray3[1]['fat'];
$FR_total_carbohydrates = (int)$jsonArray3[0]['carbohydrates'] + (int)$jsonArray3[1]['carbohydrates'];
$FR_total_calories = (int)$jsonArray3[0]['calories'] + (int)$jsonArray3[1]['calories'];

echo "<br> f5 = ".$f5;
echo "<br> f6 = ".$f6;
echo "<br>FR_total_protein = ".$FR_total_protein;
echo "<br>FR_total_fat = ".$FR_total_fat;
echo "<br>FR_total_carbohydrates = ".$FR_total_carbohydrates;
echo "<br>FR_total_calories = ".$FR_total_calories;
echo '<br>';



// GR

    $query = "SELECT * from `food` where `f_group`='GR' order by RAND() LIMIT 2";

        $result=mysqli_query($db,$query);

        if(mysqli_num_rows($result) > 1){


        while ($row = $result->fetch_assoc()) {

            $jsonArray4[]= $row;
        }


    }

$f7 =  (int)$jsonArray4[0]['f_id'];  
$f8 =  (int)$jsonArray4[1]['f_id']; 

$GR_total_protein = (int)$jsonArray4[0]['protein'] + (int)$jsonArray4[1]['protein'];

$GR_total_fat = (int)$jsonArray4[0]['fat'] + (int)$jsonArray4[1]['fat'];
$GR_total_carbohydrates = (int)$jsonArray4[0]['carbohydrates'] + (int)$jsonArray4[1]['carbohydrates'];
$GR_total_calories = (int)$jsonArray4[0]['calories'] + (int)$jsonArray4[1]['calories'];

echo "<br> f7 = ".$f7;
echo "<br> f8 = ".$f8;
echo "<br>GR_total_protein = ".$GR_total_protein;
echo "<br>GR_total_fat = ".$GR_total_fat;
echo "<br>GR_total_carbohydrates = ".$GR_total_carbohydrates;
echo "<br>GR_total_calories = ".$GR_total_calories;
echo '<br>';



//NV

    $query = "SELECT * from `food` where `f_group`='NV' order by RAND() LIMIT 2";

        $result=mysqli_query($db,$query);

        if(mysqli_num_rows($result) > 1){


        while ($row = $result->fetch_assoc()) {

            $jsonArray5[]= $row;
        }


    }

$f9 =  (int)$jsonArray5[0]['f_id'];  
$f10 =  (int)$jsonArray5[1]['f_id']; 

$NV_total_protein = (int)$jsonArray5[0]['protein'] + (int)$jsonArray5[1]['protein'];

$NV_total_fat = (int)$jsonArray5[0]['fat'] + (int)$jsonArray5[1]['fat'];
$NV_total_carbohydrates = (int)$jsonArray5[0]['carbohydrates'] + (int)$jsonArray5[1]['carbohydrates'];
$NV_total_calories = (int)$jsonArray5[0]['calories'] + (int)$jsonArray5[1]['calories'];

echo "<br> f9 = ".$f9;
echo "<br> f10 = ".$f10;
echo "<br>NV_total_protein = ".$NV_total_protein;
echo "<br>NV_total_fat = ".$NV_total_fat;
echo "<br>NV_total_carbohydrates = ".$NV_total_carbohydrates;
echo "<br>NV_total_calories = ".$NV_total_calories;
echo '<br>';


//VG

$query = "SELECT * from `food` where `f_group`='VG' order by RAND() LIMIT 2";

        $result=mysqli_query($db,$query);

        if(mysqli_num_rows($result) > 1){


        while ($row = $result->fetch_assoc()) {

            $jsonArray6[]= $row;
        }


    }

$f11 =  (int)$jsonArray6[0]['f_id'];  
$f12 =  (int)$jsonArray6[1]['f_id']; 

$VG_total_protein = (int)$jsonArray6[0]['protein'] + (int)$jsonArray6[1]['protein'];

$VG_total_fat = (int)$jsonArray6[0]['fat'] + (int)$jsonArray6[1]['fat'];
$VG_total_carbohydrates = (int)$jsonArray6[0]['carbohydrates'] + (int)$jsonArray6[1]['carbohydrates'];
$VG_total_calories = (int)$jsonArray6[0]['calories'] + (int)$jsonArray6[1]['calories'];

echo "<br> f11 = ".$f10;
echo "<br> f12 = ".$f11;
echo "<br>VG_total_protein = ".$VG_total_protein;
echo "<br>VG_total_fat = ".$VG_total_fat;
echo "<br>VG_total_carbohydrates = ".$VG_total_carbohydrates;
echo "<br>VG_total_calories = ".$VG_total_calories;
echo '<br>';

$total_protein = $DM_total_protein + $EX_total_protein + $FR_total_protein + $GR_total_protein + $NV_total_protein + $VG_total_protein;

$total_fat = $DM_total_fat + $EX_total_fat + $FR_total_fat + $GR_total_fat + $NV_total_fat + $VG_total_fat;

$total_carbohydrates = $DM_total_carbohydrates + $EX_total_carbohydrates + $FR_total_carbohydrates + $GR_total_carbohydrates + $NV_total_carbohydrates + $VG_total_carbohydrates;

$total_calories = $DM_total_calories + $EX_total_calories + $FR_total_calories + $GR_total_calories + $NV_total_calories + $VG_total_calories;


$sql = "INSERT INTO data_set (f1,f2,f3,f4,f5,f6,f7,f8,f9,f10,f11,f12,total_protein,total_fat,total_carbohydrates,total_calories)
VALUES ('$f1','$f2','$f3','$f4','$f5','$f6','$f7','$f8','$f9','$f10','$f11','$f12','$total_protein','$total_fat','$total_carbohydrates','$total_calories')";

if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();

}



dataset();
            
         

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Refresh" content="5">
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<p>Auto reload page and clear cache</p>
<script type="text/javascript">

$(document).ready(function() {
  setInterval(function() {
    cache_clear()
  }, 3000);
});

function cache_clear() {
  window.location.reload(true);
  // window.location.reload(); use this if you do not remove cache
} 

</script>
</body>
</html>