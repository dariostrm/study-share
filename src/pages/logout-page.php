<?php
session_destroy();
$session = null;
header("Location: /");
exit;