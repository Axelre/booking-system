<?php
include ('db.php');
if (isset($_POST['ThreadDelete']))
{
    $ThreadID = $_POST['ThreadID'];
    $statement = $db->prepare('DELETE FROM Threads WHERE ThreadID = :threadid');
    $statement->bindParam(':threadid', $ThreadID);
    $statement->execute();
}
header('Location: bulletinboard.php');
?>