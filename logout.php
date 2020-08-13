<?php

/// LOGOUT SKRIPT ///

// startar en session
session_start();
// tömmer sessionen
session_unset();
// tar bort sessionen
session_destroy();
// skickar användaren till index 
// med logout meddelande
header("location: ./index.php?logout=true");
exit();