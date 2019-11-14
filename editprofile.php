<?php
// core configuration
include_once "config/core.php";

// check if logged in as admin
include_once "login_checker.php";

// include classes
include_once 'config/database.php';
include_once 'objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$user = new User($db);

// set page title
$page_title = "Edit profile";

// include page header HTML
include_once "layout_head.php";

echo "<div class='col-md-12'>";

// read user from the database
$stmt = $user->readUser($from_record_num);

// count retrieved user
$num = $stmt->rowCount();

// include products table HTML template
include_once "edit_profile_template.php";

echo "</div>";

// include page footer HTML
include_once "layout_foot.php";
?>