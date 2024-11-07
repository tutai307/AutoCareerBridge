

(function($) {
    /* "use strict" */
	
 var dlabChartlist = function(){
	
	
	var pieChart = function(){
		var options = {
		  series: [10,20,35,35],
		  chart: {
		  type: 'donut',
		  height:200,
		  innerRadius: 50,  
		},
		dataLabels: {
		  enabled: false
		},
		stroke: {
		  width: 0,
		},
		plotOptions: {
			  pie: {
				 startAngle: 0, 
				  endAngle: 360,
				 donut: {
					  size: '80%',
				 },
			 },
		},
		colors:[ '#2A353A', '#2BC844' ,'#9568FF', 'var(--primary)'],
		legend: {
			  position: 'bottom',
			  show:false
			},
		responsive: [{
		  breakpoint: 768,
		  options: { 
		   chart: {
			  width:200
			},
		  }
		}]
		};

		var chart = new ApexCharts(document.querySelector("#pieChart"), options);
		chart.render();
	}
	
	
	
	

 
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				//activity();
				//chartBarRunning();
				pieChart();
				//redial();	
				//swipercard();
				//swiperreview();

			},
			
			resize:function(){
				chartBarRunning();
			}
		}
	
	}();

	
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dlabChartlist.load();
		}, 1000); 
		
	});

     

})(jQuery);