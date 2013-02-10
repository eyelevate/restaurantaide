$(document).ready(function(){
	reports.mainScripts();
});

reports = {
	mainScripts: function(){
		$("#selectYearTypeDiv").change(function(){

			//hide all
			$('.chart').hide();

			var type = $(this).find('option:selected').val();
			switch(type){
				case 'day':
					$('#yearChart-day').fadeIn();
				break;
				
				case 'week':
					$('#yearChart-week').fadeIn();
				break;
				
				case 'month':
					$('#yearChart-month').fadeIn();
				break;
			}
		});
	}
}
