<?php
session_start();
session_destroy();
header('Location: http://localhost/app-sport/admin/login');
exit();
?>