<?php
//controller file, no outputs

session_start();

const vg_dbhost = 'localhost';
const vg_dbname = 'vogoo';
const vg_dbuser = 'root';
const vg_dbpasswd = '';

require_once ('./Vogoo/vogoo.php');
require_once ('./Vogoo/users.php');
require_once ('./Vogoo/items.php');

if (isset($_POST["login"])) {
    login($_POST["login"]);
}




if (isset($_POST["method"])) {
    //includes required files
    if ($_POST["method"] == "getItemBased") {
        include "./responses/item-based.php";
    }
    else if ($_POST["method"] == "getFavourites") {
        include "./responses/favorites.php";
    }
    else if ($_POST["method"] == "getUserBased") {
        include "./responses/user-based.php";
    }
    else if( $_POST["method"] == "logout") {
        unset($_SESSION["username"]);
        logout();
    }
}

/**
 * @param $user
 */
function login($user)
{
//userlogin

    $sql = "SELECT * FROM vogoo_ratings WHERE member_id = " . $user;

    $db = mysqli_connect(vg_dbhost, vg_dbuser, vg_dbpasswd, vg_dbname);

    $result = $db->query($sql);


    if ($row = $result->fetch_row()) {
        echo json_encode(["success" => true, "message" => "user was found and logged in", "found" => true, "user" => $user]);
        $_SESSION["username"] = $user;
    } else {
        echo json_encode(["success" => true, "message" => "user was not found and logged in", "found" => false]);
    }


    exit;
}

function logout(){
    //userlogout
    echo json_encode(["success" => true, "message" => "user was logged out"]);

    exit;
}


