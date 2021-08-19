<?php
session_start();
include "core/app/model/clsUtil.php";
//Clear Session
$_SESSION["user_id"] = "";
session_destroy();

// clear cookies
clsUtil::clearAuthCookie();

print "<script>window.location='./';</script>";
?>