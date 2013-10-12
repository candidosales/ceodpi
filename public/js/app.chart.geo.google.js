 	google.load('visualization', '1', {'packages': ['geochart']});
	google.setOnLoadCallback(drawMap);

	ajax.totalClientePorEstado();
	
	function drawMap() {
	  var data = new google.visualization.DataTable();
	  data.addColumn('string', 'City');
	  data.addColumn('number', 'DeMolay(s)');
	  data.addColumn('number', 'Maçon(s)');
	  data.addRows([
		[arrayMapa[0].estado, parseInt(arrayMapa[0].tipo1), parseInt(arrayMapa[0].tipo2)],[arrayMapa[1].estado, parseInt(arrayMapa[1].tipo1), parseInt(arrayMapa[1].tipo2)],[arrayMapa[2].estado, parseInt(arrayMapa[2].tipo1), parseInt(arrayMapa[2].tipo2)],[arrayMapa[3].estado, parseInt(arrayMapa[3].tipo1), parseInt(arrayMapa[3].tipo2)],
		/*[arrayMapa[4].estado, parseInt(arrayMapa[4].tipo1), parseInt(arrayMapa[4].tipo2)],[arrayMapa[5].estado, parseInt(arrayMapa[5].tipo1), parseInt(arrayMapa[5].tipo2)],[arrayMapa[6].estado, parseInt(arrayMapa[6].tipo1), parseInt(arrayMapa[6].tipo2)],
		[arrayMapa[7].estado, parseInt(arrayMapa[7].tipo1), parseInt(arrayMapa[7].tipo2)],[arrayMapa[8].estado, parseInt(arrayMapa[8].tipo1), parseInt(arrayMapa[8].tipo2)],[arrayMapa[9].estado, parseInt(arrayMapa[9].tipo1), parseInt(arrayMapa[9].tipo2)],
		[arrayMapa[10].estado, parseInt(arrayMapa[10].tipo1), parseInt(arrayMapa[10].tipo2)],[arrayMapa[11].estado, parseInt(arrayMapa[11].tipo1), parseInt(arrayMapa[11].tipo2)],[arrayMapa[12].estado, parseInt(arrayMapa[12].tipo1), parseInt(arrayMapa[12].tipo2)],
		*/
	  ]);

	  var options = {
		region: 'BR',
		displayMode: 'markers',
		colorAxis: {colors: ['#EFD82B','#EFAA2B', '#D84308']}
	  };

	  var chart = new google.visualization.GeoChart(document.getElementById('mapa'));
	  chart.draw(data, options);


	};
