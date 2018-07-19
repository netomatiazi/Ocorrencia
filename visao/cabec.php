<!-- Cabeçalho-->
	
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">

	   <div class="navbar-header">
		   <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#elementoCollapse1">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>						                    
	   </div>
		<div class="collapse navbar-collapse" id="elementoCollapse1">                    
		   <ul class="nav navbar-nav">
			  <?php							  
				require_once "controle/funcao.php";
				if(!isset($_SESSION))
				{										
					session_start();
				}									
				if(isset($_SESSION["perfil"]))
				{															
						foreach($_SESSION["menu"] as $dado)
						{
                            echo "<li><a href='index.php?controle=main&metodo=painel' class='navbar-brand'><strong>Início</strong></a></li>";
							echo"<li><a href='{$dado->link}'><strong>".utf8_encode($dado->descritivo)."</strong></a></li>";
						}						
						echo "<li><a href='index.php?controle=main&metodo=sair'> <i class='fa fa-sign-out' aria-hidden='true'></i> <strong>Sair</strong></a></li>";						
				}
				else
				{	
                    echo "<li><a href='index.php?controle=inicio&metodo=painel' class='navbar-brand'><strong>Início</strong></a></li>";
					echo "<li><a href='index.php?controle=main&metodo=denunciar'><strong>Denunciar</strong></a></li>";	
					echo "<li><a href='index.php?controle=main&metodo=logar'> <i class='fa fa-sign-in' aria-hidden='true'></i> <strong>Entrar</strong></a></li>";
									
				}		
			?>                      
		   </ul>   	   				   
		</div><!-- /.collapse -->   
	</div>  <!-- /.container-fluid --> 				
</nav>  <!-- /.navbar--> 
				
			