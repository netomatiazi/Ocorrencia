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
                        <form method="POST" action="#" >	
                        <div class="panel panel-default">
                            <div class="panel-heading"><strong>Lista de Ocorrências</strong></div>
                            <div class="panel-body"> 		  
                                <div class="table-responsive " >
                                    <table  class="table table-striped table-bordered table-default table-hover  tablesorter" cellspacing="0" summary="Tabela de Categorias" id="tabcat">
                                        <thead>
                                            <tr class="active">											
                                                 <th>Ocorrência</th>
                                                 <th>Data</th>
                                                 <th>Logradouro</th>
                                                 <th>Nº</th>                                    
                                                 <th>Bairro</th>
                                                 <th>Imagem</th>
                                            </tr>                        
                                        </thead>
                                        <tbody>
                                              <?php
                                                // mostrar registro em forma de tabela
                                                foreach($retorno as $dado)
                                                {/*
                                                if($dado->status_user == 1)
                                                {
                                                    $status1 = "Ativo";
                                                }
                                                else
                                                {
                                                    $status1 = "Inativo";
                                                }*/                                                   
                                                    echo"<tr><td>".$dado->tipo."</td><td>{$dado->datao}</td><td>".$dado->logradouro."</td><td>{$dado->numero}</td><td>".$dado->descricao."</td><td><img src='{$dado->anexo}' style='width:150px; height:80px;'/></td>";																		
                                                }			
                                              ?>
                                        </tbody> 
                                    </table>                                    
                                </div>
                            </div>				
                        </div>
                    </form>
                </div> 
             </div>
        </div>  <br/>           
               <footer id="menuFooter" style="clearfix:500px;">
                <?php
                    include "footer.html";
                ?>
                 </footer>
             
    <script type="text/javascript" src="lib/jquery-latest.js"></script>
    <script type="text/javascript" src="lib/jquery.quicksearch.js"></script>
	<script type="text/javascript" src="lib/jquery.tablesorter.js"></script>	
	<script type="text/javascript" id="js">
	$(document).ready(function()
	{ 
    	// extend the default setting to always include the zebra widget. 
	    $.tablesorter.defaults.widgets = ['zebra']; 
	    // extend the default setting to always sort on the first column 
	    $.tablesorter.defaults.sortList = [[0,0]]; 
	    // call the tablesorter plugin 
	    $("table").tablesorter(); 
		$("#tabcat tbody tr").quicksearch({
            labelText: 'Pesquisar: ',
            attached: '#tabcat',
            position: 'before',
            delay: 100,
            loaderText: 'Loading...',
            onAfter: function() {
                if ($("#tabcat tbody tr:visible").length != 0) {
                    $("#tabcat").trigger("update");
                    $("#tabcat").trigger("appendCache");
                    $("#tabcat tfoot tr").hide();
                }
                
            }
        });
	});
  </script>  
               
    </body>
</html>