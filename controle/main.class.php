<?php
	include_once "funcao.php";
	class main
	{
        function inicio(){
            require_once "visao/menu.php";
        }
		function login()
		{
			require_once "visao/menu.php";
		}
		function sair()
		{

			require_once "visao/sair.php";
		}
		function denunciar()
		{

			$ocorrenciaDAO = new ocorrenciaDAO();
			$retorno = $ocorrenciaDAO->carregaCategoria();
            $ocorrenciaDAO = new ocorrenciaDAO();
            $return = $ocorrenciaDAO->carregaBairro();
			//var_dump($retorno);
			require_once "visao/denuncia.php";            
			if($_POST)
			{
				$erro=0;
				$caminho_imagem="";
				if($_POST["data"]=="")
				{
					echo"<script>alert('Preencha a data da ocorrência')</script>";
					$erro++;
				}
				if($_POST["categoria"]==0)
				{
					echo"<script>alert('Digite uma categoria')</script>";
					$erro++;
				}
				if($_POST["ocorrencia"]==0)
				{
					echo"<script>alert('Escolha ao uma ocorrência')</script>";
					$erro++;
				}
				if($_POST["logradouro"]=="")
				{
					echo"<script>alert('Digite o endereço do local')</script>";
					$erro++;
				}
				if($_POST["numero"]=="")
				{
					echo"<script>alert('Digite o número da rua')</script>";
					$erro++;
				}
				if($_POST["bairro"]==0)
				{
					echo"<script>alert('Digite o Bairro')</script>";
					$erro++;
				}
				// upload foto
			   
				if(!empty($_FILES["anexo"]["name"])) {
					$foto = $_FILES["anexo"];
					 preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
					 $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
					 $caminho_imagem = "anexo/" . $nome_imagem;
					 move_uploaded_file($foto["tmp_name"], $caminho_imagem);            
				}				
				if($erro==0)
				{
					//inserir no banco			
					$ocorrencia = new ocorrencia(null, $_POST["ocorrencia"], $_POST["bairro"], $_POST["data"], $_POST["logradouro"], $_POST["numero"], $_POST["latitude"], $_POST["longitude"], $caminho_imagem);
					$ocorrenciaDAO = new ocorrenciaDAO();
					$ret =$ocorrenciaDAO->inserir($ocorrencia);  
					echo"<script>window.location.href='index.php?controle=main&metodo=buscarOcorrencia'</script>";
                   
				}
				else
				{
					echo"<script>alert('Erro ao inserir Denuncia')</script>";
				}


			}

		}
		function logar()
		{
            
			$erro=0;
			if($_POST)               
			{                    
				if($_POST["email"]=="")
				{
					echo"<script>alert('Preencha seu e-Mail')</script>";
					$erro++;
				}
				if($_POST["senha"]=="")
				{
					echo"<script>alert('Preencha sua senha')</script>";
					$erro++;
				}
				if($erro==0)
				{
					$email= $_POST["email"];
					$senha= $_POST["senha"];
					$usuario = new usuario(null, null, null, null, $email, $senha);
					$usuarioDAO = new usuarioDAO();
					$ret = $usuarioDAO->login($usuario);
					if(count($ret) > 0)
					{
						//se for identificado
						session_start();
						$_SESSION["perfil"] = $ret[0]->idperfil;
						$_SESSION["id"] = $ret[0]->idusuario;

						// buscar as permissões de acordo com o acesso
						$perfil = new perfil($ret[0]->idperfil);
						$perfilDAO = new perfilDAO();
						$retorno = $perfilDAO->buscarPermissoes($perfil);
						$_SESSION["menu"]= $retorno;                        
						echo"<script>window.location.href='index.php?controle=main&metodo=painel'</script>";
                        //header("Location: index.php");
					}
					else
					{
						echo "<script>alert('email/senha não conferem')</script>";
					}
				}
                // finaliza o post
                exit();
			}
            
            require_once "visao/login.php";
		}		

		function buscarCategorias(){
			$ocorrenciaDAO = new ocorrenciaDAO();
			$retorno = $ocorrenciaDAO->carregaCategoria();
			require_once "visao/denuncia.php";
		}

		function buscarSubcategorias(){
			$ocorrenciaDAO = new ocorrenciaDAO();
			$retorno = $ocorrenciaDAO->carregaSubcategoria();
			require_once "visao/denuncia.php";
		}
		function buscarOcorrencia()
		{
			$ocorrenciaDAO = new ocorrenciaDAO();
			$retorno = $ocorrenciaDAO->mapaOcorrencia();
			//var_dump($retorno);
			require_once "visao/menu.php";
		}
        function Painel()
		{
			$ocorrenciaDAO = new ocorrenciaDAO();
			$retorno = $ocorrenciaDAO->mapaOcorrencia();
			//var_dump($retorno);
			require_once "visao/painel.php";
		}
        function paineListar()
		{
			$ocorrenciaDAO = new ocorrenciaDAO();
			$retorno = $ocorrenciaDAO->mapaOcorrencia();
			//var_dump($retorno);
			require_once "visao/listaOcorrencia.php";
		}

		function ajax(){

			// verificação se tem o post ou não
			$pegaCategoria = $_POST['categoria'];

			$ocorrenciaDAO = new ocorrenciaDAO();
			$retorno = $ocorrenciaDAO->ajax($pegaCategoria);
		}        
        function categoria()
		{
            $id="";
			if($_GET)
			{
				$id = $_GET["id"];
				$ocorrencia = new ocorrencia($id);
                $ocorrenciaDAO = new ocorrenciaDAO();
                $retorno = $ocorrenciaDAO->carregarCategoria($ocorrencia);
                //var_dump($retorno);
                require_once "visao/painel.php";
            }
		}

		function graficoCategoriaBairro()
		{		
			//buscar os dados no modelo
			$ocorrenciaDAO = new ocorrenciaDAO();
			$retorno = $ocorrenciaDAO->graficos();
			// chama a visão para gerar o pdf
			require_once "visao/grafico_pizza.php";
		}	
		//gerar gráfico      
	}
?>
