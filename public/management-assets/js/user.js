

(function($) {
    /* "use strict" */
	
 var dlabChartlist = function(){
	
	var donutChart2 = function(){
		$("span.donut3").peity("donut", {
			width: "120",
			height: "120"
		})
	}
	
	
	
	/* Function ============ */
		return {
			init:function(){
            },
			
			
			load:function(){
                donutChart2();
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