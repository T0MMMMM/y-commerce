<?php

require_once 'crudUser.php';

function isAdmin() {
    return userIsAdmin($_SESSION['user']);
}

function userIsAdmin(int $id) {
    $roles = getUserRoles($id);
    return in_array("admin", $roles["role"]);
}

?>