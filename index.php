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
//$usuario = new Usuario();
//$usuario->login("aluno", "@lun0");
//echo $usuario

//Insere usuário
//$aluno = new Usuario();
//$aluno->setDeslogin("aluno");
//$aluno->setDessenha("@lun0");
//$aluno->insert();
//echo $aluno;

//Update de um registro
$usuario = new Usuario();
$usuario->loadById(25);
$usuario->update("professor", "prof01");
echo $usuario;

?>