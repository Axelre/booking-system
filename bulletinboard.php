<?php
include ('feed.php');
include ('db.php');
date_default_timezone_set('Europe/Stockholm');

?>
<!DOCTYPE html>
<html>

<head>

    <title>Bulletin board</title>
        <link rel="stylesheet" href="bulletinboardstyling.css"
            type="text/css">
</head>

<body>

    <div id="container">
        <div id="header">
            <h1>Takterassen</h1>
            <div id="logout" align="right">
            <!--logga ut-knappen -->
            <a id="logoutbtn" href='Logout.php' >Logga ut  </a>
            
            </div>
            <a class="home" href="Mainpage.php">Home</a>
        </div>

        <div id="content">
            <div id="upload">
                <h3>Lägg upp ett inlägg:</h3>
                <form name="info" id="info"   method="post">
                    		<div id="Thread">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <h2>Title</h2>   <br />
                    <input class="inp" type="text" placeholder="Enter Title" name="title" required id = "title"> 
					<h2>Post</h2><br />
                    <textarea cols=40 rows=10 name="thread" id="thread"></textarea><br />
					<input type ="submit" name ="btnSubmitThread" value="Post Thread"> <br />
                    <span class="error"> <?php if(isset($formError)) echo $formError;?></span> <br />
                    <span class="success"> <?php if(isset($formSuccess)) echo $formSuccess;?></span> <br />
                    </form>
                    <!--Form för att lägga upp ett inlägg -->
                </form>
            </div>
            <div id="posts">
                <h3>Upplagda inlägg:</h3>
                <?php 
                $stmt = "SELECT * FROM Threads ORDER BY DATE DESC";
                $sql = $db->prepare($stmt);
                $sql->execute();
                $sql->setFetchMode(PDO::FETCH_ASSOC); ?>
					<ul>
						<?php while ($row = $sql->fetch())
						{?>
							<li>
							<?php $id = $row['ThreadID']?>
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form">
							<input type ="hidden" name ='IDvalue' value="<?php echo $row['ThreadID'] ?>"></input>
							<button type ="submit" name ="btnChooseThread"><?php echo $row['Title']?></button>
							</form>
							</li>
				  		<?php } ?>
                    </ul>
                    <!--Lista med inläggstitlar som man kan trycka på för att få upp det aktuella inlägget -->
                    <div id="Post">
					<?php
					if (isset($_POST['btnChooseThread']))
    				{
                        $ID = $_POST['IDvalue']; 
						$statement =$db->prepare('SELECT * FROM Threads WHERE ThreadID = :ID');
						$statement->bindParam(':ID', $ID);
						$statement->execute();
        				while ($row = $statement->fetch())
        				{
            				echo "<div class='PostBox'>";
                            echo "<h4 class='h4title'>"; 
                            echo $row['Title']. "<br/>"; 
                            echo "</h4>";
                            echo $row['TextPost']. "<br/>";
                            echo $row['Date'];
        				}
        				echo "</div>";
					}
                    ?>
                    <!--php-kod som hämtar ut det valda inlägget från databasen och visar det på sidan -->
				</div>
            </div>
        </div>
    </div>
   
</body>

</html>
<!-- förhindrar att formuläret återskickas när man förnyar sidan så inte ett inlägg blir upplagt dubbelt -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

