<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Event Calendar</title>
        <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="{{url('asset/css/fullcalendar.css')}}">
		<style type="text/css">
		  #dialog{
		      display:none;
		  }
		  .error {
              color: red;
              font-size: 13px;
              font-weight: normal !important;
           }
		</style>
    </head>
    <body>
    	<div class="container-fluid">
  			<div class="row content">
                <div class="col-sm-12">
                  <h2><small>Full Event Calendar With Laravel 6</small></h2>
                  <hr>
            		<div class="flex-center position-ref full-height">
                        <div class="content">
            				<div class="container">
            					<div id='calendar'></div>
            				</div>
                        </div>
                    </div>
                    <!-- Day Click Dialog Start -->
                    <div id="dialog">
                    	<div id="dialog-body">
                    		<form id="dayClick" method="post" action="{{route('eventStore')}}">
                    			@csrf
                    			<div class="form-group">
                    				<label>Event Title</label>
                    				<input type="text" id="title" class="form-control" name="title" placeholder="Event Title" autocomplete="off">
                    			</div>
                    			<div class="form-group">
                    				<label>Start DateTime</label>
                    				<input type="text" id="start" class="form-control" name="start" placeholder="Start Date & Time" autocomplete="off">
                    			</div>
                    			<div class="form-group">
                    				<label>End DateTime</label>
                    				<input type="text" id="end" class="form-control" name="end" placeholder="End Date & Time" autocomplete="off">
                    			</div>
                    			<div class="form-group">
                    				<label>All Day</label>
                    				<input type="checkbox" class="form-control" name="allDay" value="0" checked> All Day
                    				<!-- <input type="checkbox" class="form-control" name="allDay" value="1"> Partial-->
                    			</div>
                    			<div class="form-group">
                    				<label>Background Coor</label>
                    				<input type="color" id="color" class="form-control" name="color" placeholder="Background color">
                    			</div>
                    			<div class="form-group">
                    				<label>End DateTime</label>
                    				<input type="color" id="textColor" class="form-control" name="textColor" placeholder="Text Color">
                    			</div>
                    			<input type="hidden" id="eventId" name="event_id">
                    			<div class="form-group">
                    				<button type="submit" class="btn btn-success" id="btn_event">Add Event</button>
                    			</div>
                    		</form>
                    	</div>
                    </div>
                    <!-- Day Click Dialog ENd -->
                </div>
  			</div>
		</div>
        <script src="{{url('asset/js/jquery.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" ></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" ></script>
        <script src="{{url('asset/js/fullcalendar.js')}}"></script>
        <script src="{{url('asset/js/jquery.validate.min.js')}}"></script>
        <script src="{{url('asset/js/function.js')}}"></script>
        @include('sweetalert::alert');
    </body>
</html>
