<section class="content-header">
    <h1>Добавить вопрос <small>тема <?=$theme->title?></small></h1>
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
 	<form enctype="multipart/form-data" role="form" method="post" class="form-horizontal" >
 		<input type="hidden" name="theme_id" value="<?=$theme->id?>">
			<div class="box box-success">
	   		 	<div class="box-body">
		    		<div class="form-group">
			  			<label  class="control-label col-md-2">Вопрос*</label>
					  	<div class="col-md-10">
					  		<textarea class="form-control" name="text" required></textarea>
					  	</div>	
					</div>
		    		<div class="form-group">
			  			<label  class="control-label col-md-2">Коментарий*</label>
					  	<div class="col-md-10">
					  		<textarea class="form-control" name="comment" required></textarea>
					  	</div>	
					</div>
					<div class="form-group">                    
			  			<label  class="control-label col-md-2">Приортет*</label>
					  	<div class="col-md-1">
					  		<input class="form-control" type="number" min="1" max="10" value="1" name="priority">
					  	</div>
						<label class="control-label col-md-2">Прикрепить</label>                  
						<div class="col-md-4">
		                         <input type="file" name="file">
		                </div>
		            </div>
	        	</div>
		    </div>
			<div class="box box-primary">
	   		 	<div class="box-body">
		    		<div class="form-group">
			  			<label  class="control-label col-md-2">Ответ 1*</label>
					  	<div class="col-md-9">
					  		<input class="form-control" name="ans1" required>
					  	</div>
						<div class="radio col-md-1">
						  <label><input type="radio" checked="" name="right" value="ans1"></label>
						</div>		
					</div>
			    		<div class="form-group">
			  			<label  class="control-label col-md-2">Ответ 2*</label>
					  	<div class="col-md-9">
					  		<input class="form-control" name="ans2" required>
					  	</div>
						<div class="radio col-md-1">
						  <label><input type="radio" name="right" value="ans2"></label>
						</div>		
					</div>
		    		<div class="form-group">
			  			<label  class="control-label col-md-2">Ответ 3*</label>
					  	<div class="col-md-9">
					  		<input class="form-control" name="ans3" required>
					  	</div>
						<div class="radio col-md-1">
						  <label><input type="radio" name="right" value="ans3"></label>
						</div>		
					</div>
		    		<div class="form-group">
			  			<label  class="control-label col-md-2">Ответ 4*</label>
					  	<div class="col-md-9">
					  		<input class="form-control" name="ans4" required>
					  	</div>

						<div class="radio col-md-1">
						  <label><input type="radio" name="right" value="ans4"></label>
						</div>		
					</div>

	   		 	</div>
   		 	</div>
            <div class="form-group">
                <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                    <button type="submit" class="btn bg-black btn-block">Сохранить</button>
                </div>
			</div>
	</form>
    </div>
</div>
	
</section>