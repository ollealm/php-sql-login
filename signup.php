<!-- Separat header-fil med session_start() och meny -->
<?php 
  require "header.php"
?>
<h1 class="pb-3">Signup Page</h1>

<?php 

// kollar efter felmeddelanden
// och skriver ut dessa till användaren
if (isset($_GET['error'])) {
  if ($_GET['error'] == "empty") echo '<p class="text-danger">You need to fill in all fields</p>';
  else if ($_GET['error'] == "invaliduseremail") echo '<p class="text-danger">Invalid user name and e-mail</p>';
  else if ($_GET['error'] == "invaliduser") echo '<p class="text-danger">Invalid user name</p>';
  else if ($_GET['error'] == "invalidemail") echo '<p class="text-danger">Invalid e-mail</p>';
  else if ($_GET['error'] == "password") echo '<p class="text-danger">Passwords don\'t match</p>';
  else if ($_GET['error'] == "usertaken") echo '<p class="text-danger">Username already taken</p>';
  else echo '<p class="text-danger">Login failed</p>';
}

// kollar om användaren loggat ut och skriver ut detta
if (isset($_GET['signup'])) {
  if ($_GET['signup'] == "success") {
    echo '<p class="text-success">Signup successful!</p>';
  }
}

// kollar om användaren redan är inloggad genom id i sessionen
// visar annars inloggnings-formulär
if (isset($_SESSION['id'])) {
  echo 
  '<p>You are logged in</p>
  <p><a href="user.php">Go to user page</a></p>';
} else {
  // använder POST istället för GET för att inte visa känslig data
  echo 
  '<form action="scripts/signup-script.php" method="post"> 
    <div class="form-group">
      <input type="text" name="username" placeholder="Username" class="form-control">
    </div>

    <div class="form-group">
      <input type="text" name="email" placeholder="E-mail" class="form-control">
    </div>

    <div class="form-group">
      <input type="password" name="password" placeholder="Password" class="form-control">
    </div>

    <div class="form-group">
      <input type="password" name="password-repeat" placeholder="Repeat password" class="form-control">
    </div>
    <button class="btn btn-dark" type="submit" name="signup-submit">Signup</button>
  </form>';
}

?>

<?php 
  require "footer.php"
?>