<!doctype html>
<html lang="pt-BR">
	<head>
		<meta name="description" content="Denúncia"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta charset="UTF-8"/>
		<title>Denúncia</title>
		<!-- Include Twitter Bootstrap and jQuery: -->
		<link rel="stylesheet" href="estilo/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="estilo/estilo.css">
		<link  type="text/css" rel="stylesheet" href="estilo/font-awesome/css/font-awesome.min.css">
		<script type="text/javascript" src="lib/jquery.js"></script>
		<script type="text/javascript" src="lib/bootstrap.js"></script>

	</head>
	<body >
		<article class="container-fluid">
			<section class="row-fluid"  >
				<div class="col-xs-12">
					<header>
						<?php
							include "cabec.php";
						?>
					</header>
					<form action="#" method="POST" border="1"  class="form" id="cadastro_ocorrencia" enctype="multipart/form-data">
						<div class="panel panel-default">
							<div class="panel-heading"><strong>Cadastrar Ocorrência</strong></div>
							<div class="panel-body">
								<div class="col-md-2 col-xs-4">
									  <label for="data">Data:</label>
								</div>
								<div class="col-md-10 col-xs-8" >
									 <input type="date" class="form-control" name="data" id="data"><br>
								</div>
								<div class="col-md-2 col-xs-4">
									  <label for="categoria">Categoria</label>
								</div>
								<div class="col-md-10 col-xs-8" >
									<select name="categoria" id="categoria" class="form-control">
									<option value="0" >Selecione</option>
										<?php
											foreach($retorno as $categoria)
											{
												echo"<option value={$categoria->idcategoria}>".$categoria->descritivo."</option>";
											}
										?>
									</select><br/>
								</div>								
								<div class="col-md-2 col-xs-4">
									  <label for="ocorrencia" class="ocorrencia">Ocorrência</label>
								</div>
								<div class="col-md-10 col-xs-8" >
									<select name="ocorrencia" class="form-control ocorrencia">
										<option value=""></option>
									</select><br>
								</div>
								<div class="col-md-2 col-xs-4">
									<label for="anexo">Anexo:</label>
								</div>
								<div class="col-md-4 col-xs-8">
									 <a href="#meuModal2" class="btn btn-default" role="button" data-toggle="modal" data-target="#exampleModal" aria-hidden="true" id="anexo"><i class="fa fa-file-image-o" aria-hidden="true"></i> Anexar imagem do local</a>	<p>
								</div>
								<!-- Modal -->
										<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										  <div class="modal-dialog" role="document">
											<div class="modal-content">
											  <div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Envie uma imagem do local</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span>
												</button>
											  </div>
											  <div class="modal-body">
												<!--<form action="/action_page.php">-->
													<label >  Envie a imagem</label>
                                                      <div class="custom-file">
                                                          <input type="file" name="anexo" accept=".jpg, .jpeg, .png" class="custom-file-input"/><br>
                                                          <span class="custom-file-control"></span>
                                                      </div>
												 
												<!--</form>-->
											  </div>
											  <div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
												<!--<button type="button" class="btn btn-default">confirma</button>-->
											  </div>
											</div>
										  </div>
										</div>
								<div class="col-md-2 col-xs-4">
									  <label for="endereco">Mapa:</label>
								</div>
								<div class="col-md-4 col-xs-8">
									  <a href="#meuModal" class="btn btn-default" role="button" data-toggle="modal" data-target="#myModal" aria-hidden="true"><i class="fa fa-map-marker fa-1x" > Indicar a posição no mapa</i></a><p>
								</div>
								<div class="col-xs-12">
									<!-- Modal -->
									<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
										  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Escolha o local da ocorrência no mapa</h4>
										  </div>
										  <div class="modal-body">
                                            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsTfnLRmo3HOQqSuSXF59ruwqS9-Xe_0M"></script>
										<article>
											<div id="mapa" style="height:300px;"></div> <!-- Criar div com tamanho definido para aparecer o mapa-->
											<script>
												var marca = null;
												google.maps.event.addDomListener(window, 'load', carrega_mapa); <!-- quando carregar a página "load" dispara a função carrega_mapa-->
												  function carrega_mapa() {
												  var geocoder = new google.maps.Geocoder; // usado para converter latitude em endereço
												  var escola = { lat: -22.3769058, lng: -48.399902 };
												  var mapa = new google.maps.Map(document.getElementById('mapa'), {
												  zoom: 13,
												  center: escola
												  });
												  google.maps.event.addListener(mapa, 'click', function(event) {
													// Separar latitude e longetude
													var latlong = event.latLng;
													latlong = latlong.toString(); // transforma em string
													var tam = latlong.length -1;
													latlong = latlong.substring(1, tam);
													latlong = latlong.split(", ")
													document.getElementById("lat").value =latlong[0];
													document.getElementById("lon").value =latlong[1];
													//alert(latlong);

													//pegar o endereço a partir da latitude e longetude

													var latlng = {lat:parseFloat(latlong[0]), lng:parseFloat(latlong[1])}
													geocoder.geocode({'location':latlng}, function(results, status){
														alert(results[0].formatted_address);

													var results = results[0].formatted_address.toString(); // transforma em string
													results = results.split(", ");
													document.getElementById("logr").value =results[0];
													document.getElementById("num").value =results[1];
													var resultado=results[1].split("-");
													//document.getElementById("bairro").value=resultado[1];
													document.getElementById("cidade").value =results[2].split("-",1);

													});
													if (marca != null)
													{
														marca.setMap(null);
													}
													adicionaMarca(event.latLng, mapa);

												  });
												}
												function adicionaMarca(local, mapa) {

												   marca = new google.maps.Marker({
													position: local,
													map: mapa
												  });
												}
											</script>
                                            </article>										 
										  <div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

										  </div>
										</div>
									  </div>
									</div>
								</div>
                                </div>
							   <div class="col-md-2 col-xs-4">
									<label>Logradouro:</label>
								</div>
								<div class="col-md-6 col-xs-8">
									<input type="text" id = "logr" name="logradouro" class="form-control"/><br>
								</div>
								<div class="col-md-2 col-xs-4">
									<label>nº:</label>
								</div>
								<div class="col-md-2 col-xs-8">
									<input type="text" id = "num" name="numero" class="form-control" /><br>
								</div>
								<div class="col-md-2 col-xs-4">
									<label>Bairro:</label>
								</div>
								<div class="col-md-10 col-xs-8">
									<select name="bairro" id="bairro" class="form-control" overflow>
									<option value="0" >Selecione</option>
										<?php                                        
											foreach($return as $bairro)
											{
												echo"<option value={$bairro->idbairro}>".$bairro->descricao."</option>";
											}
										?>
									</select><br/>
								</div>
								<div>								 
								 <div class="col-md-2 col-xs-4" style="display:none;">
									<label>Latitude:</label>
								 </div>
								 <div class="col-md-4 col-xs-8" style="display:none;">
									<input type="text"  id = "lat" name="latitude" class="form-control" /><br>
								</div>
								<div class="col-md-2 col-xs-4" style="display:none;">
									<label>Longitude:</label>

								</div>
								<div class="col-md-4 col-xs-8" style="display:none;">
									<input type="text" id = "lon" name="longitude" class="form-control" />
								</div>													
								<div class="col-md-12 col-xs-12">
									<a href="denuncia.php" ><input type="submit" value="Cadastrar" role="button" class="btn btn-success  enviar" id="salvar"/></a>
									<a href="index.php" ><input type="cancel" value="Cancelar" role="button" class="btn btn-default  enviar" /></a>
								</div>
				
						</div>
                    </div>
                  </div>				
              </form>
            </div>
          </section>
		</article>
		<footer id="denunciaFooter" >
			<?php include "footer.html";?>
		</footer>
		<script src="lib/jsapi.js"></script>


        <script type="text/javascript">
            $(function(){
              $('#categoria').change(function(){
                            $("select[name=ocorrencia]").html('<option value="0">Carregando...</option>');

                  $.post("index.php?controle=main&metodo=ajax", {categoria:$(this).val()},
                                            //joga os dados no select ocorrencia
                          function(valor){
                             $("select[name=ocorrencia]").html(valor);
                          })
              });
            });
        </script>		
		<script type="text/javascript" src="lib/jquery-latest.js"></script>
		<script type="text/javascript" src="lib/jquery.validate.js"></script>
		<script type="text/javascript">
			$(function(){
			//executa quando clicar no botão Enviar
				$("#salvar").click(function(){
					//validar o formulário
					$("#cadastro_ocorrencia").validate({
						 rules : {
									 datad:{required:true},
									 categoria:{required:true},
									 ocorrencia:{required:true},
									 logradouro:{required:true},
									 numero:{required:true},
									 bairro:{required:true}
									
								},
							   messages:
							   {
									 datad:{required:"Informe a data do Ocorrido"},
									 categoria:{required:"Selecione a categoria da ocorrência"},
									 ocorrencia:{required:"Selecione o tipo da ocorrência"},
									 logradouro:{required:"Digite a Rua ou use a opção indicar posição no mapa"},
									 numero:{required:"Digite número"},
									 bairro:{required:"Digite o bairro"}
									

							   }

						});
					});
			});
		</script>

	</body>
</html>
