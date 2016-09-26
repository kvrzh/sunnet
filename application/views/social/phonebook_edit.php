<section class="content-header">
    <h1>Изменить  номер<small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('social/phonebook_edit_action');?>">
	        		<div class="form-group">
	        			<input type="hidden" name="id" value="<?=$phonebook->id?>">
			  			<label  class="control-label col-md-2">Имя*</label>
					  	<div class="col-md-6">
					  		<input type="text" value="<?=$phonebook->title?>" name="title" class="form-control" required>
					  	</div>	
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Телефон 1*</label>
					  	<div class="col-md-6">
					  		<input data-inputmask="'mask': '(999)999 99 99'" type="text" value="<?=$phonebook->phone1?>"  name="phone1" class="form-control" required>
					  	</div>	
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Телефон 2</label>
					  	<div class="col-md-6">
					  		<input data-inputmask="'mask': '(999)999 99 99'" type="text" value="<?=$phonebook->phone2?>" name="phone2" class="form-control" \>
					  	</div>	
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Отдел</label>
					  	<div class="col-md-6">
					  		<input type="text" value="<?=$phonebook->department?>" name="department" class="form-control" \>
					  	</div>	
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Коментарий</label>
					  	<div class="col-md-6">
					  		<textarea name="comment" class="form-control" ><?=$phonebook->comment?></textarea>
					  		
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
		<?if($this->session->userdata('user_role')==1):?>
        <a href="<?=base_url('social/phonebook_delete_action/'.$phonebook->id)?>" class="btn btn-block btn-danger btn-flat">Удалить</a> 
        <?endif;?>
    </div>

	</div>
	

		
</section>
<script type="text/javascript">
    $(":input").inputmask();

</script>