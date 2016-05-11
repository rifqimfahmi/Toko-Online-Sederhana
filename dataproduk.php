<?php

	include "include/session.php";
	include "include/header.php";
	include "database.php";
	$menu=  array();

	$database = database::connect();
	$sql ="SELECT*FROM grafik";

	$prepare = $database->prepare($sql);
	$prepare->execute();
	foreach ($prepare as $data)
	{$menu[] = $data['jumlah'];

	}
	$array=join(", ", $menu);
?>


<!DOCTYPE html>
<html>
<body>
		<div class="content">

				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
				<script src="js/highcharts.js" type="text/javascript"></script>
		        <script type="text/javascript">

		              var chart;
		              $(document).ready (function(){
		                  chart =new Highcharts.Chart({
		                      chart: { 
		                      renderTo: 'container',
		                      type :'column' },
		                  
		                  title: { 
		                        text :'Grafik Penjualan Action Figure'    
		                         },
		                   xAxis: { 
		                        categories: ['Naruto','One Piece','Death Note','Tokyo ghoul']
		                    },
		                  yAxis: { 
		                         title: {
		                             text : 'Jumlah Penjualan'
		                         }
		                     },
		                  series :
		                          [
		                      {
		                        	name : 'Anime',
		                            color : '#4572A7',
		                            type : 'column',
		                            yAxis : 0,
		                            data : [ <?php echo $array;?>]  
		                      },
		                          ]
		               
		                     });
		              });
		        </script> 
				<div id="container"></div>
		</div>
		<?php include "include/footer.php" ?>
	</body>
</html>