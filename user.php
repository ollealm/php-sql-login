<?php 
  require "header.php"
?>

<h1 class="pb-3">User Page</h1>


<?php 
  // kollar att användaren är inloggad med sessions id
  if (isset($_SESSION['id'])) {
    // skriver ut användarens information som sparats i sessionen
    echo "<p>Hello <strong>" . $_SESSION['user_name'] . "</strong> your email is <strong>" . $_SESSION['email'] . "</strong></p>";
    
    // logout button
    echo '<form action="scripts/logout.php" method="post"> 
      <button type="submit" class="btn btn-dark mt-3" name="logout-submit">Logout</button>
      </form>';
  } else {
    echo "<p class='error'>You need to log in to access this</p>";
  }


?>


<?php 
  require "footer.php"
?>