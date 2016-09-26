<section class="content-header">
    <h1>Редактировать Отдел<small></small></h1>
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
         	<form  role="form" method="post" class="form-horizontal" >
         		<input type="hidden" name="id" value="<?=$branch->id?>">
        		<div class="form-group">
		  			<label  class="control-label col-md-2">Отдел*</label>
				  	<div class="col-md-6">
				  		<input type="text"  value="<?=$branch->title?>" name="title" class="form-control" required>
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
    </div>
    <div class="col-md-2">
    	<a href="<?=base_url('test/branch_remove/'.$branch->id)?>" class="btn btn-block bg-red">Удалить</a>
    	
    </div>
</div>
	
</section>