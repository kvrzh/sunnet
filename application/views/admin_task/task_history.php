<section class="content-header">
    <h1>История админ задачи #<?=$task_id?></h1>
</section>
<section class="content">
<div class="row">
<div class="col-md-7">
        <div class="box box-primary">
        <h4>Задача</h4>
            <div class="box-body">
    	<table class="table"><tbody>
		<tr><td>Тема</td><td><?=$task->subject?></td></tr>
		<tr><td>Тип</td><td><span class="label bg-g"><?=$task->type?></span></td></tr>
		<tr><td>Статус</td>  <td><span class="badge" style="background-color:<?=$task->status_color?>"><?=$task->status?></span></td></tr>
		<tr><td>Создана</td><td><i class="ion-person"></i> <?=$task->user?> <i class="ion-calendar"></i> <?=default_dt($task->created)?> </td></tr>
		<tr><td>Дата выполнения</td><td><?=dt_calendar($task->start)?> <?=$task->start_time?> </td></tr>
		<tr><td>Выполнена</td><td><i class="ion-person"></i> <?=$task->admin?> <i class="ion-calendar"></i> <?=default_dt($task->finish)?> </td></tr>
		<tr><td>Дополнительно</td><td>
        	<?if($task->urgency==1):?>
        	<span class="badge bg-red">Срочная</span>
        	<?endif;?>
        	<?if($task->sms==1):?>
        	<span class="badge bg-yellow">sms</span>
        	<?endif;?>
        </td></tr>
        <tr><td>Коментарий</td><td><?=$task->comment?></td></tr>
	</tbody></table>
	</div>
	</div>
</div>
        <?if($this->session->flashdata('success')):?>
          <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?=$this->session->flashdata('success')?>
          </div>
        <?endif;?>
            <?if($this->session->flashdata('danger')):?>
      <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?=$this->session->flashdata('danger')?>
      </div>
    <?endif;?>
    <div class="col-md-12">
        <div class="box box-success">
        <h4>История</h4>
            <div class="box-body">
            	<?if($history):?>
            		<div class="table-responsive">
					<table id="data" class="table table table-striped table-bordered" cellspacing="0" width="100%">
					    <thead>

					        <tr>   
					        <th>Дата</th>
					        <th>Статус</th>
					        <th>Пользователь</th>
					        <th>Коментарий</th>
					    </thead> <tbody>
					        <?foreach($history as $key=>$value):?>
					        <tr>
					        	<td><?=default_dt($value->date)?></td>
					        	<td><span class="badge" style="background-color:<?=$value->status_color?>"><?=$value->status?></span></td>
					        	<td><?=$value->admin?></td>
					        	<td width="65%"><?=$value->comment_admin?></td>
					        </tr>
					        <?endforeach;?>  
					</tbody></table>
					</div>
            	<?endif;?>
    		</div>
    	</div>
    </div>
</div>
</section>
<script type="text/javascript">
</script>

