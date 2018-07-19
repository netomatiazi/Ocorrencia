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
                            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsTfnLRmo3HOQqSuSXF59ruwqS9-Xe_0M"></script>
                            <div id="mapa" style="widht: 100%; height:469px; margin:5% 0 -4% 0"></div> <!-- Criar div com tamanho definido para aparecer o mapa-->
                        <script>
                            google.maps.event.addDomListener(window, 'load', carrega_mapa); <!-- quando carregar a página "load" dispara a função carrega_mapa-->

                            <!-- Pega o retorno que é um array php e transforma em javascript-->
                            var ocorrencias = <?php echo json_encode($retorno, true);?>; //JSON_UNESCAPED_UNICODE					
                            <!-- cria o mapa-->
                            function carrega_mapa()
                            {
                                var mapa =new google.maps.Map(document.getElementById('mapa'),{ 
                                zoom:14,					
                                center:{lat:-22.3766677,lng:-48.4013611}
                                });					
                                mostrar_pontos(mapa); 
                            }
                            function mostrar_pontos(mapa)
                            {
								
                                for(var x=0; x<ocorrencias.length;x++)
                                {
								        var marca = new google.maps.Marker({ <!-- cria uma marca para cada elemento json -->
                                        position: {lat: parseFloat(ocorrencias[x].latitude), 
                                        lng: parseFloat(ocorrencias[x].longitude)}, <!-- parseFloat pq o elemento é varchar no banco-->
                                        map: mapa,
                                        title: ocorrencias[x].logradouro + ocorrencias[x].numero,
										icon: ocorrencias[x].icone
                                    });		
                                    var info = new google.maps.InfoWindow();

                                      google.maps.event.addListener(marca, 'click', (function(marca,x) {
                                      return function()
                                      {
                                      info.setContent("<b>Ocorrência: "+ocorrencias[x].tipo +"</b>"+"<br/>"+"<br/>"+"<img id='imgInfo' src='"+ocorrencias[x].anexo+"'"+"/> </b>'");
                                        info.open(mapa,marca);
                                      }
                                      })(marca,x));	               
                                }//for
                            }//function
                        </script><br/><br/> <br/>
                        <br/><br/> <br/> 
                    </section>                   					
                </div>        
            </div>            
        </div>         
           <footer id="menuFooter">
			<?php
				include "footer.html";
			?>
        </div>            
    </body>
</html>