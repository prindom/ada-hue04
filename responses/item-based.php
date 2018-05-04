<?php

$recommendations = $vogoo_items->member_get_recommended_items($_SESSION["username"]);
//gets item based reccomendations

$final = [];


foreach($recommendations as $key => $recommendation){

//    creates final reccomendations-array
    $reasons = $vogoo_items->member_get_reasons($_SESSION["username"], $recommendation);


    $name = $vogoo_users->get_product_info($recommendation);
    $final[$key]["name"] = $name["product_name"];
    foreach ($reasons as $reasonKey => $reason) {
        $reasonName = $vogoo_users->get_product_info($reason);
        $final[$key]["reasons"][$reasonKey] = $reasonName["product_name"];

        if(count($final[$key]["reasons"])> 3) {
            $final[$key]["reasons"] = array_slice($final[$key]["reasons"], 0, 3);
        }
    }



}


header("Content-Type: application/json");
echo json_encode(["success" => true, "recommendations" => $final]);



?>