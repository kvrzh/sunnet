
<div class="table-responsive">
<table id="data" class="table table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>

        <tr>   
        <th>#</th>
        <th><i class="ion-calendar"></i></th>
        <th><i class="ion-person"></i></th>
        <th>Коментарий</th>
        <th  width="5%">Статус</th>
        <th><i class="ion-edit"></i></th>
        </tr>
    </thead> <tbody>
    <?if($task):?>
        <?foreach($task as $key=>$value):?>
            <?if($value->start<(date('U')-86400*2) && !in_array($value->status_id, array(4))):?>
                    <tr class="bg-r">
                <?elseif($value->start<(date('U')-86400*1) && !in_array($value->status_id, array(4))):?>
                    <tr class="bg-y">
                <?else:?>
                    <tr>
                <?endif;?>
            <td  width="7%" class="td-bold <?=$value->urgency==1?'text-red':''?>"><?=$value->id?></td>
            <td>
                <div class="td-top"><span class="td-comment"><?=dt_calendar($value->start)?> <?=$value->start_time?> <div><?=default_dot($value->created)?>(созд.)</div> </span></div>
                <div class="td-mbot"><span class="td-comment"><?=default_dot($value->finish)?>(закр.)</span></div>
            </td>
            <td>
                <div class="td-top"><span class="td-comment"><?=$value->user?></span></div>
                <div class="td-mbot"><span class="td-comment"><?=$value->admin?></span></div>
            </td>
            <td width="60%">
                <span class="td-comment"><div class="td-top">Тема: <b><?=$value->subject?>.</b> Заявки: <span><?=$value->comment?></span></span></div>
                <div class="td-bot"><span class="td-comment">Админа: <span><?=$value->comment_admin?></span></span></div></td>
            </td>
            <td width="5%">
                <div class="td-top"><span class="badge" style="background-color:<?=$value->status_color?>"><?=$value->status?></span></div>
                <div class="td-mbot"><span class="label bg-g"><?=$value->type?></span>
                </div>
            </td>
            <td width="1$">
                <a href="<?=base_url('admin_task/task_change/'.$value->id)?>"><i class="ion-edit"></i></a>
                <a href="<?=base_url('admin_task/task_history/'.$value->id)?>"><i class="ion-navicon-round"></i></a>
            </td>
        </tr>
        <?endforeach;?>  
    <?endif;?>

</tbody></table>
</div>
<?
/*echo "<pre>";
print_r($repairs);
echo "</pre>";*/
?>