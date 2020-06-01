<?php

if (isset($_POST["btnCreateAccount"]))
{
    CreateAccount();
}

if (isset($_POST["btnLoginAccount"]))
{
    LoginAccount();
}

function CreateAccount()
{
    require("db.php");
        $Username = test_input($_POST['username']);
        $Email = test_input($_POST['email']);
        $Password = $_POST['password'];
        $salt = PASSWORD_DEFAULT;
        $salt_password = password_hash($_POST['password'], $salt);
        if(empty($Username) || empty($Email) || empty($Password))
        {
            {echo '<script language="javascript">';
                echo 'window.alert("Du måste fylla i alla fält")';
                echo '</script>';;}
        }
        else
        {
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) 
            {
                {echo '<script language="javascript">';
                    echo 'window.alert("Fel format på email")';
                    echo '</script>';;}
            }
            else if (emailExists($Email))
            {
                {echo '<script language="javascript">';
                    echo 'window.alert("Email redan tagen")';
                    echo '</script>';;}
            }
        
            else if (usernameExists($Username))
            {
                {echo '<script language="javascript">';
                    echo 'window.alert("Användarnamnet redan taget")';
                    echo '</script>';;}
            }
            else
            {
                $statement =$db->prepare("INSERT INTO User (Username , Email , Password, Salt) VALUES (:username , :email , :password , :salt)");
                $statement->bindParam(':username', $Username);
                $statement->bindParam(':email', $Email);
                $statement->bindParam(':password', $salt_password);
                $statement->bindParam(':salt', $salt);
                $statement->execute();
            }
        }
}

function LoginAccount()
{
    session_start();
    include 'db.php';
    $LoginUsername = $_POST['uid'];
    $LoginPassword = $_POST['pwd'];
    $statement = $db->prepare('SELECT * FROM User WHERE Username = :LoginUsername;');
    $statement->bindParam(':LoginUsername', $LoginUsername);
    $statement->execute();
    $user = $statement->fetch();
    if(!isset($user['User_id']))
    
        {echo '<script language="javascript">';
        echo 'window.alert("Användaren finns inte")';
        echo '</script>';;} else
    {
    $pass = $user['Password'];
    $LoginEmail = $user['Email'];
    $ID = $user['User_id'];
    

    if(password_verify($LoginPassword, $pass))
    {
        $_SESSION['user_id'] = $ID;
        $_SESSION['email'] = $LoginEmail;
        $_SESSION['username'] = $LoginUsername;
        header('Location: Mainpage.php');
    }
    else
    {
        {echo '<script language="javascript">';
            echo 'window.alert("Användarnamn och lösenord stämmer inte överens")';
            echo '</script>';;}
    }
}
}

function LogoutUser()
{
    echo "Logout is called";
    session_start();
    session_destroy();
}
             
function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function emailExists($Email) 
{
    include 'db.php';
    $statement = $db->prepare("SELECT Email FROM User WHERE Email = :Email");
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
    $statement = $db->prepare("SELECT Username FROM User WHERE Username = :Username");
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