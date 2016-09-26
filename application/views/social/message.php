<section class="content-header">
    <h1>Список сообщения</h1>
</section>
<section class="content">
<div class="row">
    <div class="col-md-12">
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
        <div class="box box-primary">
            <div class="box-header with-border"><h3 class="box-title"><?=$head?></h3></div>
            <a href="<?=base_url('social/message_create')?>" style="margin-bottom:10px"class="btn btn-primary  margin-bottom"><i class="fa fa-paper-plane"></i>Создать сообщение</a>
            <?if($message):?>
                 <div class="table-responsive">
                <table class="table" id="table">
                <thead>
                    <tr>
                    <th></th>
                    <th>Тема</th>
                    <th>Получатель</th>
                    <th>Отправитель</th>
                    <th style="width:40%">Сообщение</th>
                    <th style="width:14%">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?foreach($message as $key=>$value):?>
                    <tr>
                        <?if($value->read==1):?>
                        <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                        <?else:?>
                        <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                        <?endif;?>
                        <td class="mailbox-name"><a href="<?=base_url('social/message_read/'.$value->id)?>"><?=$value->subject?></a></td>
                        <td class="mailbox-name"><?=$value->recipient?></td>
                        <td class="mailbox-name"><?=$value->sender?></td>
                        <td class="mailbox-subject"><?=strip_tags(mb_substr($value->text,0,60))?>...</td>
                        <td class="mailbox-date"><?=default_dt($value->date)?></td>
                    </tr>
                    <?endforeach;?>
                </tbody>
                </table></div>
                </div>
            <?else:?>
            <h4>Нет сообщений</h4>
            <?endif;?>  

        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function(){
    $('#table').DataTable( {"order": [[ 5, "desc" ]],"language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"}});
});
</script>



