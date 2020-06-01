<?php
session_start();

if (isset($_POST["btnSubmitThread"]))
{
    CreateThread();
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
        $statement =$db->prepare("INSERT INTO Threads (Title, TextPost , UserID) VALUES (:title , :textPost , :userID)");
        $statement->bindParam(':title', $Title);
        $statement->bindParam(':textPost', $Thread);
        $statement->bindParam(':userID', $_SESSION['user_id']);
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




