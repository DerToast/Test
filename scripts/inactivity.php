<?php
if (isset($_SESSION)) {
  // only if user is logged in perform this check
  if ((time() - $_SESSION['last_login_timestamp']) > 300) {
    header('Location: scripts/logout.php');
    exit;
  } 

  else 
  {
    $_SESSION['last_login_timestamp'] = time();
  }
}
?>