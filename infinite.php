<?php
session_unset();
require_once  'Controller.php';		
$controller = new Controller();	
$controller->fetchGame();
?>