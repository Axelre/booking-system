<?php
session_start();
date_default_timezone_set('Europe/Stockholm');

if (isset($_POST["btnSubmitThread"]))
{
    CreateThread();
}


function CreateThread()
{
    require "db.php";
    $date = date('Y-m-d H:i');
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
        $statement =$db->prepare("INSERT INTO Threads (Title, TextPost , UserID, Date) VALUES (:title , :textPost , :userID , :date)");
        $statement->bindParam(':title', $Title);
        $statement->bindParam(':textPost', $Thread);
        $statement->bindParam(':userID', $_SESSION['user_id']);
        $statement->bindParam(':date', $date);
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




