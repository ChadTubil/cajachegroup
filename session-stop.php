<?php
    include 'db-controller.php';
    session_start();
    session_destroy();
    session_unset();
?>