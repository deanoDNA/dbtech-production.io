<?php
session_start();
session_unset();
session_destroy();
header("Location: http://localhost/obva%20system/mechanic.html");
exit;
?>
