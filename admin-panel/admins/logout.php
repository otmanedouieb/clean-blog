<?php
session_start();
session_unset();
session_destroy();
header('Location: http://localhost/clean-blog/admin-panel/index.php');
