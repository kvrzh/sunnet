<section class="content-header">
    <h1>Отработаное время<small></small></h1>
</section>
<section class="content">
<?
/*echo "<pre>";
print_r($events);
echo "</pre>";*/
?>
<div class="row">
	<div class="col-md-12">
	    <?if($this->session->flashdata('danger')):?>
      <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?=$this->session->flashdata('danger')?>
      </div>
    <?endif;?>
		<div class="box box-success">
            <div class="box-body">
				<div id='calendar'></div>
			</div>
		</div>
	</div>
</div>

<div id="calendarModal" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
            <h4 id="modalTitle" class="modal-title"></h4>
        </div>
        <div id="modalBody" class="modal-body"> </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        </div>
    </div>
</div>
</div>
</section>
<script>
	$(function() { // document ready
		$('#calendar').fullCalendar({
			editable: false,
			aspectRatio: 1.8,
			header: {
				left: 'today prev,next',
				center: 'title',
				right: 'timelineMonth'
			},
			defaultView: 'timelineMonth',
			resourceAreaWidth: '15%',
			resourceLabelText: 'Работники',
			resources: [
				<?if($resources):?>
				<?foreach($resources as $r_key => $r_value):?>
				{id: "<?=$r_key?>" ,title: "<?=$r_value?>", eventColor: 'red'  },
				<?endforeach;?>
				<?endif;?>
			],
			events: [
				<?if($events):?>
				<?foreach($events as  $day=>$day_event):?>
					<?if($day_event):?>
					<?foreach($day_event as $e_key => $e_value):?>
						<?if(isset($e_value['total_hour'])):?>
						{ id: "1", resourceId: "<?=$e_value['user_id']?>", start: "<?=$day?>", end: "<?=$day?>", title: "<?=$e_value['total_hour']?>",desc:"",color:"blue"},
						<?endif;?>
						<?if(isset($e_value['hour'])):?>
						{ id: "1", resourceId: "<?=$e_value['user_id']?>", start: "<?=$day?>", end: "<?=$day?>", title: "<?=$e_value['hour']?>",desc:"<?=$e_value['time']?>"},
						<?endif?>
					<?endforeach;?>
					<?endif;?>
				<?endforeach;?>
				<?endif;?>
			],

			eventClick: function(event){
    		var res = $('#calendar').fullCalendar( 'getResourceById', event.resourceId );
    		var day =moment(event.start).format("YYYY-MM-DD"); 
            $('#modalTitle').html(res.title+" "+day);
            $('#modalBody').html("Всего отработано "+ event.title+ "ч.<br>"+event.desc);
            //$('#eventUrl').attr('href',event.url);
            $('#calendarModal').modal();
},
		});
	
	});

</script>