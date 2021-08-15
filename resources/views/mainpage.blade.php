<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


	<style>
		.activebgcolor {
			background-color: #66D3FA;
		}
	</style>
	<script>
		const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
			  "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
			];

	  	$( function() {
	    	

		    $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });

		    
	  	} );

	  	function fillCalendar(from,to)
	  	{
	  		


			// const start = new Date(from);
			// const end = new Date(to);

			// let loop = new Date(start);
			// while (loop <= end) {
			// 	var month =("0" + (loop.getMonth() + 1)).slice(-2);
			// 	var date = ("0" + (loop.getDate())).slice(-2);

			// 	var date_format = loop.getFullYear()+'-'+month+'-'+date;

			// 	var dd =String(loop.getDate()).padStart(1, '0');
			// 	var day = loop.getDay();
			// 	var day_word = '';

			// 	switch(day)
			//   	{
			// 	  	case 0:
			// 	  		day_word = 'Sun';
			// 	  		break;
			// 	  	case 1:
			// 	  		day_word = 'Mon';
			// 	  		break;
			// 	  	case 2:
			// 	  		day_word = 'Tue';
			// 	  		break;
			// 	  	case 3:
			// 	  		day_word = 'Wed';
			// 	  		break;
			// 	  	case 4:
			// 	  		day_word = 'Thu';
			// 	  		break;
			// 	  	case 5:
			// 	  		day_word = 'Fri';
			// 	  		break;
			// 	  	case 6:
			// 	  		day_word = 'Sat';
			// 	  		break;
				  	
			// 	  	default:
			//   	}

			//   	$('#event_list').append('<li  class="list-group-item" data-date="'+date_format+'"><span >'+monthNames[loop.getMonth()]+' '+dd+' '+day_word+'</span> <p class="event_desc" style="margin-left:100px;display:inline;"></p></li>');

			  	
			//   	let newDate = loop.setDate(loop.getDate() + 1);
			// 	loop = new Date(newDate);

			// }


	  		$.ajaxSetup({
				  headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  }
			});

			$.ajax({
	            type: "GET",
	            url: "/event",
	            dataType: "json",
	            data: {
	            
	                // date_object: Obj,
	                // event: event_desc
	            },
	            success: function (data) {


	            	if (data.status==1)
	            	{
	               		

	               		// var rows = $('#event_list li');
	               		// rows.each(function(index,value) {
	               		
	               		// 	data.event.forEach(function(element){
	               				

	               		// 		if (element['date_']==$(value).data('date') && element['event_desc'].trim().length>0)
	               		// 		{
	               		// 			$(value).addClass('activebgcolor');
	               		// 			$(value).find('.event_desc').text(element['event_desc']);
	               		// 		}
	               		// 	});	

	               		// });

	               		
	               		data.event.forEach(function(element){
	               				
	               			let loop_date = new Date(element['date_']);

	               			console.log(loop_date);

	               			var month =("0" + (loop_date.getMonth() + 1)).slice(-2);
							var date = ("0" + (loop_date.getDate())).slice(-2);

							var date_format = loop_date.getFullYear()+'-'+month+'-'+date;

							var dd =String(loop_date.getDate()).padStart(1, '0');
							var day = loop_date.getDay();

							// convert day to word
							var day_word = '';

							switch(day)
						  	{
							  	case 0:
							  		day_word = 'Sun';
							  		break;
							  	case 1:
							  		day_word = 'Mon';
							  		break;
							  	case 2:
							  		day_word = 'Tue';
							  		break;
							  	case 3:
							  		day_word = 'Wed';
							  		break;
							  	case 4:
							  		day_word = 'Thu';
							  		break;
							  	case 5:
							  		day_word = 'Fri';
							  		break;
							  	case 6:
							  		day_word = 'Sat';
							  		break;
							  	
							  	default:
						  	}

						  	if (element['event_desc'].trim().length>0)
						  	{
								
						  		$('#event_list').append('<li  class="activebgcolor list-group-item" data-date="'+date_format+'"><span >'+monthNames[loop_date.getMonth()]+' '+dd+' '+day_word+'</span> <p class="event_desc" style="margin-left:100px;display:inline;">'+element['event_desc']+'</p></li>');						  		
						  	}
						  	else 
						  	{

						  		$('#event_list').append('<li  class="list-group-item" data-date="'+date_format+'"><span >'+monthNames[loop_date.getMonth()]+' '+dd+' '+day_word+'</span> <p class="event_desc" style="margin-left:100px;display:inline;"></p></li>');	
						  	}


               				// if (element['date_']==$(value).data('date') && element['event_desc'].trim().length>0)
               				// {
               				// 	$(value).addClass('activebgcolor');
               				// 	$(value).find('.event_desc').text(element['event_desc']);
               				// }
	               		});	

	            	}
	            	else
	            	{
	            		$('#date_range').html('<font color="red">Event not set.</font>');
	            	}

	            },
	            error: function (request, status, error)  {
	             	alert('Error '+request.responseText);
	            }
	        });
	  	}

	  	$(document).ready(function() {
	  		
	  		fillCalendar('{!! $from2 !!}','{!! $to2 !!}');
	  		function isDaysSet(days){

	  			//console.log($('input[name="mon"]').prop("checked"));

	  			if ( $('input[name="mon"]').prop("checked") && $('input[name="mon"]').val()==days ){
	  				return true;

	  			}

	  			if ( $('input[name="tue"]').prop("checked") && $('input[name="tue"]').val()==days ){	
	  				return true;

	  			}

	  			if ( $('input[name="wed"]').prop("checked") && $('input[name="wed"]').val()==days ){
	  				return true;

	  			}

	  			if ( $('input[name="thu"]').prop("checked") && $('input[name="thu"]').val()==days ){
	  				return true;

	  			}

	  			if ( $('input[name="fri"]').prop("checked") && $('input[name="fri"]').val()==days ){
	  				return true;

	  			}

	  			if ( $('input[name="sat"]').prop("checked") && $('input[name="sat"]').val()==days ){
	  				return true;

	  			}

	  			if ( $('input[name="sun"]').prop("checked") && $('input[name="sun"]').val()==days ){
	  				return true;

	  			}

	  			return false;
	  		}


	  		// save date function
			$("#btn-save").click(function() {

				// initialize event list

				var check_days_length = $('.day_checkbox:checked').length;


				if ($('#event').val().trim().length==0)
				{
					alert('Invalid: Please fill for event.');
					$('#event').focus();
					return;
				}

				if ($('input[name="from_date"').val().trim().length==0)
				{
					alert('Invalid: Please fill for From.');
					$('input[name="from_date"').focus();
					return;
				}

					if ($('input[name="to_date"').val().trim().length==0)
				{
					alert('Invalid: Please fill for To.');
					$('input[name="to_date"').focus();
					return;
				}
				if (check_days_length==0)
				{
					alert('Invalid: No days is selected. Please select one.');
					return;
				}
				
				
				$('#event_list').empty();

				var Obj = [];
			

				var arr1 = $('input[name="from_date"]').val().split('-');
				var arr2 = $('input[name="to_date"]').val().split('-');
				var x = arr1[1]+'/'+arr1[2]+'/'+arr1[0];
				var y =  arr2[1]+'/'+arr2[2]+'/'+arr2[0];
				

				const start = new Date(x);
				const end = new Date(y);
				 var event_desc = $('input[name="event').val();
				let loop = new Date(start);
				while (loop <= end) {

				  var month =("0" + (loop.getMonth() + 1)).slice(-2);
				  var date = ("0" + (loop.getDate())).slice(-2);

				  var date_format = loop.getFullYear()+'-'+month+'-'+date;
				  var day = loop.getDay();

				  Obj.push({'date':date_format,'day':day,'hasEvent':isDaysSet(day)});
				  var dd =String(loop.getDate()).padStart(1, '0');
				  var day_word = '';
				 

				  switch(day)
				  {
				  	case 0:
				  		day_word = 'Sun';
				  		break;
				  	case 1:
				  		day_word = 'Mon';
				  		break;
				  	case 2:
				  		day_word = 'Tue';
				  		break;
				  	case 3:
				  		day_word = 'Wed';
				  		break;
				  	case 4:
				  		day_word = 'Thu';
				  		break;
				  	case 5:
				  		day_word = 'Fri';
				  		break;
				  	case 6:
				  		day_word = 'Sat';
				  		break;
				  	
				  	default:
				  }

				  

				  //$('#event_list').append('<li class="list-group-item">'+dd+' '+day_word+' '+event_desc+'</li>');
				  if (isDaysSet(day)){


			  	  	$('#event_list').append('<li class="activebgcolor list-group-item" data-date="'+date_format+'"><span >'+monthNames[loop.getMonth()]+' '+dd+' '+day_word+'</span> <p class="event_desc" style="margin-left:100px;display:inline;">'+event_desc+'</p></li>');	
				  } 
				  else
				  {


			  	  	$('#event_list').append('<li class="list-group-item" data-date="'+date_format+'"><span >'+monthNames[loop.getMonth()]+' '+dd+' '+day_word+'</span> <p class="event_desc" style="margin-left:100px;display:inline;"></p></li>');
				  }

				  let newDate = loop.setDate(loop.getDate() + 1);
				  loop = new Date(newDate);

				}

				$.ajaxSetup({
				  headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  }
				});

				$.ajax({
		            type: "POST",
		            url: "/save",
		            dataType: "json",
		            data: {
		            
		                date_object: Obj,
		                event: event_desc
		            },
		            success: function (data) {
		            	if (data.status==1)
		            	{
		               		
		               		//$('#event_list').empty();
		               		to = data.data.to != null ? ' to '+data.data.to : '';
		               		$('#date_range').text(data.data.from+''+to);
		               		fillCalendar(data.data.from2,data.data.to2);
		               		alert('Event successfully saved.');


		            	}

		            },
		            error: function (request, status, error)  {
		             	alert('Error '+request.responseText);
		            }
		        });


			});
	    });
	</script>
