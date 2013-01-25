/* [ ---- Gebo Admin Panel - dashboard ---- ] */

	$(document).ready(function() {
		//* small charts
		//gebo_peity.init();
		//* charts
		//gebo_charts.fl_1();
		//gebo_charts.fl_2();
		//* sortable/searchable list

		gebo_flist.init();
		
		//* responsive table
		gebo_media_table.init();
		//* resize elements on window resize
		var lastWindowHeight = $(window).height();
		var lastWindowWidth = $(window).width();
		$(window).on("debouncedresize",function() {
			if($(window).height()!=lastWindowHeight || $(window).width()!=lastWindowWidth){
				lastWindowHeight = $(window).height();
				lastWindowWidth = $(window).width();
				//* rebuild calendar
				$('#calendar').fullCalendar('render');
			}
		});
		//* small gallery grid
        gebo_gal_grid.small();
		
		//* to top
		$().UItoTop({inDelay:200,outDelay:200,scrollSpeed: 500});
		
		
		//* datepicker
		gebo_datepicker.init();
		//* timepicker
		//gebo_timepicker.init();
		
		

	
	});
	
	//* bootstrap datepicker
	gebo_datepicker = {
		init: function() {
			$('#dp1').datepicker().on('changeDate', function(ev){
				$("#dp1").datepicker('hide');
			});
			$('#dp2').datepicker().on('changeDate', function(ev){
				$("#dp2").datepicker('hide');
			});

			$("#dp3").datepicker().change(function() {
				var date = $(this).val();
				gebo_datepicker.editSelect(date, '#addEditSelectableDates','#selectedSpan');
				
				$(this).val('');
				$(this).blur();
			});

		}, 
		editSelect: function(date, updateClass, updateCount){ //creates a multi select of the datepicker
			var oldCount = $(updateClass+" li").length;
			var count = parseInt(oldCount)+1;
			var code_append = '<li class="label label-info" style="margin-bottom:1; margin-top:1px; margin-right:0px; margin-left:0px;"><button type="button" class="close closeEditSchedule" count="'+count+'">×</button><span class="date_to_edit">'+date+'</span></li>';
			$(updateClass).append(code_append).fadeIn('slow');
			gebo_datepicker.editCounter(count,updateCount);
			gebo_datepicker.minusCounter(count,updateClass,updateCount);
			
		}, 
		editCounter: function(count,counterClass){ //adds to the counter
			$(counterClass).html(count);	
		},
		minusCounter: function(count,updateClass,counterClass){ //removes from the counter
			$(".closeEditSchedule[count='"+count+"']").click(function(){
				$(this).parent().fadeTo("slow", 0.00, function(){ //fade           	
	                $(this).remove(); //then remove from the DOM
	                var newCount = $(updateClass+" li").length;
	                $(counterClass).html(newCount);
	            });
         	});
	 
		}
	};
	

	//* filterable list
	gebo_flist = {
		init: function(){
			//*typeahead
			var list_source = [];
			$('.user_list li').each(function(){
				var search_name = $(this).find('.sl_name').text();
				//var search_email = $(this).find('.sl_email').text();
				list_source.push(search_name);
			});
			// commented out 10/9 JFD
			//$('.user-list-search').typeahead({source: list_source, items:5});
			
			var pagingOptions = {};
			var options = {
				valueNames: [ 'sl_name', 'sl_status', 'sl_email' ],
				page: 10,
				plugins: [
					[ 'paging', {
						pagingClass	: "bottomPaging",
						innerWindow	: 1,
						left		: 1,
						right		: 1
					} ]
				]
			};
			var userList = new List('user-list', options);
			
			$('#filter-online').on('click',function() {
				$('ul.filter li').removeClass('active');
				$(this).parent('li').addClass('active');
				userList.filter(function(item) {
					if (item.values().sl_status == "online") {
						return true;
					} else {
						return false;
					}
				});
				return false;
			});
			$('#filter-offline').on('click',function() {
				$('ul.filter li').removeClass('active');
				$(this).parent('li').addClass('active');
				userList.filter(function(item) {
					if (item.values().sl_status == "offline") {
						return true;
					} else {
						return false;
					}
				});
				return false;
			});
			$('#filter-none').on('click',function() {
				$('ul.filter li').removeClass('active');
				$(this).parent('li').addClass('active');
				userList.filter();
				return false;
			});
			
			$('#user-list').on('click','.sort',function(){
					$('.sort').parent('li').removeClass('active');
					if($(this).parent('li').hasClass('active')) {
						$(this).parent('li').removeClass('active');
					} else {
						$(this).parent('li').addClass('active');
					}
				}
			);
		}
	};
	
	//* gallery grid
    gebo_gal_grid = {
        small: function() {
            //* small gallery grid
            $('#small_grid ul').imagesLoaded(function() {
                // Prepare layout options.
                var options = {
                  autoResize: true, // This will auto-update the layout when the browser window is resized.
                  container: $('#small_grid'), // Optional, used for some extra CSS styling
                  offset: 6, // Optional, the distance between grid items
                  itemWidth: 120, // Optional, the width of a grid item (li)
				  flexibleItemWidth: false
                };
                
                // Get a reference to your grid items.
                var handler = $('#small_grid ul li');
                
                // Call the layout function.
                handler.wookmark(options);
                
                $('#small_grid ul li > a').attr('rel', 'gallery').colorbox({
                    maxWidth	: '80%',
                    maxHeight	: '80%',
                    opacity		: '0.2', 
                    loop		: false,
                    fixed		: true
                });
            });
        }
    };
	
	//* calendar
	
	
    //* responsive tables
    gebo_media_table = {
        init: function() {
			$('.mediaTable').mediaTable();
        }
    };


	

