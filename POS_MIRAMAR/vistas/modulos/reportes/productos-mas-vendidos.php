
  <?php

  $item = null;
  $valor = null;
  $orden = "ventas";

  $productos = ControladorProductos::ctrMostrarProductos($item, $valor,   $orden);

  $colores = array("red","green","yellow","aqua","purple","blue","cyan",  "magenta","orange","gold");

  $totalVentas = ControladorProductos::ctrMostrarSumaVentas();


  ?>

  <!--=====================================
  PRODUCTOS MÁS VENDIDOS
  ======================================-->

  <div class="box box-default">
  
  	<div class="box-header with-border">

        <h3 class="box-title">Productos más vendidos</h3>

    </div>

  	<div class="box-body" style=" margin: auto;">

        	<div class="row "style=" margin: auto;">

  	        <div class="col-md-12"style=" margin: auto;">

  	 			    <div class="chart-responsive " style=" margin: auto;">
  
  	            	<canvas id="pieChart" height="150" class="" style=" margin:auto; width:50%"></canvas>
  
  	          	</div>

  	        </div>

 

  		</div>

      </div>

      <div class="box-footer no-padding">
          
  		<ul class="nav nav-pills nav-stacked">
          
  			 <?php

            	for($i = 0; $i <5; $i++){
              
            		echo '<li>
              
  						 <a>

  						 <img src="'.$productos[$i]["imagen"].'"  class="img-thumbnail" width="60px"   style="margin-right:10px"> 
  						 '.$productos[$i]["descripcion"].'

  						 <span class="pull-right text-'.$colores[$i].'">   
  						 '.ceil($productos[$i]["ventas"]*100/$totalVentas["total"]).'%
  						 </span>
              
  						 </a>

        				</li>';

  			}

  			?>


  		</ul>

    </div>

  </div>

  <script>
  

    // -------------
    // - PIE CHART -
    // -------------
    // Get context with jQuery - using jQuery's .get() method.
    // var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
    // var pieChart       = new Chart(pieChartCanvas);
    var PieData = [
    <?php

    for($i = 0; $i < 10; $i++){

    	echo "{
        value    : ".$productos[$i]["ventas"].",
        color    : '".$colores[$i]."',
        highlight: '".$colores[$i]."',
        label    : '".$productos[$i]["descripcion"]."'
      },";

    }

     ?>
    ];
    var xValues = PieData.map(item => item.label);
var yValues = PieData.map(item => item.value);
var barColors = PieData.map(item => item.color);

new Chart("pieChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Productos mas vendidos"
    },
    legend: {
      display: false // Oculta la leyenda
    },
    tooltips: {
      enabled: false // Deshabilita los tooltips
    },
    plugins: {
            subtitle: {
                display: false,
                text: 'Custom Chart Subtitle'
            }
        }
  }
});
    // -----------------
    // - END PIE CHART -
    // -----------------


  </script>
