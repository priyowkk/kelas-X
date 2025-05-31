<?php
require_once 'includes/utils.php';

session_destroy();
header('Location: login.php');
exit();
