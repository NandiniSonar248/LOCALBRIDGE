<?php
session_start();

// Destroy all session data
$_SESSION = [];
session_unset();
session_destroy();

// Redirect to home page with a query parameter indicating logout success
header("Location: index.html?logout=success");
exit();
?>
