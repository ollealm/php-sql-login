<!-- Separat header-fil med session_start() och meny -->
<?php 
  require "header.php"
?>
<h1 class="pb-3">Login Page</h1>

<?php 

// kollar efter felmeddelanden
// och skriver ut dessa till användaren
if (isset($_GET['error'])) {
  if ($_GET['error'] == "empty") echo '<p class="text-danger">You need to fill in all fields</p>';
  else if ($_GET['error'] == "wrong") echo '<p class="text-danger">Wrong username or password</p>';
  else echo '<p class="text-danger">Login failed</p>';
}

// kollar om användaren loggat ut och skriver ut detta
if (isset($_GET['logout'])) {
  if ($_GET['logout'] == "true") {
    echo '<p class="text-success">You logged out</p>';
  }
}

// kollar om användaren redan är inloggad genom id i sessionen
// visar annars inloggnings-formulär
if (isset($_SESSION['id'])) {
  echo 
  '<p>You are already logged in</p>
  <p><a href="user.php">Go to user page</a></p>';
} else {
  // använder POST istället för GET för att inte visa känslig data
  echo 
  '<form action="login.php" method="post"> 
    <div class="form-group">
      <input type="text" name="username" placeholder="Username" class="form-control">
    </div>

    <div class="form-group">
      <input type="password" name="password" placeholder="Password" class="form-control">
    </div>
    <p><small>[Test user: olle / olle]</small></p>
    <button class="btn btn-dark" type="submit" name="login-submit">Login</button>
  </form>';
}

?>

</div>

</body>

</html>