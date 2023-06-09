<?php
$password = 'admin';
$Hashpassword = hash('sha256',$password);
echo $Hashpassword;
?>