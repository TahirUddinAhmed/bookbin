<?php
// create date format 
function dateFormat($date_create){
    $create = date_create($date_create);
    $date = date_format($create, "dS M y h:iA");
    echo $date;
    return $date;
}

?>