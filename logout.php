<?php
session_start();
//MENGHANCURKAN SESSION
session_destroy();
header("location: index.php");
