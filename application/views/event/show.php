<section class="content-header">
    <h1>Event<small></small></h1>
</section>

<section class="content">
<div class="row">
	<div class="col-md-9">
		<?if($this->session->flashdata('success')):?>
			<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?=$this->session->flashdata('success')?>
			</div>
		<?endif;?>
		<?if($event->status_id==1):?>
			<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?=$event->status?>
		</div>
		<?endif;?>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<div class="info-box">
			<span class="info-box-icon bg-red"><i class="ion-ios-star-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text"><?=lang('name')?></span>
				<span class="info-box-number"><?=$event->title?></span>
			</div><!-- /.info-box-content -->
		</div>
	</div>
	<div class="col-md-3">
		<div class="info-box">
			<span class="info-box-icon bg-orange"><i class="ion-ios-toggle-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text"><?=lang('type')?></span>
				<span class="info-box-number"><?=$event->type?></span>
			</div><!-- /.info-box-content -->
		</div>
	</div>
		<div class="col-md-3">
		<div class="info-box">
			<span class="info-box-icon bg-green"><i class="ion-ios-checkmark-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text"><?=lang('status')?></span>
				<span class="info-box-number"><?=$event->status_text?></span>
			</div><!-- /.info-box-content -->
		</div>
	</div>
	<div class="col-md-1">

	</div>
</div>
<div class="row">

	<div class="col-md-4">
	<img  class="img-responsive" src="<?=base_url($event->img)?>">
	</div>
	<div class="col-md-5">
		<div class="box box-success">
			<div class="box-header with-borer">

					<p class="lead"><?=lang('location')?></p>
					<div class="table-responsive">
						<table class="table">
						<tbody>
						<tr><th style="width:50%"><?=lang('country')?>:</th><td><?=$event->country?></td></tr>
						<tr><th><?=lang('province')?>:</th><td><?=$event->sub?></td></tr>
						<tr><th><?=lang('city')?>:</th><td><?=$event->city?></td></tr>
						<tr><th><?=lang('address')?>:</th><td><?=$event->adress?></td></tr>
						</tbody></table>
					</div>
			</div>
		</div>
    </div>
    <div class="col-md-2">
		<?if($event->status_id==0 || $event->status_id==1):?>
			<input type="hidden" id="event_id" value="<?=$event->id?>">
			<button id="delete" type="button" class="btn btn-block btn-danger btn-flat"><?=lang('delete')?></button>
			<a  href="<?=base_url('event/change/'.$event->id)?>" class="btn btn-block btn-success btn-flat">Change</a>		
		<?endif;?>
		<?if($event->status_id==4):?>
			<input type="hidden" id="event_id" value="<?=$event->id?>">
			<button id="delete" type="button" class="btn btn-block btn-danger btn-flat"><?=lang('delete')?></button>
			<a  href="<?=base_url('event/change/'.$event->id)?>" class="btn btn-block btn-success btn-flat"><?=lang('create_again')?></a>		
		<?endif;?>
    	
    </div>



</div>

<div class="row">

	<div class="col-md-5">
		<div class="box">
		<div class="box-header with-borer"></div>

		<p class="lead"><?=lang('desc')?></p>
		<p><?=$event->description?></p>
		</div>	
	</div>
		<div class="col-md-4">
		<div class="box">
		<div class="box-header with-borer"></div>

		<p class="lead"><?=lang('date')?></p>
			<div class="table-responsive">
			<table class="table"><tbody>
			<tr><th style="width:50%"><?=lang('begin')?></th><th><?=lang('end')?></th></tr>
			<?if($dates):?>
				<?foreach($dates as $value):?>
					<tr><td><?=dt($value->date_start)?></td><td><?=dt($value->date_end)?></td></tr>
				<?endforeach;?>
			<?endif?>
			</tbody></table>

		</div>	
	</div>
</div>
	
</section>
<script type="text/javascript">
	$('#delete').on('click',function(){
		bootbox.confirm('You want delete this event?',function(result){
			if(result){
				$.ajax({
					type:"POST",
					url:"<?=base_url('event/action/delete');?>",
					data:{
						event_id:$('#event_id').val()
					},
					success:function(result){
						window.location="<?=base_url('event/action/all');?>"
						
					}

				});
			}
		});
	});
</script>
