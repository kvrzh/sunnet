<section class="content-header">
    <h1>Календарь <?=$head?><small></small></h1>
</section>
<section class="content">

<div class="row">
	<div class="col-md-10">
	    <?if($this->session->flashdata('danger')):?>
      <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?=$this->session->flashdata('danger')?>
      </div>
    <?endif;?>
    <?
    /*echo "<pre>";
    print_r($events);
    echo "</pre>";*/
    ?>
		<div class="box box-success">
            <div class="box-body">
				<div id='calendar'></div>
			</div>
		</div>
		<div class=" col-md-offset-3 col-md-4">
			<button class="btn btn-block bg-green" id="save_calendar" >Сохранить параметры</button>
		</div>
	</div>
</div>

</section>
<script>
var succesMessage=function(msg,form){
         var message = '<div class="alert alert-success alert-dismissable">';
            message += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
            message +=  msg;
            message +=  '</div>';
            $(form).fadeOut(500, function(){
                $(form).before(message).fadeIn();
            });
}
	$(function() { // document ready

		$('#calendar').fullCalendar({
			lang:'ru',
			minTime:"09:00:00",

			defaultView: 'agendaDay',
			
			editable: true,
			selectable: true,
			//eventLimit: true, // allow "more" link when too many events
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'agendaDay,agendaWeek,month'
			},
			views: {
				month: {
					type: 'agenda',
					editable: false,
				},
					agendaWeek: {
					type: 'agenda',
					editable: false,
				},
			},

			//// uncomment this line to hide the all-day slot
			//allDaySlot: false,

			resources: [
				<?if($groups):?>
					<?foreach($groups as $key=>$value):?>
						{ id: '<?=$value->id?>', title: '<?=$value->title?>' },
						<?endforeach;?>
				<?endif;?>
			],
			events: [
				<?if($events):?>
					<?foreach($events as $key=>$value):?>
						{ id: "<?=$value['id']?>", resourceId: "<?=$value['resource']?>", color: "<?=$value['color']?>", start: "<?=$value['start']?>", end: "<?=$value['end']?>",title:"<?=$value['title'].'|'.$value['status']?>",textColor:"<?=$value['urgency']==1?'yellow':'white'?>" },
						<?endforeach;?>
				<?endif;?>
			],

			select: function(start, end, jsEvent, view, resource) {
				console.log('select');
				console.log(
					'select',
					start.format(),
					end.format(),
					resource ? resource.id : '(no resource)'
				);
			},
	    eventRender: function(event, element) {
        $(element).find('.fc-title').append('<br><a href="<?=base_url('operator/repair_change')?>/'+event.id+'" style="color:#00a65a" target="blank" class="delete-event-link"><i class="ion-edit"></i> Редактировать</a>');
        //$(element).find('.fc-title').append('<br><a href="#" class="delete-event-link">delete</a>');
      
        $(element).find('.delete-event-link').click(function(e) {
            e.stopImmediatePropagation(); //stop click event, add deleted click for anchor link
           // alert('deleted');
          	console.log(event.id);
        });
      },
			dayClick: function(date, jsEvent, view, resource) {
						console.log('click');
				console.log(
					'dayClick',
					date.format(),
					resource ? resource.id : '(no resource)'
				);
			}
			,
		});

$('.fc-toolbar .fc-left').prepend(
    $('<button type="button" class=" btn bg-green">Сохранить параметры</button>')
        .on('click', function() {
        	save_calendar();

 
        }));
	
	});
function save_calendar(){
	        	var mode = $('#calendar').fullCalendar('getView');
        	if(mode.name=="agendaDay"){
        	var all_events=$('#calendar').fullCalendar('clientEvents');
        		var date = $('#calendar').fullCalendar('getDate');
        		current_date=moment(date).startOf('day');
        		next_date=moment(current_date).add(1, 'day');

        		var data={};

        		$.each(all_events,function(key,event){
        			var start=moment(event.start);
        			var end=moment(event.end);
      

        			if(start>=current_date && start<=moment(next_date)){
        				id=event.id;
        				title=event.title;
        				resource=event.resourceId;
        				data[id]={
        					'id':id,
        					'title':title,
        					'group_id':resource,
        					'start':start.format("YYYY-MM-DD HH:mm"),
        					'end':end.isValid()?end.format("YYYY-MM-DD HH:mm"):"0",
        					'active':start.format("HH:mm")=="00:00"?0:1,
        				}
    				 	//data[event.id].id=event.id;
						//data[event.id].title=event.title

        			}
        		});
   
        		$.ajax({
        			url:"<?=base_url('operator/change_calendar')?>",
        			method:"POST",
        			data:data,
        			success:function(result){
        				//console.log(result);
        				succesMessage("Тз успешно назначено",'.box')

        			}
        		});
    		}

}

$('#save_calendar').on('click',function(){
	save_calendar();
});
</script>