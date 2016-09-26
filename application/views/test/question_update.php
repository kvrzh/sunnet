<section class="content-header">
    <h1>Редактировать вопрос <small>тема <?=$theme->title?></small></h1>
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
        <input type="hidden" name="id" value="<?=$question->id?>">
            <div class="box box-success">
                <div class="box-body">
                    <div class="form-group">
                        <label  class="control-label col-md-2">Вопрос*</label>
                        <div class="col-md-10">
                            <textarea class="form-control"  name="text" required><?=$question->text?></textarea>
                        </div>  
                    </div>
                    <div class="form-group">
                        <label  class="control-label col-md-2">Коментарий*</label>
                        <div class="col-md-10">
                            <textarea class="form-control"  name="comment" required><?=$question->comment?></textarea>
                        </div>  
                    </div>
                    <div class="form-group">                    
                        <label  class="control-label col-md-2">Приортет*</label>
                        <div class="col-md-1">
                            <input class="form-control" type="number" min="1" max="10"  value="<?=$question->priority?>" name="priority">
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
                            <input class="form-control" name="ans1" value="<?=$question->ans1?>" required >
                        </div>
                        <div class="radio col-md-1">
                          <label><input type="radio"  name="right" value="ans1" <?=$question->right=='ans1'?'checked':''?>></label>
                        </div>      
                    </div>
                        <div class="form-group">
                        <label  class="control-label col-md-2">Ответ 2*</label>
                        <div class="col-md-9">
                            <input class="form-control" name="ans2" value="<?=$question->ans2?>" required>
                        </div>
                        <div class="radio col-md-1">
                          <label><input type="radio" name="right" value="ans2" <?=$question->right=='ans2'?'checked':''?>></label>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label  class="control-label col-md-2">Ответ 3*</label>
                        <div class="col-md-9">
                            <input class="form-control" name="ans3" value="<?=$question->ans3?>" required>
                        </div>
                        <div class="radio col-md-1">
                          <label><input type="radio" name="right" value="ans3" <?=$question->right=='ans3'?'checked':''?>></label>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label  class="control-label col-md-2">Ответ 4*</label>
                        <div class="col-md-9">
                            <input class="form-control" name="ans4" value="<?=$question->ans4?>" required >
                        </div>

                        <div class="radio col-md-1">
                          <label><input type="radio" name="right" value="ans4" <?=$question->right=='ans4'?'checked':''?>></label>
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
    <div class="col-md-2">
        <a href="<?=base_url('test/question_remove/'.$question->id)?>" class="btn btn-block bg-red">Удалить</a>
        <?if($question->photo):?>
        <img src="<?=base_url($question->photo)?>" class="img img-responsive" style="margin-top:10px"  data-toggle="lightbox"  href="<?=base_url($question->photo)?>">  
        <?endif;?>
    </div>
</div>

    
</section>
<script type="text/javascript">
    $('#img').ekkoLightbox();
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});

</script>