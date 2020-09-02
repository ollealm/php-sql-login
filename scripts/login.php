<?php

/// LOGIN SKRIPT ///

// kollar att användaren kommer från login formläret
if (isset($_POST['login-submit'])) {

  // läser in databasen
  require_once "dbinfo.php";

  // tar emot användarnamn och lösenord
  // och saniterar dem för att undvika skadlig kod 
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

  // kollar om nått av fälten har lämnats tomt
  // skickar i så fall tillbaka till index med felmeddelande
  if (empty($username) || empty($password)) {
    header("location: ../index.php?error=empty&user=".$username);
    exit();
  } else {
    // lagrar queryn i en variabel och använder en placeholder
    $sql = "SELECT * FROM user WHERE user_name = (?)";

    // skapar prepare statement
    // skriver ut error ifall prepare misslyckas (!)
    if (!$stmt = $mysqli->prepare($sql)) {
      echo "Failed Prepare: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    // värde till placeholder
    $name = $username;

    //sätter in värdet i statement
    // "s" anger att det är en sträng
    // skriver ut error ifall bind_param misslyckas
    if (!($stmt->bind_param("s", $name))) {
      echo "Failed Binding: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    //kör queryn
    // skriver ut error ifall queryn misslyckas
    if (!($stmt->execute())) {
      echo "Failed Execute: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    // lagrar användaruppgifterna i en assosiativ array
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // jämför lösenord med det hashade lösenordet i databasen 
    if (password_verify($password, $row["password"])) {
      // startar en session
      session_start();
      // lagrar id, user_name och email i sessionen.
      $_SESSION['id'] = $row["id"];
      $_SESSION['user_name'] = $row["user_name"];
      $_SESSION['email'] = $row["email"];
      // skickar vidare till user sidan
      header("location: ../user.php");
      exit();
    }  else {
      // skickar tillbaka till index om lösen inte stämmer med felmeddelande
      header("location: ../index.php?error=wrong");
      exit();
    }
  }

} else {
  // skickas till index om inte användaren kommer från login formläret 
  header("location: ./index.php");
  exit();
}