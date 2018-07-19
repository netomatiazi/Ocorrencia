<?php
	
	// inclui a biblioteca base e para gráficos de pizza
	require_once ('jpgraph-4.0.2/src/jpgraph.php');
    require_once ('jpgraph-4.0.2/src/jpgraph_bar.php');
	
    // define a consulta
    
    //extrai os dados da consulta    
    $inf=array();
	$tic=array();
	if(count($retorno) > 0)
	{
		for($x=0; $x<count($retorno); $x++)
		{
			// criando os vetores com os dados
			$inf[$x] = $retorno[$x]->vezes;
			$tic[$x] = $retorno[$x]->tipo;
		}
   
		// cria o gráfico
		$graph = new Graph(850,300,'auto');
$graph->SetScale("textlin");
//$graph->SetMargin(70,20,40,40);

$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($tic);

//$tema = new GreenTheme;
//$tema = new SoftyTheme;
//$graph->SetTheme($tema);

$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Cria as barras
$b1plot = new BarPlot($inf);

// cria o grupo de barras

$gbplot = new GroupBarPlot(array($b1plot));

$graph->Add($gbplot);


// pode ser variável - coloquei duas por ser um exemplo
$cor[0]= "#005eac";
$cor[1]= "#de3939";
$cor[2]= "#0d7b3d";
$cor[3]= "#000000";

$b1plot->SetColor("white");
$b1plot->SetFillColor($cor);

$graph->title->Set("Ocorrências");

// Mostra o gráfico
$graph->Stroke();
	}

?>