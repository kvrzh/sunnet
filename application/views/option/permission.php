<section class="content-header">
    <h1>Права доступа <?=$user->name?><small></small></h1>
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
    <?
/*echo "<pre>";
print_r($menu_user);
print_r($all_menu);
echo "</pre>";*/

    ?>
		<div class="box box-success">
            <div class="box-body">
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('option/permission_action');?>">
					<input type="hidden" name="user_id" value="<?=$user_id?>">
					<?if($all_menu):?>
						<?foreach($all_menu as $key=>$value):?>
			        		<div class="form-group">
							    <label class="col-md-3 control-label"><?=$value->title?></label>
							    <div class=" col-md-4">
							    	<input  type="text" name="permission[<?=$value->id;?>]"
							    	class="slider slider-horizontal" data-slider-id='blue' type="text" 
							    	data-slider-min="0" data-slider-max="1" id="R" data-slider-step="1" 
			                        data-slider-value="<?=in_array($value->id,$menu_user)?1:0?>">
							    </div>
							</div>
						<?endforeach;?>
					<?endif;?>

	                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                            <button type="submit" class="btn bg-black btn-block">Сохранить</button>
                        </div>
                	</div>

		       			 
		        </div>
		    </form>
            </div>
        </div>
	</div>
	

		
</section>
<script type="text/javascript">
$(document).ready(function(){
    var mySlider = $("input.slider").bootstrapSlider();
});
</script>