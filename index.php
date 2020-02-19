<?php

require_once("config.php");

$sql = new Sql();

$segurados = $sql->select("select * from segurado");

echo json_encode($segurados)."<br><br><br>";
var_dump($segurados);

?>