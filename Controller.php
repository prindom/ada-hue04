<?php
session_start();

const vg_dbhost = 'localhost';
const vg_dbname = 'vogoo';
const vg_dbuser = 'root';
const vg_dbpasswd = '';


include ("./Vogoo/vogoo.php");
include ("./Vogoo/users.php");
include ("./Vogoo/items.php");

if (isset($_POST["login"])) {
    login($_POST["login"]);
} else if (isset($_POST["logout"])) {
    unset($_SESSION["username"]);
}

if(isset($_POST["method"])) {
    // $_POST["method"]();
    if($_POST["method"] == "getItemBased") {
        $items = $vogoo_items->member_get_recommended_items(1);
        var_dump($items);
        exit;
    }
}

function login($user)
{
    $_SESSION["username"] = $user;

    $sql = "SELECT * FROM vogoo_ratings WHERE member_id = " . $user;

    $db = mysqli_connect(vg_dbhost, vg_dbuser, vg_dbpasswd, vg_dbname);

    $result = $db->query($sql);

    if ($row = $result->fetch_row()) {
        echo json_encode(["success" => true, "message" => "user was found and logged in", "user" => $user]);
    } else {
        echo json_encode(["success" => true, "message" => "user was not found and logged in", "user" => $user]);
    }
    exit;
}


function getFavourites()
{
    if (isset($_SESSION["username"])) {
        $sql = "SELECT vr.product_id, rating, vp.product_name as 'name' 
          FROM vogoo_ratings vr 
          JOIN vogoo_products vp ON vp.product_id = vr.product_id
          WHERE vr.member_id = " . $_SESSION["username"];

        $db = mysqli_connect(vg_dbhost, vg_dbuser, vg_dbpasswd, vg_dbname);
        $result = $db->query($sql);
        $results = $result->fetch_all(MYSQLI_ASSOC);
        $final = array();

        if (count($results) > 5) {
            for ($i = 0; $i <= 4; $i++) {
                $final[$results[$i]["product_id"]] = array("name" => $results[$i]["name"], "rating" => $results[$i]["rating"]);
            }
        } else {
            foreach ($results as $item) {
                $final[$item["product_id"]] = array("name" => $item["name"], "rating" => $item["rating"]);
            }
        }

        header("Content-Type: application/json");
        echo json_encode($results);
        exit;
    } else {
        header("Content-Type: application/json");
        echo json_encode(["success" => false, "message" => "no movies found"]);
        exit;
    }
}

function getUserBased()
{

}

function getProduct($id) {
    $sql = "SELECT * FROM vogoo_products WHERE product_id = ".$id;

    $db = mysqli_connect(vg_dbhost, vg_dbuser, vg_dbpasswd, vg_dbname);

    $result = $db->query($sql);

    $results = $result->fetch_all(MYSQLI_ASSOC);

    var_dump($results);

    if(!empty($results)) {
        return $results[0];
    } else {
        return null;
    }
}

function getItemBased() {
    echo "in itembased";
    if(isset($_SESSION["username"])) {
        echo " and logged in";
        $items = $vogoo_items->member_get_recommended_items($_SESSION["username"]);

        var_dump($items);
        $final = array();

        foreach ($items as $item) {
            $final[$item] = getProduct($item);
        }



        // header("Content-Type: application/json");
        echo json_encode(["success" => true,"message" => "some text", "data" => $final]);
        exit;


    } else {
        // not logged in
        // header("Content-Type: application/json");
        echo json_encode(["success" => false, "message" => "not logged in"]);
        exit;
    }




}

/**
 * @param $product_id
 * @return string
 */
function getReasonsForItem($product_id)
{
    if (isset($_SESSION["username"])) {
        $reasonItems = $vogoo_items->member_get_reasons($_SESSION["username"], $product_id);
        $final = array();

        if (count($reasonItems) > 3) {
            for ($i = 0; $i <= 2; $i++) {
                $final[$reasonItems[$i]] = array("name" => getItemName($reasonItems[$i]));
            }
        } else {
            foreach ($reasonItems as $item) {
                $final[$item] = array("name" => getItemName($item));
            }
        }

        return json_encode($final);

    } else {
        // not loggged in
    }
}