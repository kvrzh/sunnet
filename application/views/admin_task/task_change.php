<section class="content-header">
    <h1>Алдмин задача #<?=$task->id?></h1>
</section>
<section class="content">
<div class="row">
    <div class="col-md-7">
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

        <div class="box box-success">
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
            </div><!-- /.box-body -->
            </div>

        </div>
        <div class="col-md-5">

        <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('admin_task/task_change');?>">
            <input type="hidden" value="<?=$task->id?>" name="id">
        	<input type="hidden" value="<?=$task->type_id?>" name="type_id">
        	<div class="form-group">
	            <div class="col-md-12">
	        	<select name="status_id" class="form-control " <?=$task->status_id==4?'disabled':''?>>
	        	<?if($admin_status):?>
	        		<?foreach($admin_status as $key=>$value):?>
	        			<option value="<?=$value->id?>"  <?=($task->status_id==$value->id)?'selected':''?>><?=$value->title?></option>
	 
	                <?endforeach;?>
	        	<?endif?>
	        	</select>
	            </div>
            </div>
        	<div class="form-group">
                 <div class="col-md-12">
        		<textarea rows="6" name="comment_admin"  maxlength="250" class="form-control" placeholder="Коментарий"><?=$task->comment_admin?></textarea>
        	   </div>
            </div>
            <?if($task->type_id==1):?>
                <div class="form-group">
                    <label class="control-label col-md-7">Снять суму за ремонт</label>
                    <div class="col-md-2">
                        <input type="number" min="1" max="9999" value="<?=$task->mount_paid?>">
                        
                    </div>
                </div>
            <?endif;?>
        
            <div class="form-group">
            <div class="col-md-offset-4 col-md-8"  style="margin-top: 0px;">
                <button type="submit" class="btn bg-black btn-block">Изменить статус</button>
            </div>
            </div>
        </form>
    </div>
    </div>
<script type="text/javascript">
</script>

