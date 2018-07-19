<!DOCTYPE html>
<html>
    <head>
        <title>Painel Administrativo</title>
        
        <!-- define a view port-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">       
       <link rel="stylesheet" href="estilo/bootstrap.min.css">
		<link rel="stylesheet" href="estilo/estilo.css">
		<link  type="text/css" rel="stylesheet" href="estilo/font-awesome/css/font-awesome.min.css">
		<script type="text/javascript" src="lib/jquery.js"></script>
		<script type="text/javascript" src="lib/bootstrap.js"></script>			
    </head>    
    <body>  
            <div class="container-fluid" style="margin-top:5%;">
            <div class="row-fluid"> 
               <header>
                    <?php
                        include "cabec.php";
                    ?>
                </header>                              
                <div class="col-sm-3">
                   <!-- Menu lateral-->
                        <?php
                        include "menuLateral.php";
                    ?>
                   <!-- //Menu lateral-->
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-9">                 				
                    <section style="margin:-5% 0 0 0;">
                       <?php
                            require_once ('../visao/main.class.php');
                            echo "<h1>Escola Modelo</h1>";
                            echo "<article>";
                            echo "<img src='grafico_colunas.php'/>";
                            echo "</article>";
                        ?>
                    </section>                   					
                </div>        
            </div>            
        </div>                 
           <footer id="menuFooter">
			<?php
				include "footer.html";
			?>
        </footer>
               
    </body>
</html>