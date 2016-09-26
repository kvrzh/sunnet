<section class="content-header">
    <h1>Создать блок вопросов<small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" >
					<div class="form-group">
				  	<label class="control-label col-md-2">Пользователи*</label>
					  	<div class="col-md-6">
								<select name="user[]"  id="user" class="form-control" required multiple="">
									<option></option>
									<?if($user):?>

										<?foreach($user as $key=>$value):?>
											<option value="<?=$value->id?>"><?=$value->name?></option>
										<?endforeach;?>
									<?endif;?>
								</select>
			  			</div>
		  			</div>
		  			<?if($branch):?>
		  				<?foreach($branch as $br):?>
			  				<div class="form-group">
			  					<label class="control-label col-md-2"><?=$br->title?></label>
			  					<?if($br->theme):?>
										<div class="col-md-5">
											<select name="theme[<?=$br->id?>][]" class="form-control theme" multiple="">
											<option></option>
											<?foreach($br->theme as $key=>$value):?>
												<option question_count="<?=$value->question_count?>" value="<?=$value->id?>"><?=$value->title?></option>
											<?endforeach;?>
											</select>
				  						</div>
			  							<label class="control-label col-md-1">Вопросов</label>
				  						<div class="col-md-2">
				  							<input  value="0" class="form-control question_count " type="number" min="0" name="question_count[<?=$br->id?>]" max="0" required>
				  						</div>
			  					
			  					<?endif;?>

			  				</div>
			  				<?endforeach;?>
		  			<?endif;?>

	                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                            <button type="submit" class="btn bg-black btn-block" disabled="true">Сохранить</button>
                        </div>
                	</div>


		       			 
		        
		    </form>
		    </div>
            </div>
        </div>
	</div>
	</section>
	

		
<script type="text/javascript">
$(document).ready(function(){
	$('#user').select2({placeholder:"Виберите пользователя"});
	$('.theme').select2({placeholder:"Виберите тему"});
	$('.theme').on('change',function(){
		$('.question_count').attr('max',0);
		var selected=$('.theme option:selected');
		$.each(selected,function(){
			var theme_count =$(this).attr('question_count');
			var input=$(this).parent('select').parent('div').parent('div').find('.question_count');
			var max=input.attr('max');
			input.attr('max',parseInt(max)+parseInt(theme_count));

		});
	});

	$('.question_count').on('keyup change',function(){
		var countTotal=0;
		$.each($('.question_count'),function(){
			count=parseInt($(this).val());
			countTotal=countTotal+count
		})
		if(countTotal==20){
			$('.btn').attr('disabled',false)
		}
		else{
			$('.btn').attr('disabled',true)
		}
		
	});

})
</script>