<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['name_user'])) {
    // HALAMAN DASAR USER SETELAH LOGIN
    include "home.php";
} else {
    //  HALAMAN DASAR/UTAMA WEB  
    include "system/connect.php";
    include "landingPage.php";
}
