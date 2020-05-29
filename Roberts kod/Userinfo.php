<?php

if (isset($_POST["btnCreate"]))
{
    CreateUser();
}

if (isset($_POST["btnLogin"]))
{
    LoginUser();
}

function CreateUser()
{
    include 'db.php';

    $Email = $_POST['email'];
    $Password = $_POST['password'];
    $Username = $_POST['username'];
    $salt = PASSWORD_DEFAULT;
    $salt_password = password_hash($_POST['password'], $salt);
    global $formError;
    global $emailErr;
    global $formSucces;
    global $duplEmail;
    global $duplUsername;
    $Error = false;

    if(empty($Password) || empty($Email) || empty($Username))
    {
        $formError = "please fill in every box";
        $Error = true;
    }

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) 
    {
        $emailErr = "Invalid e-mail format";
        $Error = true;
    }

    if (emailExists($Email))
    {
        $duplEmail = "That E-mail is already in use";
        $Error = true;
    }

    if (usernameExists($Username))
    {
        $duplUsername = "That Username is already in use";
        $Error = true;
    }

    if ($Error == false)
    {
        $statement =$db->prepare("INSERT INTO userInfo (Email , Password , Username , Salt) VALUES (:email , :password , :username , :salt)");
        $statement->bindParam(':email', $Email);
        $statement->bindParam(':password', $salt_password);
        $statement->bindParam(':username', $Username);
        $statement->bindParam(':salt', $salt);
        $statement->execute();
        $formSucces = "Your Account has been created!";
    }

}

function LoginUser()
{
    session_start();
    include 'db.php';
    global $SuccesVar;
    $LoginEmail = $_POST['useremail'];
    $LoginPassword = $_POST['userpassword'];

    $statement = $db->prepare('SELECT * FROM userInfo WHERE Email = :LoginEmail;');
    $statement->bindParam(':LoginEmail', $LoginEmail);
    $statement->execute();
    $user = $statement->fetch() ;
    $pass = $user['Password'];
    $ID = $user['uniqueValue'];
    $username = $user['Username'];

    if(password_verify($LoginPassword, $pass))
    {
        $SuccesVar = "success";
        $_SESSION['user_id'] = $ID;
        $_SESSION['email'] = $LoginEmail;
        $_SESSION['username'] = $username;
        header('Location: MainPage.php');
    }
    else
    {
        $SuccesVar = "E-mail or Password is wrong";
    }
}

function LogoutUser()
{
    echo "Logout is called";
    session_start();
    session_destroy();
}

function emailExists($Email) 
{
    include 'db.php';
    $statement = $db->prepare("SELECT Email FROM userInfo WHERE Email = :Email");
    $statement->bindParam(':Email', $Email);
    $statement->execute();
    $found = $statement->fetchColumn();
    
    if( $found ) 
    {
        return true;
    } 
    else 
    {
        return false;
    }
}

function usernameExists($Username) 
{
    include 'db.php';
    $statement = $db->prepare("SELECT Username FROM userInfo WHERE Username = :Username");
    $statement->bindParam(':Username', $Username);
    $statement->execute();
    $found = $statement->fetchColumn();
    
    if( $found ) 
    {
        return true;
    } 
    else 
    {
        return false;
    }
}

?>