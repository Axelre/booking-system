<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>

    <title>Takterassen</title>
        <link rel="stylesheet" href="mainpagestyle.css"
            type="text/css">
            <?php


 ?>
</head>

<body>

    <div id="container">
        <div id="header">
            <h1>Takterassen</h1>
        <div id="content">
            <div id="upload">
                <h3>Lägg upp ett inlägg:</h3>
                <form name="info" id="info"   method="post">
                    <label for="Post">Inlägg:</label><br>
                    <textarea name="Post" id= "Post" required></textarea><br>
                    <input id="submitbtn" name="submit_data" type="submit" value="Publicera!">
                    </form>
        
                </form>
            </div>
            <div id="posts">
                <h3>Upplagda inlägg:</h3>
                <?php
                //funktioner för att hämta och skriva ut kommentarer
              
                ?>
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

