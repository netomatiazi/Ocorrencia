<?php
	class ocorrenciaDAO extends conexao
	{
		function __construct()
		{
			parent:: __construct();
		}

		function graficos()
		{

			$sql="SELECT bairro.descricao, subcategoria.tipo , COUNT(ocorrencias.idsubcategoria) 'vezes'
                    FROM ocorrencias
                    INNER JOIN subcategoria ON (ocorrencias.idsubcategoria=subcategoria.idsubcategoria)
                    INNER JOIN bairro ON (ocorrencias.idbairro = bairro.idbairro)               
                    GROUP BY subcategoria.idsubcategoria";  
                  				  
			try
				{
					$f = $this->db->prepare($sql);
					$ret=$f->execute();
					$this->db = null;
					if(!$ret)
					{
						echo "Erro ao Buscar Dados para o Gráfico de Pizza";
					}
					else
					{
						$resultado = $f->fetchAll(PDO::FETCH_OBJ);
						return $resultado;
					}
				}
				catch ( Exception $e )
				{
					die ($e->getMessage());
				}

		}//fim do gr�fico Pizza

		function mapaOcorrencia()
		{
			$sql = "SELECT ocorrencias.*,categoria.descritivo, categoria.icone, subcategoria.tipo , bairro.descricao
                    FROM ocorrencias, subcategoria, categoria, bairro 
                    WHERE ocorrencias.idsubcategoria = subcategoria.idsubcategoria 
                    AND subcategoria.idcategoria = categoria.idcategoria
                    AND ocorrencias.idbairro = bairro.idbairro
                    AND ocorrencias.datao BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE();";
           	try
			{
				$stmt = $this->db->prepare($sql);
				$ret = $stmt->execute();
				$this->db = null;
				if(!$ret)
				{
					die("Erro ao buscar ocorrencias no mapa");
				}
				else
				{
					$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
					return $resultado;
                    //echo"<pre>";
                    //var_dump($resultado);
                    //echo"</pre>";
				}
			}
			catch (PDOException $e)
			{
				die( $e->getMessage());
			}
		}//Ocorrencia Mapa
        
                
		function carregaCategoria()
		{
			$sql = "SELECT * FROM categoria";
			try
			{
				$stmt = $this->db->prepare($sql);
				$ret = $stmt->execute();
				$this->db = null;
				if(!$ret)
				{
					die("Erro ao buscar Categoria");
				}
				else
				{
					$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
					return $resultado;
				}
			}
			catch (PDOException $e)
			{
				die( $e->getMessage());
			}
		}//buscarCategorias

		function carregaSubcategoria()
		{
			$sql = "SELECT s.idsubcategoria, s.tipo
			FROM subcategoria s
			INNER JOIN categoria c ON (s.idcategoria = c.idcategoria)
			WHERE s.idcategoria = ?";
			try
			{
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(1, $categoria->getId());
				$ret = $stmt->execute();
				$this->db = null;
				if(!$ret)
				{
					die("Erro ao buscar um aluno");
				}
				else
				{
					$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
					return $resultado;
				}
			}
			catch (PDOException $e)
			{
				die( $e->getMessage());
			}
		}//buscarTodos
        
        
		public function inserir( $ocorrencia )
		{
			var_dump($ocorrencia);
            $sql = "INSERT INTO ocorrencias (idsubcategoria, idbairro, datao, logradouro, numero, latitude, longitude, anexo) VALUE (?, ?, ?, ?, ?, ?, ?, ?)";            
			try
			{
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(1, $ocorrencia->getSubcategoria());	
                $stmt->bindValue(2, $ocorrencia->getBairro());
				$stmt->bindValue(3, $ocorrencia->getData());
				$stmt->bindValue(4, $ocorrencia->getLogradouro());
				$stmt->bindValue(5, $ocorrencia->getNumero());						
				$stmt->bindValue(6, $ocorrencia->getLatitude());
				$stmt->bindValue(7, $ocorrencia->getLongitude());
                $stmt->bindValue(8, $ocorrencia->getAnexo());                
				$ret = $stmt->execute();
				$this->db = null;
				if(!$ret)
				{
					die("Erro ao inserir Ocorrencia");
				}
                else 
                {
                    echo"<script> alert('Ocorrencia inserida com sucesso')</script>";                   
                }
			}
			catch (PDOException $e)
			{
				die ($e->getMessage());
			}            
		}
		


  // alteracao leandro
	function ajax($categoria){
		$sql = "SELECT s.idsubcategoria, tipo FROM subcategoria s WHERE s.idcategoria= ?  ORDER BY tipo";
	try
	{
		$f = $this->db->prepare($sql);
		$f->bindValue(1, $categoria);
		$ret = $f->execute();
		$this->db = null;
		if(!$ret)
		{
			die("Erro ao validar usuario/senha");
		}
		else
		{

			$retorno = $f->fetchAll(PDO::FETCH_OBJ);

			foreach($retorno as $ocorrencia)
			{
				echo"<option value={$ocorrencia->idsubcategoria}>".($ocorrencia->tipo)."</option>";
			}


			//echo( json_encode( $ocorrencia ) );

		}
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}

	}
        
        function CarregarCategoria($ocorrencia)
		{
			$sql = "SELECT * FROM
                    ocorrencias, subcategoria, categoria WHERE
                    ocorrencias.idsubcategoria = subcategoria.idsubcategoria AND
                    subcategoria.idcategoria = categoria.idcategoria AND 
                    subcategoria.idcategoria = categoria.idcategoria AND 
                    ocorrencias.datao BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND
                    categoria.idcategoria =?" ;
			try
			{
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(1, $ocorrencia->getId());
				$ret = $stmt->execute();
				$this->db = null;
				if(!$ret)
				{
					die("Erro ao carregar ocorrência");
				}
				else
				{
					$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
					return $resultado;
				}
			}
			catch (PDOException $e)
			{
				die( $e->getMessage());
			}
		}//buscarUm
		function carregaForm()
		{
			$sql = "SELECT * FROM categoria";
			try
			{
				$stmt = $this->db->prepare($sql);
				$ret = $stmt->execute();
				$this->db = null;
				if(!$ret)
				{
					die("Erro ao buscar Categoria");
				}
				else
				{
					$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
					return $resultado;
				}
			}
			catch (PDOException $e)
			{
				die( $e->getMessage());
			}
		}//
        
        function carregaBairro()
		{
			$sql = "SELECT * FROM bairro";
			try
			{
				$stmt = $this->db->prepare($sql);
				$ret = $stmt->execute();
				$this->db = null;
				if(!$ret)
				{
					die("Erro ao buscar Bairro");
				}
				else
				{
					$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
					return $resultado;
				}
			}
			catch (PDOException $e)
			{
				die( $e->getMessage());
			}
		}

	}//fim da classe
?>
