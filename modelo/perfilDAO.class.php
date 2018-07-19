<?php
	class perfilDAO extends conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		//buscar Permissões
		
		function buscarPermissoes($perfil)
		{
			$sql = "SELECT m.descritivo, m.link 
					FROM menu m
					INNER JOIN perfilmenu pm ON (m.idmenu = pm.idmenu)
					INNER JOIN perfil p ON (p.idperfil = pm.idperfil)
					WHERE m.idmenu = pm.idmenu AND p.idperfil = ?
				   ";
			try
			{
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(1, $perfil->getId());
				$ret = $stmt->execute();
				$this->db = null;
				if(!$ret)
				{
					die("Erro ao buscar o perfil do usuário");
				}
				else
				{
					$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
					return $resultado;
				}
			}
			catch (PDOException $e)
			{
				die ($e->getMessage());
			}
			
		}
		
		//buscar Perfil		
	
		public function buscarTodas()
		{
			$sql = "SELECT * FROM perfil";
			
			try
			{
				//prepra a frase sql para ser executada
				
				$f = $this->db->prepare($sql);
				
				// Executa a frase no banco
				
				$ret = $f->execute();
				
				if(!$ret)
				{
					die("Erro ao buscar perfís");
				}
				else
				{
					return $retorno = $f->fetchAll(PDO::FETCH_OBJ);
				}
			}	
			catch(Exception $e)
			{
				die($e->getMessage());
			}			
		}
	}
?>