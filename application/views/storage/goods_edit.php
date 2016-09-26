<section class="content-header">
    <h1>Изменить инвентарь<small></small></h1>
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
             <form role="form" method="post"   class="form-horizontal formself" data-toggle="validator" action="<?php echo base_url('storage/goods_edit_action');?>">
             		<input type="hidden" name="id" value="<?=$goods->id?>">
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Название*</label>
				  	<div class="col-md-6">
				  		<input type="text" value="<?=$goods->title?>" name="title" class="form-control" data-error="Поле не может быть пустым" required>
					<div class="help-block with-errors"></div>
				  	</div>	
					</div>
					<div class="form-group">
					  	<label class="control-label col-md-2">Единицы*</label>
					  	<div class="col-md-4">
								<select name="unit" class="form-control">
								<?foreach($units as $key=>$value):?>
									<option value="<?=$value->short?>" <?echo ($value->short==$goods->unit)?"selected='selected'":""?>><?=$value->title;?></option>
								<?endforeach;?>
		
								</select>
					  	</div>
  					  	<label  class="control-label col-md-2">Цена</label>
					  	<div class="col-md-4">
					  		
					  		<input  value="<?=$goods->price?>" pattern="[0-9]+([\.,][0-9]+)?" name="price" data-error="Неверный формат" class="form-control">
					  			<div class="help-block with-errors"></div>
					  	</div>
						 		
					</div>
					<div class="form-group">
						 		
					</div>
	                <div class="form-group">
						<label type="text" class=" control-label col-md-2">Детально</label>
						<div class="  col-md-10">
							<textarea class="form-control" rows="3" name="description"><?=$goods->description?></textarea>
                             <div class="help-block with-errors"></div>

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
        <a href="<?=base_url('storage/goods_delete_action/'.$goods->id)?>" class="btn btn-block btn-danger btn-flat">Удалить</a> 
    </div>

	</div>
	

		
</section>
<script type="text/javascript">

</script>