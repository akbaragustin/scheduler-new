@extends('layouts.index')
@section('content')
	<div class="main-content" style="height:1px">

					<div class="page-header">
						<h1>
							Full Schedule
							<small>
								<i class="ace-icon fa fa-angle-double-right"></i>
								with draggable and editable events
							</small>
						</h1>
					</div><!-- /.page-header -->


								<div class="col-sm-12 col-xs-12" style="padding-right:50px;padding-left:50px;height:900px">
									<div class="space"></div>
									<div id="calendar"></div>
								</div>
							</div>

@section('js')
		<!-- inline scripts related to this page -->
			<script type="text/javascript">
		jQuery(function($) {
/* initialize the external events
-----------------------------------------------------------------*/
$('#external-events div.external-event').each(function() {
	// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
	// it doesn't need to have a start or end
	var eventObject = {
		title: $.trim($(this).text()) // use the element's text as the event title
	};
	// store the Event Object in the DOM element so we can get to it later
	$(this).data('eventObject', eventObject);
	// make the event draggable using jQuery UI
	$(this).draggable({
		zIndex: 999,
		revert: true,      // will cause the event to go back to its
		revertDuration: 0  //  original position after the drag
	});

});
/* initialize the calendar
-----------------------------------------------------------------*/
var date = new Date();
var d = date.getDate();
var m = date.getMonth();
var y = date.getFullYear();
var Url = "{{url(route('home.indexAjax'))}}";
var urlCalender = "{{url(route('home.searchAjax'))}}";
var urlSave = "{{url(route('home.saveAjax'))}}";
var urlSchedule = "{{url(route('home.index'))}}";
var token = "{{ csrf_token() }}";
var ruangan = JSON.parse('<?php  echo $allRuangan; ?>');
var user = JSON.parse('<?php  echo $allUser; ?>');
 var optionUser ="";
 $.each( user, function( k, v ) {
		optionUser +='<option value="'+v.id_user+'">'+v.username+'</option>';
 });

var option ="";
 $.each( ruangan, function( key, value ) {
		option +='<option value="'+value.id_ruangan+'">'+value.name_ruangan+' ('+value.max_ruangan+')</option>';
});

var calendar = $('#calendar').fullCalendar({
	 height: 650,
	buttonHtml: {
		prev: '<i class="ace-icon fa fa-chevron-left"></i>',
		next: '<i class="ace-icon fa fa-chevron-right"></i>'
	},

	header: {
		left: '',
		center: 'title',
		right: ''
	},
	  events: function(start, end, timezone, callback) {
		jQuery.ajax({
			url: Url,
			type: 'POST',
			dataType: 'json',
			data: {
				start: start.format(),
				end: end.format(),
				_token : token
			},
			success: function(doc) {
			   var events = [];
				if(!!doc.allData){
					$.map( doc.allData, function( r ) {
						var jabatan ="";
		 			   		if (r.id_jabatan =="15") {
		 			   		var jabatan ="#1565c0"; //Eselon
						}else if (r.id_jabatan =="18") {
							var jabatan ="#37474f"; // Internal
						}else{
							var jabatan ="#00897b"; // KApus
						}
						events.push({
							id: r.id_rapat,
							title: r.agenda_rapat,
							start: r.start_tgl_rapat,
							end: r.end_date_end,
							color  : jabatan

						});
					});
				}
				 callback(events);
			}
		});
	},

	/**eventResize: function(event, delta, revertFunc) {
		alert(event.title + " end is now " + event.end.format());
		if (!confirm("is this okay?")) {
			revertFunc();
		}
	},*/

	editable: true,
	droppable: true, // this allows things to be dropped onto the calendar !!!
	drop: function(date) { // this function is called when something is dropped
		var original_date =date.format();
		var date = new Date(original_date);
		var day = date.getDate().toString();
			day = day.length > 1 ? day : '0' + day;
		var month = (1 + date.getMonth()).toString();
			month = month.length > 1 ? month : '0' + month;
		var start_date = day+'-'+month+'-'+ date.getFullYear();
		// retrieve the dropped element's stored Event Object
		var originalEventObject = $(this).data('eventObject');

		var $extraEventClass = $(this).attr('data-class');
		var $id_jabatan = $(this).attr('data-idJabatan');

		var modal =
		'<div class="modal fade">\
		  <div class="modal-dialog">\
		   <div class="modal-content">\
			 <div class="modal-body">\
			   <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
			   <form class="no-margin AddSchedule" id="AddSchedule" >\
				  <label>start date</label>\
				  <input class="middle form-control datepicker " autocomplete="off" type="text" value="'+start_date+'" name="start_tgl_rapat" >\
				  <label>end date</label>\
				  <input class="middle form-control datepicker" autocomplete="off" type="text" value="" name="end_tgl_rapat" />\
				  <label>Ruangan</label>\
				   <select class="middle form-control" name="id_ruangan">\
				   '+option+'\
				   </select>\
				   <label>Agenda</label>\
				  <input class="middle form-control" autocomplete="off" type="text" value="" name="agenda_rapat" />\
				  <label>Penanggung Jawab</label>\
					<input class="middle form-control" autocomplete="off" type="text" value="" name ="pj_rapat" />\
				  <label>Di Hadiri</label>\
					<select class="form-control" id="products" name="di_hadiri[]" data-tags="true" data-placeholder="Select an option" data-allow-clear="true">\
					'+optionUser+'\
				  </select>\
				  <input type="hidden" name="_token" value="{{ csrf_token() }}">\
			   </form>\
			 </div>\
			 <div class="modal-footer">\
				<button type="button" class="btn btn-sm btn-primary" data-action="delete"> Save</button>\
				<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
			 </div>\
		  </div>\
		 </div>\
		</div>';

		var modal = $(modal).appendTo('body');
		console.log(modal);
		modal.find('form').on('submit', function(ev){
			ev.preventDefault();
			alert('asdas');
			calEvent.title = $(this).find("input[type=text]").val();
			calendar.fullCalendar('updateEvent', calEvent);
			modal.modal("hide");
		});
		modal.find('button[data-action=delete]').on('click', function() {
			var data = $('#AddSchedule').serialize();
				$.ajax({
				type: "POST",
				dataType: "json",
				url: urlSave,
				data: data,
				success: function(data) {
					if(data.status ==true){
						window.location = urlSchedule;
					}
				}
			});
		});


		modal.modal('show').on('hidden', function(){
			modal.remove();
		});
		$('#products').select2({
			tags :"true",
			tokeSeparators :[","," "],
			multiple :true,
			 ajax: {
				url : urlCalender,
				type : "GET",
				dataType :"JSON",
				data: function(term, page) {
				  return {
					q: term
				  };
				},
				processResults: function(data, page) {
						return { results: data };
				 }

			  }
			});

		$('.datepicker').daterangepicker({
			locale :{
				format : 'DD-MM-YYYY h:mm:ss'
			},
			timePicker :true,
			singleDatePicker :true,
			showDrodowns :true,
		});
		// we need to copy it, so that multiple events don't have a reference to the same object
		var copiedEventObject = $.extend({}, originalEventObject);

		// assign it the date that was reported
		copiedEventObject.start = date;
		copiedEventObject.allDay = false;
		if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];

		// render the event on the calendar
		// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
		$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

		// is the "remove after drop" checkbox checked?
		if ($('#drop-remove').is(':checked')) {
			// if so, remove the element from the "Draggable Events" list
			$(this).remove();
		}
	},
	selectable: true,
	selectHelper: true,
	select: function(start, end, allDay) {

		bootbox.prompt("New Event Title:", function(title) {
			if (title !== null) {
				calendar.fullCalendar('renderEvent',
					{
						title: title,
						start: start,
						end: end,
						allDay: allDay,
						className: 'label-info'
					},
					true // make the event "stick"
				);
			}
		});

		calendar.fullCalendar('unselect');
	}
	,
	eventClick: function(calEvent, jsEvent, view) {
		//display a modal
		var modal =
		'<div class="modal fade">\
		  <div class="modal-dialog">\
		   <div class="modal-content">\
			 <div class="modal-body">\
			   <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
			   <form class="no-margin">\
				  <label>Change event name &nbsp;</label>\
				  <input class="middle" autocomplete="off" type="text" value="' + calEvent.title + '" />\
				 <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Save</button>\
			   </form>\
			 </div>\
			 <div class="modal-footer">\
				<button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Delete Event</button>\
				<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
			 </div>\
		  </div>\
		 </div>\
		</div>';


		var modal = $(modal).appendTo('body');
		modal.find('form').on('submit', function(ev){
			ev.preventDefault();
			calEvent.title = $(this).find("input[type=text]").val();
			calendar.fullCalendar('updateEvent', calEvent);
			modal.modal("hide");
		});
		modal.find('button[data-action=delete]').on('click', function() {
			calendar.fullCalendar('removeEvents' , function(ev){
				return (ev._id == calEvent._id);
			})
			modal.modal("hide");
		});

		modal.modal('show').on('hidden', function(){
			modal.remove();
		});
		//console.log(calEvent.id);
		//console.log(jsEvent);
		//console.log(view);
		// change the border color just for fun
		//$(this).css('border-color', 'red');
	}

});
})
	</script>
	<style type="text/css">
		.select2-container {
width: 100% !important;
padding: 0;
}
.daterangepicker{
z-index:9999 !important;
}
	</style>
@endsection

@stop
