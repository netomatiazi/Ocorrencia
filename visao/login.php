<?php
	require_once 'controle/funcao.php';		
?>
<!doctype html>
<html lang="pt-BR">
	<head>		
		<meta name="description" content="login"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>	
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta charset="UTF-8"/>
		<title>Login</title>
		<link rel="stylesheet" href="estilo/bootstrap.css">
		<link rel="stylesheet" href="estilo/estilo.css">	
		<link  type="text/css" rel="stylesheet" href="estilo/font-awesome/css/font-awesome.min.css">	
	</head>
	<body >
		<article class="container-fluid">
			<section class="row-fluid" >	
				<div class="col-xs-12">
					<header>
						<?php
						include"cabec.php";
						?>
					</header>						
					<form action="#" method="POST" border="1"  class="form" id="login">
						<div class="panel panel-default">
							<div class="panel-heading"><strong>Página de login</strong></div>
							<div class="panel-body">									
								<div class="col-md-3 col-xs-4">					
										<label for="email">e-Mail:</label>													
								</div>	
								<div class="col-md-9 col-xs-8" >					
										<input class="form-control" type="text" name="email" id="email" required><br/>					    					
								</div>										
								<div class="col-md-3 col-xs-4">					
										<label for="senha">Senha:</label>													
								</div>	
								<div class="col-md-9 col-xs-8" >					
										<input class="form-control" type="password" name="senha" id="senha" required><br/>				    					
								</div>								
								<br/>								
								<br/>								
								<a href="#" ><input type="submit" value=" Login" role="button" class="btn btn-success  enviar" id="salvar"/></a>
								<a href="index.php?" ><input type="cancel" value="Cancelar" role="button" class="btn btn-default enviar" /></a>
							</div>
						</div>				
					</form>					
				</div>	
			</section>
		</article>		
		<footer id="loginFooter">
			<?php
			include"footer.html";
			?>
		</footer>
		<script type="text/javascript" src="lib/jquery-latest.js"></script>
		<script type="text/javascript" src="lib/jquery.validate.js"></script>
		<script type="text/javascript">
			$(function(){
			//executa quando clicar no botão Enviar
				$("#salvar").click(function(){
					//validar o formulário
					$("#login").validate({
						 rules : {									 
									 email:{
											required:true
									 },
									 senha:{
											required:true
											
									 }                                
							   },
							   messages:{								     
									 email:{
											required:"Informe o e-Mail cadastrado"
									 },
									 senha:{
											required:"Digite uma senha cadastrada"
											
									 }    
							   }	
					});
					});
			});
		</script>
	</body>
</html>
