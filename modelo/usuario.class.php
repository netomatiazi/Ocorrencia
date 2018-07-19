<?php
	class usuario
	{
		private $idusuario;
		private $perfil;
		private $status;
		private $nome;
		private $email;
		private $senha;		
		
		public function __construct($idusuario="", $perfil="", $status="", $nome="", $email="", $senha="")
		{
			$this->idusuario = $idusuario;
			$this->perfil = $perfil;
			$this->status = $status;
			$this->nome = $nome;
			$this->email = $email;
			$this->senha = $senha;
			
		}//construct
		
		public function getId()
		{
			return $this->idusuario;
		}
		public function getPerfil()
		{
			return $this->perfil;
		}
		public function getStatus()
		{
			return $this->status;
		}
		public function getNome()
		{
			return $this->nome;
		}

		public function getEmail()
		{
			return $this->email;
		}
		
		public function getSenha()
		{
			return $this->senha;
		}
		
		
		
		//set 
		
		/*public function setId($id)
		{
			$this->id = $id;
		}
		public function setStatus($status)
		{
			$this->status = $status;
		}
		public function setNome($nome)
		{
			$this->nome = $nome;
		}
		public function setEmail($email)
		{
			$this->email = $email;
		}
		public function setSenha($senha)
		{
			$this->senha = $senha;
		}
		*/
		public function setPerfil($perfil)
		{
			$this->perfil = $perfil;
		}		
	}//class
?>