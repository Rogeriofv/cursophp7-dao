<?php 

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario() {
		return $this->idusuario;
	}
	
	public function setIdusuario($value) {
		$this->idusuario = $value;
	}

	public function getDeslogin () {
		return $this->deslogin;
	}
	
	public function setDeslogin($value) {
		$this->deslogin = $value;
	}

	public function getDessenha() {
		return $this->dessenha;
	}
	
	public function setDessenha($value) {
		$this->dessenha = $value;
	}

	public function getDtcadastro() {
		return $this->dtcadastro;
	}
	
	public function setDtcadastro($value) {
		$this->dtcadastro = $value;
	}

	public function loadById($id) {

		$sql = new Sql();
		$results = $sql->select("SELECT * from tb_usuarios where idusuario = :ID", array(":ID"=>$id));

		if (count($results) > 0) {
			$this->setData($results[0]);
		}
	}

	public static function getList() {

		$sql = new Sql();
		return $sql->select("SELECT * from tb_usuarios order by deslogin");
	}

	public static function search($login) {

		$sql = new Sql();
		return $sql->select("SELECT * from tb_usuarios where deslogin like :SEARCH order by deslogin", array(
			':SEARCH'=>"%".$login."%"
		));
	}

	public function login($login, $password) {

		$sql = new Sql();
		$results = $sql->select("SELECT * from tb_usuarios where deslogin = :LOGIN and dessenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));

		if (count($results) > 0) {
			$this->setData($results[0]);
		} 
		else {
			throw new Exception("Login e/ou senha inválidos.");
		}
	}

	public function setData($data) {
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}

	public function insert() {
		$sql = new Sql();

		//O CALL é o modo de chamada de uma procedure no MySQL!! No SQLServer seria EXECUTE
		//Para torná-lo dinâmico, poderia criar o método na classe Sql só para execução de procedures
		//E lá usaria um SWITCH para identificar o banco e usar o comando correto.
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));

		if (count($results) > 0) {
			$this->setData($results[0]);			
		}
	}

	public function update($login, $password) {
		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios set deslogin = :LOGIN, desenha = :PASSWORD where idusuario = :ID)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()
		));
	}

	public function delete() {
		$sql = new Sql();
		$sql->query("DELETE FROM tb_usuarios where idusuario = :ID", array(
			':ID'=>$this->getIdusuario()
		));

		//Limpando os atributos do objeto
		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
		
	}

	public function __toString() {

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}
}

?>