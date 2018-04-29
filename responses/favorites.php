<?php

$favorites = $vogoo->member_ratings($_SESSION["username"],$orderby_date = false,$orderby_rating = true, $sort_order_ASC = false,$real_ratings = true,$not_interested = false,$cat = 1);

$favorites = array_slice($favorites,0,10);


foreach ($favorites as $key => $favorite) {
    $productInfo = $vogoo_users->get_product_info($favorite['product_id']);
    $favorites[$key]["name"] = $productInfo["product_name"];
    $favorites[$key]["rating"] = $favorite["rating"]*5;
}

header("Content-Type: application/json");
echo json_encode(["success" => true, "favorites" => $favorites]);



?>