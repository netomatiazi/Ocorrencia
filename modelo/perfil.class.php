<?php
	class perfil
	{
		private $id;
		private $linkn;
		private $descritivo;
		private $menu;
		
		
		function __construct($id="", $linkn="", $descritivo="", $menu="")
		{
			$this->id = $id;
			$this->linkn = $linkn;
			$this->descritivo = $descritivo;
			$this->menu = $menu;			
		}
		function getId()
		{
			return $this->id;
		}
		function getLinkn()
		{
			return $this->linkn;
		}
		function getDescritivo()
		{
			return $this->descritivo;
		}
		function getMenu()
		{
			return $this->menu;
		}
		function setMenu($menu)
		{
			$this->menu= $menu;
		}
	}//class
?>