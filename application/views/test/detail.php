<section class="content-header">
    <h1>Результаты тестирования</h1>
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
		<div class="col-md-3">
		<div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion-ios-person-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Пользователь</span>
                <span class="info-box-number"><?=$task->user_name?></span>
            </div><!-- /.info-box-content -->
        </div>
		</div>
		<div class="col-md-3">
		<div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion-ios-calendar-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Начал</span>
                <span class="info-box-number"><?=default_dt($task->start)?></span>
            </div><!-- /.info-box-content -->
        </div>
		</div>
		<div class="col-md-3">
		<div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion-ios-time-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Потратил</span>
                <span class="info-box-number"><?=($task->start && $task->finish)?default_ms($task->finish-$task->start):''?></span>
            </div><!-- /.info-box-content -->
        </div>
		</div>
		<div class="col-md-3">
		<div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion-ios-help-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Ошибок</span>
                <span class="info-box-number"><?=$task->wrong?></span>
            </div><!-- /.info-box-content -->
        </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10">

	      <?if($question_result):?>
			<?foreach($question_result as $key=>$value):?>
				<div class="box collapsed-box <?=$value->right==0?'box-danger':'box-success'?>">
		        <div class="box-header with-border">
		          <h3 class="box-title"><?=substr($value->text, 0,20)?> ...</h3>

		          <div class="box-tools pull-right">
		            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
		              <i class="fa fa-plus"></i></button>
		          </div>
		        </div>
		        <div class="box-body" style="display: none;">
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
		        </div>
		        <!-- /.box-body -->
		        <div class="box-footer" style="display: none;">
			        <table class="table">
			        	<tbody>
			        		<tr class="<?=$value->answer=='ans1'?'bg-red':''?> <?=$value->right_question=='ans1'?'bg-green':''?>"><td><?=$value->ans1?></td></tr>
			        		<tr class="<?=$value->answer=='ans2'?'bg-red':''?> <?=$value->right_question=='ans2'?'bg-green':''?>"><td><?=$value->ans2?></td></tr>
			        		<tr class="<?=$value->answer=='ans3'?'bg-red':''?> <?=$value->right_question=='ans3'?'bg-green':''?>"><td><?=$value->ans3?></td></tr>
			        		<tr class="<?=$value->answer=='ans4'?'bg-red':''?> <?=$value->right_question=='ans4'?'bg-green':''?>"><td><?=$value->ans4?></td></tr>
			        	</tbody>
			        </table>
		        </div>
		        <!-- /.box-footer-->
		      </div>
			<?endforeach;?>
		<?endif;?>
			
		</div>
	</div>
</section>
