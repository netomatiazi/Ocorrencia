<?php
	/**
	 * Aчѕes de banco de dados (acesso, validaчуo, etc.)
	 * @autor Original: Janson Lengstorf
	 * @livro:Pro PHP e jQuery
	 * @arquivo modificado
	*/
	abstract class conexao {
		protected $db;
		
		protected function __construct()
		{
			$dsn="mysql:host=localhost;dbname=si2018p06;charset=utf8mb4";		
			try
			{
				$this->db = new PDO($dsn, "root", "");				
			}
			catch ( Exception $e )
			{
				die ($e->getMessage());
			}
		}
	}
?>