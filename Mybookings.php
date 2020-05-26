<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My bookings</title>
</head>
<body>
<?php    

session_start();
include 'db.php';
$user = $_SESSION['user_id'];
$sql = "SELECT booking_date FROM bookings WHERE User_id LIKE '$user%'";
$statement = $db->query($sql);
$statement->setFetchMode(PDO::FETCH_ASSOC);;

while($row = $statement->fetch())
    {
        echo "<div>
        <hr noshade>
        <b>Date:</b>".$row['booking_date']."
        <hr noshade>
         </div>";

    }

?>
</body>
</html>