@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 monitoring-border-top bg-white">
				<div class="row mb-3">
					<div class="col-md-12 text-center monitoring-head-text" style="background: rgba(68, 102, 187, .05)">
						<b>Monitoreo Eléctrico</b>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<span class="monitoring-border-bottom">
							<b>Datos Generales</b>
						</span>

						<p class="mt-3 datos_generales_p">
						   Nombre: <label id="nombre_titular"></label><br/>
						   Sección: <label id="seccion"></label> <br/>
						   Periodo: <label id="periodo"></label><br/>
						   Costo: <label id="costo"></label>
						</p>
					</div>
					<div class="col-md-6 text-right">
						<div id="container-speed" class="chart-container" style="min-width: 150px; height: 165px;"></div>
							<script>

								// The speed gauge
								Highcharts.chart('container-speed', {
									  chart: {
									    type: 'gauge',
									    plotBackgroundColor: null,
									    plotBackgroundImage: null,
									    plotBorderWidth: 0,
									    plotShadow: false
									  },

									  title: null,

									  pane: {
									    startAngle: -150,
									    endAngle: 150,
									    background: [{
									      backgroundColor: {
									        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
									        stops: [
									          [0, '#FFF'],
									          [1, '#333']
									        ]
									      },
									      borderWidth: 0,
									      outerRadius: '109%'
									    }, {
									      backgroundColor: {
									        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
									        stops: [
									          [0, '#333'],
									          [1, '#FFF']
									        ]
									      },
									      borderWidth: 1,
									      outerRadius: '107%'
									    }, {
									      // default background
									    }, {
									      backgroundColor: '#DDD',
									      borderWidth: 0,
									      outerRadius: '105%',
									      innerRadius: '103%'
									    }]
									  },

									  // the value axis
									  yAxis: {
									    min: 0,
									    max: 200,

									    minorTickInterval: 'auto',
									    minorTickWidth: 1,
									    minorTickLength: 10,
									    minorTickPosition: 'inside',
									    minorTickColor: '#666',

									    tickPixelInterval: 30,
									    tickWidth: 2,
									    tickPosition: 'inside',
									    tickLength: 10,
									    tickColor: '#666',
									    labels: {
									      step: 2,
									      rotation: 'auto'
									    },
									    title: {
									      text: 'km/h'
									    },
									    plotBands: [{
									      from: 0,
									      to: 120,
									      color: '#55BF3B' // green
									    }, {
									      from: 120,
									      to: 160,
									      color: '#DDDF0D' // yellow
									    }, {
									      from: 160,
									      to: 200,
									      color: '#DF5353' // red
									    }]
									  },

									  series: [{
									    name: 'Speed',
									    data: [100],
									    tooltip: {
									      valueSuffix: ' km/h'
									    }
									  }]

									});

							</script>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-md-12 mb-4">
						<span class="monitoring-border-bottom">
							<b>Consumo Potencia Eléctrica</b>
						</span>
					</div>
					<div class="col-md-12">
						<div id="grafica_potencia" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-md-12 mb-4">
						<span class="monitoring-border-bottom">
							<b>Últimos Registros</b>
						</span>
					</div>
					<div class="col-md-12">
						<table id="consumo_electrico_tabla" class="table responsive table-bordered table-sm monitoring-table">
							<thead class="text-center">
								<tr>
									<th scope="col">#</th>
									<th scope="col">Voltaje</th>
									<th scope="col">Corriente</th>
									<th scope="col">Potencia</th>
									<th scope="col">Costo</th>
									<th scope="col">Tiempo</th>
								</tr>
							</thead>
							<tbody class="text-center">
							</tbody>
						</table>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-12 mb-4">
						<span class="monitoring-border-bottom">
							<b>Consumo Voltaje y Corriente Eléctrica</b>
						</span>
					</div>
					<div class="col-md-12">
						<div id="grafica_voltaje_corriente" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
	</script>

@endsection