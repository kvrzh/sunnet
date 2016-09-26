<section class="content-header">
    <h1>Ведомость <small></small></h1>
</section>
<section class="content">
<?
?>

<div class="row">
	<div class="col-md-8">

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
	<div class="col-md-4">
		<div id="sheet_salary">
			
		</div>	
	</div>
</div>
</div>


</section>
<script>
function get_salary(){
	var date=$('#calendar').fullCalendar('getDate').format();
	console.log(date);
	var data={
		user_id:"<?=$user->id?>",
		date:date
	};
	$.ajax({
		type:"POST",
		url:"<?=base_url('budget/sheet_salary')?>",
		data:data,
		success:function(result){
			$("#sheet_salary").html(result);

		}
	})
}
$(function() { // document ready

		$('#calendar').fullCalendar({
			lang:'ru',

			defaultView: 'month',
			defaultDate: '<?=$date?>',
			//eventLimit: true, // allow "more" link when too many events
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month'
			},
			    events: [
		<?if($calendar):?>
		<?foreach($calendar as $key=>$value):?>
		{
          	title  : "<?=$value['koef_value']?>x"+"<?=$value['koef_wage']?>= "+"<?=$value['koef']?>грн",
            start  : "<?=$key?>",
            color: "#00A65A",
        },    
        {
            title  : "<?=$value['hour_value']?>x"+"<?=$value['hour_wage']?>= "+"<?=$value['hour']?>грн",
            start  : "<?=$key?>",
            color: "#337ab7 ",
        },

        <?endforeach;?>
        <?endif;?>

    ]

	
	});
			get_salary();
		$('.fc-next-button').click(function(){
		   get_salary();
		});

		$('.fc-prev-button').click(function(){
		   get_salary();
		});

});

</script>