<?php 
echo file_get_contents("../txt/templateI.txt");
echo '      
<form class="form-signin" method="GET" action="login_enter.php">
        <h2 class="form-signin-heading">Login</h2>
        <label for="username" class="sr-only">Username</label>
        <input type="us" id="username" name="username"class="form-control" placeholder="username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="logga">Login</button>
      </form>';

echo file_get_contents("../txt/templateF.txt");

?>