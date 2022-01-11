<?php
    session_start();
    session_destroy();

    header('Location: ../views/home_view.php');
?>