<input  type="hidden" id="finish" value="0">
<?if($question):?>

<div class="box box-success">
    <div class="box-body">
        <div class="row">
            <?if($question->photo):?>
                <div class="col-md-4">
                <img class="img img-responsive" src="<?=base_url($question->photo)?>">
                </div>
                <div class="col-md-8">
                <b><?=$question->text?></b>
                </div>
            <?else:?>
            	<div class="col-md-12">
                <b><?=$question->text?></b>    	
            	</div>
            <?endif?>
        </div>
    </div>
</div>
<div class="box box-primary">
    <div class="box-body">
            <input type="hidden" name="id" value="<?=$question->id?>">
            <input type="hidden" name="pos" value="<?=$question->pos?>">
            <input type="hidden" name="right_question" value="<?=$question->right_question?>">
            <?php switch (rand(1,4)): case 1:?>
                    <p><label><input type="radio" checked="" name="right" value="ans1"> <?=$question->ans1?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans2"> <?=$question->ans2?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans3"> <?=$question->ans3?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans4"> <?=$question->ans4?></label></p><hr>
                    <?php break;?>
              <?php case 2: ?>
                    <p><label><input type="radio" checked="" name="right" value="ans3"> <?=$question->ans3?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans4"> <?=$question->ans4?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans1"> <?=$question->ans1?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans2"> <?=$question->ans2?></label></p><hr>
                    <?php break;?>
             <?php case 3: ?>
                    <p><label><input type="radio" checked="" name="right" value="ans4"> <?=$question->ans4?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans1"> <?=$question->ans1?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans3"> <?=$question->ans3?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans2"> <?=$question->ans2?></label></p><hr>
                    <?php break;?>
             <?php case 4: ?>
                    <p><label><input type="radio" checked="" name="right" value="ans2"> <?=$question->ans2?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans1"> <?=$question->ans1?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans4"> <?=$question->ans4?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans3"> <?=$question->ans3?></label></p><hr>
                    <?php break;?>
             <?php default: ?>
                    <p><label><input type="radio" checked="" name="right" value="ans2"> <?=$question->ans2?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans1"> <?=$question->ans1?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans3"> <?=$question->ans3?></label></p><hr>
                    <p><label><input type="radio" checked="" name="right" value="ans4"> <?=$question->ans4?></label></p><hr>
            <?php endswitch ?>
    </div>
</div>
<div class="col-md-4 col-md-offset-4">
    <button class="btn btn-block bg-blue" id="answer">Ответить</button>
</div>
<?else:?>
<h3>Тест закончен</h3>
<?endif;?>