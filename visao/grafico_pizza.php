<?php
	
	// inclui a biblioteca base e para gráficos de pizza
	require_once ('jpgraph-4.0.2/src/jpgraph.php');
    require_once ('jpgraph-4.0.2/src/jpgraph_pie.php');
    require_once ('jpgraph-4.0.2/src/jpgraph_pie3d.php');
	
    // define a consulta
    
    require_once "controle/funcao.php";
	$ocorrenciaDAO = new ocorrenciaDAO();
	$ret = $ocorrenciaDAO->graficos();
	//extrai os dados da consulta    
    $inf=array();
	$tic=array();
	if(count($ret) > 0)
	{
		for($x=0; $x<count($ret); $x++)
		{
			// criando os vetores com os dados
			$inf[$x] = $ret[$x]->vezes;
			$tic[$x] = $ret[$x]->tipo;
		}
   
		// cria o gráfico
		$graph = new PieGraph(600,400);
		
		// habilita sombreamento na imagem
		$graph->SetShadow();
		
		
		
		// cria uma plotagem do tipo torta 3D
		$pieplot = new PiePlot3D($inf);
		
		// indica uma fatia para estar em destaque
		$pieplot->ExplodeSlice(1);
		
		// posiciona o centro do gráfico
		$pieplot->SetCenter(0.4, 0.6);
		
		//utiliza tema pronto
		//$tema = new GreenTheme;
		$tema = new OceanTheme;
		$graph->SetTheme($tema);		
		// define as legendas
		$pieplot->SetLegends($tic);
		// define o título do gráfico
		$graph->title->Set("Gráfico por Tipo de Ocorrência");
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		// adiciona a plotagem ao gráfico
		$graph->Add($pieplot);
		
		// exibe o gráfico no navegador
		$graph->Stroke();
	}

?>