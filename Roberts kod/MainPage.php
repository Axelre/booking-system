<?php 
include ('../Foruminfo.php');
include ('../db.php');
if ( isset( $_SESSION['user_id'] ) ) 
{
	
} 
else 
{
    header("Location: Login.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Forum</title>
		<link rel="stylesheet" type="text/css" href="style.css?v=1.1" />
		<link rel="stylesheet" type="text/css" href="header.css?v=1.1" />
		<script type="text/javascript" src="../Javascript/Validate.js"></script>
	</head>

	<body>
		<div id="Container">
			<div id="Header">
				<h1>Roberts Forum</h1>
				<ul class="HeaderPoints">
				<li style= display:inline-block><a href="MainPage.php">Home</a></li> 
				<li style= display:inline-block><a href="PostThread.php">New Thread</a></li> 
				<li style= display:inline-block><a href="../Logout.php">Logout</a></li>
				</ul>
			</div>
			<div id="Sidebar">
				<h3>Threads</h3>
					<?php $sql = $db->query('SELECT * FROM Threads'); ?>
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
			</div>
			<div id="PostAndComments">
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
							echo "<h4 class='h4title'>"; echo $row['Title']. "<br/>"; echo "</h4>";
            				echo $row['TextPost']. "<br/>";
            				echo "<h4 class='h4signature'>";echo $row['Username']. "<br/>"; echo "</h4>";
        				}
        				echo "</div>";
					}
					?>
				</div>
				<div id="Comments">
					<?php if (isset($_POST['btnChooseThread']))
    				{
						$ID = $_POST['IDvalue'];
						$result = $db->query('SELECT * FROM Comments');
						while ($row = $result->fetch())
						{
							if ($row['ThreadID'] == $ID)
								{
									echo "<div class='CommentBox'>";
									echo $row['Comment'];
									echo "<h4 class='h4signature'>"; echo $row['Name']; echo "</h4>";
									if ($row['Name'] == $_SESSION['username'])
									{
										echo "
										<form class='deleteForm' method='POST' action='../DeleteComment.php'>
										<input type='hidden' name='comment_id' value='".$row['CommentID']."'>
										<input type ='submit' name ='CommentDelete' value='Delete'>
										</form>";
									}
								echo "</div>";
								}
						}
					}?>
				</div>
					<?php if (isset($_POST['btnChooseThread']))
    				{
						$ID = $_POST['IDvalue'];?>
						<div id="PostComment">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return Validate_Comment()">
						<b>Comment</b><br />
						<textarea cols=110 rows=5 name="message" id="message"></textarea><br />
						<input type ="hidden" name ='Post_id' value="<?php echo $ID?>"></input>
						<input type ="submit" name ="btnSubmit" value="Comment"> <br />
					<?php } ?>
				</form>
				<span class="CommentError"> <?php if(isset($formError)) echo $formError;?></span> <br />
				<span class="CommentSuccess"> <?php if(isset($formSuccess)) echo $formSuccess;?></span> <br />
				</div>
			</div>
			</div>
		</div>
	</body>