<?php
include ('db.php');
if (isset($_POST['CommentDelete']))
{
    $commentid = $_POST['comment_id'];
    $statement = $db->prepare('DELETE FROM Comments WHERE CommentID = :commentid');
    $statement->bindParam(':commentid', $commentid);
    $statement->execute();
}
header('Location: views/MainPage.php');
?>