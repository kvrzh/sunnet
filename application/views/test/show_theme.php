<section class="content-header">
    <h1>Все Вопросы</h1>
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
    	</div>
	</div>
	<div class="row">
		<div class="col-md-6">
		<div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion-ios-star-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Название</span>
                <span class="info-box-number"><?=$theme->title?></span>
            </div><!-- /.info-box-content -->
        </div>
		</div>
		<div class="col-md-3">
		<div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion-ios-person-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Отдел</span>
                <span class="info-box-number"><?=$theme->branch_title?></span>
            </div><!-- /.info-box-content -->
        </div>
		</div>
		<div class="col-md-3">
		<div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion-ios-help-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Вопросов</span>
                <span class="info-box-number"><?=$theme->question_count?></span>
            </div><!-- /.info-box-content -->
        </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10">

	      <?if($question):?>
	      <div class="panel-group" id="accordion">
			<?foreach($question as $key=>$value):?>
		    	<div class="panel panel-default">
			      <div class="panel-heading">
			        <h4 class="panel-title">
			          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$key?>"><?=substr($value->text, 0,20)?> ...</a>
			        </h4>
			      </div>
			      <div id="collapse<?=$key?>" class="panel-collapse collapse">
			        <div class="panel-body row">
			         <?if($value->photo):?>
		                <div class="col-md-4">
		                <img class="img img-responsive" src="<?=base_url($value->photo)?>">
		                    
		                </div>
		                <div class="col-md-8">
		                <b><?=$value->text?></b>
		                 
		                </div>

		            <?else:?>
		            	<div class="col-md-12">
		                <b><?=$value->text?></b>    	
		            	</div>
		            <?endif?>
		            <div class="col-md-12">
		            	<p><?=$value->comment?></p>
		            </div>
			        </div>
			      </div>
			    </div>
			<?endforeach;?>
		</div>
		<?endif;?>
			
		</div>
	</div>
</section>
