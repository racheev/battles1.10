<?php

$uploaddir = ''.$_SERVER["DOCUMENT_ROOT"].'/images/battles/';
$uploadfile = $uploaddir.basename($_FILES['myfile']['name']);
move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile)
?>