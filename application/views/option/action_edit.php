<section class="content-header">
    <h1>Редактировать тариф<small></small></h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-10">
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('option/action_edit_action');?>">
             		<input type="hidden" name="id" value="<?=$action->id?>">
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Название*</label>
				  	<div class="col-md-6">
				  		<input type="text" value="<?=$action->title?>" name="title" class="form-control" required>
				  	</div>	
				  	</div>
	
					<div class="form-group">
					  	<label class="control-label col-md-2">Тип*</label>
					  	<div class="col-md-4">
								<select name="type" class="form-control">
									<option value="1" <?=1==$action->type?"selected":""?> >Тариф 1</option>
									<option value="2" <?=2==$action->type?"selected":""?> >Тариф IpTV</option>
		
								</select>
					  	</div>
						 		
					</div>
					
	                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                            <button type="submit" class="btn bg-black btn-block">Сохранить</button>
                        </div>
                	</div>

		       			 
		        </div>
		    </form>
            </div>
        </div>
    <div class="col-md-2">
        <a href="<?=base_url('option/action_delete_action/'.$action->id)?>" class="btn btn-block btn-danger btn-flat">Удалить</a> 
    </div>

	</div>
	

		
</section>
<script type="text/javascript">

</script>