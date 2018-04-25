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

    $sql = "SELECT * FROM vogoo_ratings WHERE members_id = ".$user;

    $db = mysqli_connect(vg_dbhost, vg_dbuser, vg_dbpasswd, vg_dbname);

    $result = $db->query($sql);

    if($row = $result->fetch_row()) {
        return json_encode(["status" => "success", "message" => "user was found and logged in"]);
    } else {
        return json_encode(["status" => "success", "message" => "user was not found and logged in"]);
    }
}


function getFavourites() {}
function getUserBased() {}
function getItemBased() {}