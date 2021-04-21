<?php
//KUMPULAN FUNGSI VALIDASI MASUKAN

// fungsi pada login

function loginEmail(&$error, $field_name)
{
    if (empty($_POST[$field_name])) {
        $error = "email is required";
        // cek apakah email sesuai format
    } else if (!filter_var($_POST[$field_name], FILTER_VALIDATE_EMAIL)) {
        $error = "invalid email address";
    } else {
        $error = "";
    }
}
function loginPass(&$error, $field_name)
{
    if (!isset($_POST[$field_name]) || empty($_POST[$field_name])) {
        $error = "password is required!";
    } else {
        $error = "";
    }
}

function authacc($email, $password)
{
    include "connect.php";
    $statement = $db->prepare("SELECT * FROM users WHERE email_user = :email and password_user = SHA2(:password,0)");
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();

    return $statement->rowCount() > 0;
}

//fungsi required
function required(&$error, $field_name)
{
    if (!isset($_POST[$field_name]) || empty($_POST[$field_name])) {
        $error = "this field is required";
    } else {
        $error = "";
    }
}
//fungsi pada signup
//VALIDASI STANDARD EMAIL DAN ISIAN REQUIRED
function validEmail(&$error, $field_name)
{
    if (!filter_var($_POST[$field_name], FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address";
    } else if (!isset($_POST[$field_name]) || empty($_POST[$field_name])) {
        $error = "this field is required";
    } else {
        $error = "";
    }
}

//VALIDASI ALPHABET DAN ISIAN REQUIRED
function validUsername(&$error, $field_name)
{
    if (!isset($_POST[$field_name]) || empty($_POST[$field_name])) {
        $error = "this field is required";
    } else if (!ctype_alpha(str_replace(' ', '', $_POST[$field_name]))) {
        $error = "username must be Alphabet";
    } else {
        $error = "";
    }
}
//VALIDASI NUMERIK, PANJANG DIGIT DAN REQUIRED
function validPhone(&$error, $field_name)
{
    if (!isset($_POST[$field_name]) || empty($_POST[$field_name])) {
        $error = "this field is required";
    } else if (!is_numeric($_POST[$field_name])) {
        $error = " phone number Must be Numeric";
    } else if (strlen($_POST[$field_name]) < 11) {
        $error = "must be valid number";
    } else {
        $error = "";
    }
}

//VALIDASI PANJANG KARAKTER , ALFANUMERIK ,DAN REQUIRED
function validPassword(&$error, $field_name)
{
    if (!isset($_POST[$field_name]) || empty($_POST[$field_name])) {
        $error = "This field is required";
    } else if (strlen($_POST[$field_name]) < 7) {
        $error = "must be at least 8 characters";
    } else {
        $error = "";
    }
}
