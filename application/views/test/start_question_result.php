<?
/*echo "<pre>";
print_r($question_result);
echo "</pre>";*/
?>
<input  type="hidden" id="finish" value="1">
<h4>Тест окончен, правильных ответов: <span class="bg-green badge"><?=$right?></span>, неправильных: <span class="bg-red badge"><?=$wrong?></span></h4>
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