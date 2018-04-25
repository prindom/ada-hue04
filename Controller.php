<?php


const vg_dbhost = 'localhost';
const vg_dbname = 'vogoo';
const vg_dbuser = 'root';
const vg_dbpasswd = '';


require_once ("./Vogoo/vogoo.php");
require_once ("./Vogoo/users.php");
require_once ("./Vogoo/items.php");

if(isset($_POST["login"])) {
    login($_POST["login"]);
} else if(isset($_POST["logout"])) {
    unset($_SESSION["username"]);
}

function login($user) {
    $_SESSION["username"] = $user;

    $sql = "SELECT * FROM vogoo_ratings WHERE member_id = ".$user;

    $db = mysqli_connect(vg_dbhost, vg_dbuser, vg_dbpasswd, vg_dbname);

    $result = $db->query($sql);

    if($row = $result->fetch_row()) {
        echo json_encode(["success" => true, "message" => "user was found and logged in"]);
    } else {
        echo json_encode(["success" => true, "message" => "user was not found and logged in"]);
    }
    exit;
}


function getFavourites() {

}

function getUserBased() {

}

function getItemName() {

}

/**
 * @param $product_id
 * @return string
 */
function getReasonsForItem($product_id) {
    if(isset($_SESSION["username"])) {
        $reasonItems = $vogoo_items->member_get_reasons($_SESSION["username"], $product_id);
        $final = array();

        if(count($reasonItems) > 3) {
            for($i = 0; $i <= 3; $i++) {
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