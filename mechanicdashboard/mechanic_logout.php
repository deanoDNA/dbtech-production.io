<?php
session_start();
session_unset();
session_destroy();
header("Location: https://localhost/obva%20system/mechanicdashboard.html");
exit;
?>
