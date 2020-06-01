<?php
session_start();
global $formError;

if (isset($_POST["submitbtn"]))
{
    CreateComment();
}

if (isset($_POST["btnSubmitThread"]))
{
    CreateThread();
}

function CreateComment()
{
    require "db.php";
    $Comment = test_input($_POST['message']);
    $ThreadID = $_POST['Post_id'];
    global $formError;
    global $formSuccess;
    if(empty($Comment))
    {
        $formError = "Please fill in every box";
    }
        
    else
    {
        $statement =$db->prepare("INSERT INTO Comments (Comment , Name , Email , ThreadID) VALUES (:comment , :name , :email , :threadid)");
        $statement->bindParam(':comment', $Comment);
        $statement->bindParam(':threadid', $ThreadID);
        $statement->bindParam(':name', $_SESSION['username']);
        $statement->bindParam(':email', $_SESSION['email']);
        $statement->execute();
        $formSuccess = "Comment posted!";
    }
}

function CreateThread()
{
    require "db.php";
    $Thread = test_input($_POST['thread']);
    $Title = test_input($_POST['title']);
    global $formError;
    global $formSuccess;
    if(empty($Thread))
    {
        $formError = "Please fill in every box";
    }
        
    else
    {
        $statement =$db->prepare("INSERT INTO Threads (Title, TextPost , UserID , Username) VALUES (:title , :textPost , :userID , :username)");
        $statement->bindParam(':title', $Title);
        $statement->bindParam(':textPost', $Thread);
        $statement->bindParam(':userID', $_SESSION['user_id']);
        $statement->bindParam(':username', $_SESSION['username']);
        $statement->execute();
        $formSuccess = "Thread posted!";
    }
}

    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>