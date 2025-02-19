<?php 


function isAdmin() {
    $roles = getUserRoles($_SESSION['user']);
    return in_array("admin", $roles["role"]);
}







?>