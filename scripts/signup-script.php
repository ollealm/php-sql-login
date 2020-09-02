<?php

/// LOGIN SKRIPT ///

// kollar att användaren kommer från signup formläret
if (isset($_POST['signup-submit'])) {

  // läser in databasen
  require_once "dbinfo.php";

  // tar emot användarnamn och lösenord
  // och saniterar dem för att undvika skadlig kod 
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
  $password_rep = filter_input(INPUT_POST, 'password-repeat', FILTER_SANITIZE_SPECIAL_CHARS);

  // kollar om nått av fälten har lämnats tomt
  // skickar i så fall tillbaka till index med felmeddelande
  if (empty($username) || empty($email) || empty($password) || empty($password_rep)) {
    header("location: ../signup.php?error=empty&user=".$username."&email=".$email);
    exit();
  } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("location: ../signup.php?error=invaliduseremail");
    exit();
  } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("location: ../signup.php?error=invaliduser&email=".$email);
    exit();
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("location: ../signup.php?error=invalidemail&user=".$username);
    exit();
  } elseif ($password !== $password_rep) {
    header("location: ../signup.php?error=password&user=".$username."&email=".$email);
    exit();
  } else {
    // lagrar queryn i en variabel och använder en placeholder
    // $sql = "SELECT * FROM user WHERE user_name = (?)";
    $sql = "SELECT user_name FROM user WHERE user_name = (?)";

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

    if ($row > 0) {
      header("location: ../signup.php?error=usertaken&user=".$username."&email=".$email);
      exit();
    } else {
      $sql2 = "INSERT INTO user (user_name, email, password) VALUES (?, ?, ?)";

      if (!$stmt = $mysqli->prepare($sql2)) {
        echo "Failed Prepare: (" . $mysqli->errno . ") " . $mysqli->error;
      }

      $hashedPass = password_hash($password, PASSWORD_DEFAULT);

      if (!($stmt->bind_param("sss", $username, $email, $hashedPass))) {
        echo "Failed Binding: (" . $mysqli->errno . ") " . $mysqli->error;
      }

      if (!($stmt->execute())) {
        echo "Failed Execute: (" . $mysqli->errno . ") " . $mysqli->error;
      }

      header("location: ../signup.php?signup=success");
      exit();
    }

  }

} else {
  // skickas till index om inte användaren kommer från signup formläret 
  header("location: ./index.php");
  exit();
}