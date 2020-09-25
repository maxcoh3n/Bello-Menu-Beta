<?php

function restrictionBuilder($GF, $V, $Raw, $Spicy){
    $Restrictions = " ";

    if($GF){
        $Restrictions .= "GF ";
    }
    if($V){
        $Restrictions .= "V ";
    }
    if($Raw){
        $Restrictions .= "Raw ";
    }
    if($Spicy){
        $Restrictions .= "Spicy ";
    }

    return  substr($Restrictions, 0, -1);  
}

?>