

(function($) {
    /* "use strict" */
	
 var dlabChartlist = function(){
	
	var screenWidth = $(window).width();
	//let draw = Chart.controllers.line.__super__.draw; //draw shadow
			var barChart = function(){
				var optionsTimeline = {
				  chart: {
					type: "bar",
					height: 200,
					//stacked: true,
					toolbar: {
					  show: false
					},
					sparkline: {
					  //enabled: true
					},
					offsetX:0,
				  },
				  series: [
					 {
					  name: "Income",
					  data: [50, 100, 80, 50, 100, 130, 150 ]
					},
					{
						name: 'Outcome',
						data: [80, 40, 55, 20, 45, 30, 80]
					  }, 
				  ],
				  
				  plotOptions: {
					bar: {
					  columnWidth: "40%",
					},
					distributed: true
				  },
				  
				  grid: {
					show:false,
				  },
				  legend: {
					show: false
				  },
				  fill: {
					opacity: 1
				  },
				  colors:['#1eba62', '#fd5353'],
				  dataLabels: {
					enabled: false,
					colors: ['#000'],
					dropShadow: {
					  enabled: true,
					  top: 1,
					  left: 1,
					  blur: 1,
					  opacity: 1
					}
				  },
				  xaxis: {
				   categories: ['Mon', 'Tue', 'Web', 'Thu', 'Fri', 'Sat', 'Sun'],	
				   labels: {
						style: {
						colors: 'var(--text)',
						fontSize: '14px',
						fontFamily: 'poppins',
						cssClass: 'apexcharts-xaxis-label',
						},
					},
					crosshairs: {
					show: false,
					},
					axisBorder: {
					  show: true,
					},
					axisTicks: {
						show: false,
					},
				  },
				  stroke:{
					how: true,
					width: 4,
					curve: 'smooth',
					lineCap: 'round',
					colors: ['transparent']
				   },
				  yaxis: {
					show: false
				  },
				  
				  tooltip: {
					x: {
					  show: true
					}
				  }
				};
				var chartTimelineRender =  new ApexCharts(document.querySelector("#barChart"), optionsTimeline);
				 chartTimelineRender.render();  
			}
		
			var activity = function(){
				var optionsArea = {
				  series: [{
					name: "Persent",
					data: [60, 70, 80, 50, 60, 50, 90]
				  },
				  {
					name: "Visitors",
					data: [40, 50, 40, 60, 90, 70, 90]
				  }
				],
				  chart: {
				  height: 300,
				  type: 'area',
				  group: 'social',
				  toolbar: {
					show: false
				  },
				  zoom: {
					enabled: false
				  },
				},
				dataLabels: {
				  enabled: false
				},
				stroke: {
				  width: [3, 3, 3],
				  colors:['var(--secondary)','var(--primary)'],
				  curve: 'straight'
				},
				legend: {
					show:false,
				  tooltipHoverFormatter: function(val, opts) {
					return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
				  },
				  markers: {
					fillColors:['var(--secondary)','var(--primary)'],
					width: 16,
					height: 16,
					strokeWidth: 0,
					radius: 16
				  }
				},
				markers: {
				  size: [8,8],
				  strokeWidth: [4,4],
				  strokeColors: ['var(--secondary)','var(--primary)'],
				  border:2,
				  radius: 2,
				  colors:['#fff','#fff','#fff'],
				  hover: {
					size: 10,
				  }
				},
				xaxis: {
				  categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
				  labels: {
				   style: {
					  colors: 'var(--text)',
					  fontSize: '14px',
					   fontFamily: 'Poppins',
					  fontWeight: 100,
					  
					},
				  },
				  axisBorder:{
					  show: false,
				  }
				},
				yaxis: {
					labels: {
						minWidth: 20,
						offsetX:-16,
						style: {
						  colors: 'var(--text)',
						  fontSize: '14px',
						   fontFamily: 'Poppins',
						  fontWeight: 100,
						  
						},
					},
				},
				fill: {
					colors:['#fff','#fff'],
					type:'gradient',
					opacity: 1,
					gradient: {
						shade:'light',
						shadeIntensity: 1,
						colorStops: [ 
						  [
							{
							  offset: 0,
							  color: '#fff',
							  opacity: 0
							},
							{
							  offset: 0.6,
							  color: '#fff',
							  opacity: 0
							},
							{
							  offset: 100,
							  color: '#fff',
							  opacity: 0
							}
						  ],
						  [
							{
							  offset: 0,
							  color: '#fff',
							  opacity: .4
							},
							{
							  offset: 50,
							  color: '#fff',
							  opacity: 0.25
							},
							{
							  offset: 100,
							  color: '#fff',
							  opacity: 0
							}
						  ]
						]
		
				  },
				},
				colors:['#1EA7C5','#FF9432'],
				grid: {
				  borderColor: 'var(--border)',
				  xaxis: {
					lines: {
					  show: true
					}
				  },
				  yaxis: {
					lines: {
					  show: false
					}
				  },
				},
				
				 responsive: [{
					breakpoint: 1602,
					options: {
						markers: {
							 size: [6,6,4],
							 hover: {
								size: 7,
							  }
						},chart: {
						height: 230,
						},	
					},
					
				 }]
		
		
				};
				if(jQuery("#activity").length > 0){
		
					var dzchart = new ApexCharts(document.querySelector("#activity"), optionsArea);
					dzchart.render();
					
					jQuery('#dzOldSeries').on('change',function(){
						jQuery(this).toggleClass('disabled');
						dzchart.toggleSeries('Persent');
					});
            
					jQuery('#dzNewSeries').on('change',function(){
						jQuery(this).toggleClass('disabled');
						dzchart.toggleSeries('Visitors');
					});
					
				}
			  
			}	
	
 
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				barChart();
				activity();	
			},
			
			resize:function(){
				
			}
		}
	
	}();

	
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dlabChartlist.load();
		}, 1000); 
		
	});

     

})(jQuery);