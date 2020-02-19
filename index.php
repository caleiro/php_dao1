<?php

require_once("config.php");

/*$sql = new Sql();
$segurados = $sql->select("select * from segurado");
echo json_encode($segurados)."<br><br><br>";
var_dump($segurados);*/

//carrega um usuário
/*$root = new Segurado();
$root->loadById(2);
echo $root;*/

//carrega uma lista de usuários
/*$lista = Segurado::getList();
echo json_encode($lista)."<br><br>";
echo var_dump($lista);*/

//carrega uma lista de usuários com um dados nome...
/*$lista = Segurado::search("Jor");
echo json_encode($lista)."<br><br>";
echo var_dump($lista);*/

//Login um usuário
$usuario = new Segurado();
$usuario->login(2,"1234678");

echo $usuario;

?>