</head>

<body>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			CALENDAR
		</div>
	</div>
	<div class="row">
	  
		<div class="col-sm-4">
	  		
	  		<div class="row"> 
	  			<div class="col-sm-12">
					<p>Event: </p>
					<input type="text" name="event" id="event" value="{!! $event_desc !!}" class="form-control">
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6" id="from_div">
					<p>From </p>
					<input type="text" name="from_date" value="{!! $from2 !!}" class="form-control datepicker">
				</div>

				<div class="col-sm-6" id="to_div">
					<p>To </p>
					<input type="text" name="to_date" value="{!! $to2 !!}" class="form-control datepicker">
				</div>
			</div>


			<div class="row">
				<div class="col-sm-2">
					<div class="checkbox">
				      	<label><input class="day_checkbox" name="mon" type="checkbox" value="1" {!! isset($days_check[1]) && $days_check[1]->event_desc!='' ? 'checked' : ''  !!}>Mon</label>
				    </div>
				</div>

				<div class="col-sm-2">
					<div class="checkbox">
				      	<label><input class="day_checkbox" name="tue" type="checkbox" value="2" {!! isset($days_check[2]) && $days_check[2]->event_desc!='' ? 'checked' : ''  !!}>Tue</label>
				    </div>
				</div>

				<div class="col-sm-2">
					<div class="checkbox">
				      	<label><input class="day_checkbox" name="wed" type="checkbox" value="3" {!! isset($days_check[3]) && $days_check[3]->event_desc!='' ? 'checked' : ''  !!}>Wed</label>
				    </div>
				</div>

				<div class="col-sm-2">
					<div class="checkbox">
				      	<label><input class="day_checkbox" name="thu" type="checkbox" value="4" {!! isset($days_check[4]) && $days_check[4]->event_desc!='' ? 'checked' : ''  !!}>Thu</label>
				    </div>
				</div>

				<div class="col-sm-2">
					<div class="checkbox">
				      	<label><input class="day_checkbox" name="fri" type="checkbox" value="5" {!! isset($days_check[5]) && $days_check[5]->event_desc!='' ? 'checked' : ''  !!}>Fri</label>
				    </div>
				</div>

				<div class="col-sm-2">
					<div class="checkbox">
				      	<label><input class="day_checkbox" name="sat" type="checkbox" value="6" {!! isset($days_check[6]) && $days_check[6]->event_desc!='' ? 'checked' : ''  !!}>Sat</label>
				    </div>
				</div>

				<div class="col-sm-2">
					<div class="checkbox">
				      	<label><input class="day_checkbox" name="sun" type="checkbox" value="0" {!! isset($days_check[0]) && $days_check[0]->event_desc!='' ? 'checked' : ''  !!}>Sun</label>
				    </div>
				</div>

			</div> <!-- end row -->

			<!-- save button -->
			<div class="row">
				<div class="col-sm-12">
					<button  type="submit" class="btn btn-primary" id="btn-save">Save</button>
				</div>
			</div>
	  	</div>


	  	<div class="col-sm-8">
	  		<div class="col-sm-12" >
	  			<?php $to != null ? $to = ' to '.$to : ''; ?>
	  			<h1 id="date_range">{!! $from.$to !!}</h1>
	  		</div>

	  		<div class="col-sm-12">
				<ul class="list-group" id="event_list">
					<!-- <li class="list-group-item">1 Sun</li>
					<li class="list-group-item">2 Mon</li>
					<li class="list-group-item">3 Tue</li>
					<li class="list-group-item">4 Wed</li>
					<li class="list-group-item">5 Thu</li>
					<li class="list-group-item">6 Fri</li>
					<li class="list-group-item">7 Sat</li> -->
				</ul>	  			
	  		</div>
		</div>
	  

	</div>
</div>
</body>
</html>