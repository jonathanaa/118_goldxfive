<?php
include "../lib/phpqrcode/qrlib.php";
QRcode::png('http://140.123.175.103:8888/project_demo/alpha.php?ID='.$_GET['ID']);
?>
