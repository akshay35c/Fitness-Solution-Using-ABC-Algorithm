<?php

    function dbConnection() {
        //$rConnection = mysqli_connect(gServerName.':'.Sport, gUserName, gPassword);
		$rConnection = mysqli_connect("localhost", "root", "");
        if(!$rConnection) {
            $msg = "Error :- Couldn't connected mysqli";
         
            return E00010;
        }
        if(!mysqli_select_db($rConnection, "gym")) {
            $msg = "Error :- Couldn't Select The Database " . gDatabase;
        
            return E00010;
        }
        return($rConnection);
    }

    //! Close Connection
    function dbConnectionClose($rConnection) {
        mysqli_close($rConnection);
    }


function getClosest($search, $arr) {
   $closest = null;
   foreach ($arr as $item) {
      if ($closest === null || abs($search - $closest) > abs($item - $search)) {
         $closest = $item;
      }
   }
   return $closest;
}

?>