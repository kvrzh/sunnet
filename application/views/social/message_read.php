<section class="content-header">
    <h1>Сообщение</h1>
</section>
<?
/*echo "<pre>";
print_r($message);
echo "</pre>";*/

?>
<section class="content">
    <div class="row">
        <div class="col-md-10">
            <?if($this->session->flashdata('danger')):?>
      <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?=$this->session->flashdata('danger')?>
      </div>
    <?endif;?>
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Прочитать сообщение</h3>
                </div>
                <div class="mailbox-read-info">
                    <h3><?=$message->subject?><span class="badge bg-green pull-right"><?=default_dt($message->date)?></span></h3>
                   
                    
                </div>
              <hr>
                <div class="box-body">
                    <div class="mailbox-read-message">
                        <?=$message->text?>
                    </div>
                    <?if($message->file):?>
                        <h5>
                        <i class="fa fa-paperclip"></i>
                        <a href="<?=base_url('uploads/files/'.$message->file)?>"><?=$message->file?></a>
                        </h5>
                    <?endif;?>
                </div> 
            </div>
            <?if(isset($dialog)):?>
    <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Диалог</h3>
        </div>

        <?foreach($dialog as $key=>$value):?>
        <div class="direct-chat-info clearfix">
            <span class="direct-chat-name pull-left"><?=$value->sender?></span>
            <span class="direct-chat-timestamp pull-right"><?=default_dt($value->date)?></span>
        </div>
        <div class="direct-chat-text">
            <b><?=$value->subject?>: </b><?=strip_tags($value->text)?>
            </div>
        <?endforeach;?>
        </div>
<?endif;?>
        
        </div>
            <div class="col-md-2">
        <a href="<?=base_url('social/message_create/'.$message->id)?>" class="btn btn-block btn-danger btn-flat">Ответить</a> 
      
    </div>

                

        
    </div>
    </div>
</section>




