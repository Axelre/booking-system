
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
				<div id="Thread">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return Validate_Thread()">
                    <h2>Title</h2>   <br />
                    <input class="inp" type="text" placeholder="Enter Title" name="title" required id = "title"> 
					<h2>Post</h2><br />
                    <textarea cols=200 rows=20 name="thread" id="thread"></textarea><br />
					<input type ="submit" name ="btnSubmitThread" value="Post Thread"> <br />
                    <span class="error"> <?php if(isset($formError)) echo $formError;?></span> <br />
                    <span class="success"> <?php if(isset($formSuccess)) echo $formSuccess;?></span> <br />
				</form>
				</div>
			</div>
			</div>
		</div>
	</body>