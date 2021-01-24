<?php
session_start();
session_destroy();
session_write_close();
header("Location: ../../settings/login.php");
die();
