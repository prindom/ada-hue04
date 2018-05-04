<?php

/*session_start();

require_once ('./../Vogoo/vogoo.php');
require_once ('./../Vogoo/users.php');
require_once ('./../Vogoo/items.php');*/

$user = $_SESSION["username"];

$similarities = [];
$vogoo_users->member_k_similarities($user,30,$similarities);
//gets max 30 similar users

$recommendations = [];

$vogoo_users->member_k_recommendations($user,15, $similarities, $recommendations);
//get 15 best user based recommendations


$final = [];

foreach ($recommendations as $key => $recommendation) {
    $productInfo = $vogoo_users->get_product_info($recommendation["product_id"]);
    $final[$key] = $productInfo["product_name"];
}

header("Content-Type: application/json");
echo json_encode(["success" => true, "recommendations" => $final]);

?>