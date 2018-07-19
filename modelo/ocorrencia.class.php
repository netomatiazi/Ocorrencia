<?php
	class ocorrencia
	{
		private $idocorrencia;
        private $subcategoria;
        private $bairro;
		private $data;		
		private $logradouro;
		private $numero;				
		private $latitude;
		private $longitude;		
        private $anexo;
      
		function  __construct($idocorrencia="", $subcategoria = "",$bairro="", $data="", $logradouro="", $numero="", $latitude="", $longitude = "", $anexo = "")
		{
			$this->idocorrencia = $idocorrencia;
            $this->subcategoria = $subcategoria;
            $this->bairro = $bairro;
			$this->data = $data;			
			$this->logradouro = $logradouro;
			$this->numero = $numero;		
			$this->latitude = $latitude;
			$this->longitude = $longitude;
			$this->anexo = $anexo;			
			
		}
		function getId()
		{
			return $this->idocorrencia;
		}
        function getSubcategoria()
		{
			return $this->subcategoria;
		}
        function getBairro()
		{
			return $this->bairro;
		}
		function getData()
		{
			return $this->data;
		}		
		function getLogradouro()
		{
			return $this->logradouro;
		}
		function getNumero()
		{
			return $this->numero;
		}				
		function getLatitude()
		{
			return $this->latitude;
		}
		function getLongitude()
		{
			return $this->longitude;
		}
		function getAnexo()
		{
			return $this->anexo;
		}        
		function setSubcategoria($subcategoria)
		{
			$this->subcategoria = $subcategoria;
		}
        function setBairro($bairro)
		{
			$this->bairro = $bairro;
		}
		
	}//classe
?>