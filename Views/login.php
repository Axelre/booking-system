<!DOCTYPE html>
<html>
    <head>
    <script src="../errorhandler.js"></script>
        <title>Login TAKTERRASSEN</title>
        <link rel="stylesheet" href="../CSS/loginstyle.css?v=1.1">
        <?php include '../db.php';
        include '../Databaseinfo.php';

        ?>
    </head>
    <body>
        <div class="header">
            <h1>TAKTERRASSEN</h1>
        </div>
        <div class="background">
            <div class="form-box">
                <div class="button-box">
                    <div id="btn"></div>
                    <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                    <button type="button" class="toggle-btn" onclick="register()">Register</button>
                </div><!--Val av login eller sign up. Script nere på sidan körs-->
                <form id="LoginForm" class="formclass" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return loginerrorhandling();">
                    <input type="text" class="input-field" placeholder="Enter Username" name="uid" required>
                    <input type="password" class="input-field" placeholder="Enter Password"  name="pwd" required>
                    <input type="submit" class="submit-btn" name ="btnLoginAccount" value="Login"></input>
                    </form><!--Loginform-->
                <form id="CreateUserForm" class="formclass" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return registererrorhandling();";>
                    <input type="text" placeholder="Enter E-mail" name="email" class="input-field" required>
                    <input type="text" placeholder="Enter Username" name="username" class="input-field" required>
                    <input type="password" placeholder="Enter Password" name="password" class="input-field" required>
                    <input type="submit" class="submit-btn" name ="btnCreateAccount" value="Create Account"></input>
                </form><!--Signupform-->
        <script>
            var x = document.getElementById("LoginForm");
            var y = document.getElementById("CreateUserForm");
            var z = document.getElementById("btn");
            function register(){
                x.style.left ="-400px";
                y.style.left ="50px";
                z.style.left ="110px";
            }
            function login(){
                x.style.left ="50px";
                y.style.left ="450px";
                z.style.left ="0";
            }
        </script><!--Script som ändrar form mellan signup och login-->
    </body>
</html>