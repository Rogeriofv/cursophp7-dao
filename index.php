<?php 

require_once("config.php");

/*
$sql = new Sql();
$usuarios = $sql->select("SELECT * from tb_usuarios");
echo json_encode($usuarios);
*/

//Carrega um único usuário
//$root = new Usuario();
//$root->loadById(3); 
//echo $root;

//Carrega uma lista de usuários
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuários buscando pelo login
//$search = Usuario::search("mar");
//echo json_encode($search);

//Carrega um usuário usando o login e a senha
$usuario = new Usuario();
$usuario->login("Maria", "mariamaria");
echo $usuario;

?>