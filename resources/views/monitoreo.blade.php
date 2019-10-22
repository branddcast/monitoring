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
						   Periodo: <label id="periodo"></label>
						</p>
					</div>
					<div class="col-md-6 text-right">
						<div id="container-speed" class="chart-container" style="min-width: 150px; height: 165px;"></div>
							<script>

								var gaugeOptions = {
								    chart: {
								        type: 'solidgauge'
								    },

								    title: null,

								    pane: {
								        center: ['50%', '80%'],
								        size: '140%',
								        startAngle: -90,
								        endAngle: 90,
								        background: {
								            backgroundColor:
								                Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
								            innerRadius: '60%',
								            outerRadius: '100%',
								            shape: 'arc'
								        }
								    },

								    tooltip: {
								        enabled: false
								    },

								    // the value axis
								    yAxis: {
								        stops: [
								            [0.1, '#55BF3B'], // green
								            [0.5, '#DDDF0D'], // yellow
								            [0.9, '#DF5353'] // red
								        ],
								        lineWidth: 0,
								        minorTickInterval: null,
								        tickAmount: 2,
								        title: {
								            y: -70
								        },
								        labels: {
								            y: 16
								        }
								    },

								    plotOptions: {
								        solidgauge: {
								            dataLabels: {
								                y: 5,
								                borderWidth: 0,
								                useHTML: true
								            }
								        }
								    }
								};

								// The speed gauge
								var chartSpeed = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
								    yAxis: {
								        min: 0,
								        max: 200,
								        title: false
								    },

								    credits: {
								        enabled: false
								    },

								    series: [{
								        name: 'Speed',
								        data: [150],
								        dataLabels: {
								            format:
								                '<div style="text-align:center">' +
								                '<span style="font-size:20px">{y}</span><br/>' +
								                '<span style="font-size:12px;opacity:0.4">kw/h</span>' +
								                '</div>'
								        },
								        tooltip: {
								            valueSuffix: ' kw/h'
								        }
								    }]

								}));

							</script>
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
			</div>
		</div>
	</div>

@endsection