Работали:
<?if($user):?>
    <?foreach ($user as $key => $value):?>

            <span user-id="<?=$key?>" class="badge bg-purple"><?=$value?></span>,
   
    <?endforeach?>
<?endif;?>


<div class="table-responsive" style="margin-top:10px">
<table id="data" class="table table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>   
        <th >#</th>
        <th>Улица</th>
        <th>Дом</th>
        <th>Кв</th>
        <th >Комментарий</th>
        <th >Статус</th>
        <th >Дата</th>
        </tr>
    </thead> <tbody>
    <?if($repairs):?>
        <?foreach($repairs as $key=>$value):?>
            <tr>
    
            <td  width="1%" class="td-bold <?=$value->urgency==1?'text-red':''?>"><?=$value->id?></td>
            <td width="20%"><div class="td-top"><span class="label label-success"> <?=$value->short?></span><span class="td-mbold"><?=$value->street?></span></div>
            <div class="td-bot"><span user-id="<?=$value->user_id?>" class="badge bg-purple"><?=$value->name?></span> <?=$value->group?> (<?=$value->group_type?>)</div></td>
            <td width="7%"><div class="td-top"><span class="td-mbold"><?=$value->address_house?></span></div><div class="td-bot">Подъезд: <span class="td-bold"><?=$value->address_porch?></span></div></td>
            <td width="6%"><div class="td-top"><span class="td-mbold"><?=$value->address_room?></span></div><div class="td-bot"></span>Этаж: <span class="td-bold"><?=$value->address_floor?></span></div></td>
         
            <td width="70%">
            <span class="td-comment"><div class="td-top">Заявки: <span><?=mb_substr($value->comment,0,250)?></span></span></div>
            <div class="td-bot"><span class="td-comment">Мастера: <span><?=mb_substr($value->comment_master,0,250)?></span></span></div></td>
            <td width="7%"><span class="badge" style="background-color:<?=$value->color?>"><?=$value->status?></span>
            <?if($value->status_id==7):?>
                <i class="ion-clock"></i> <?=$value->status_time==60?'40+':$value->status_time?> мин.
            <?endif;?>
            </td>
            <td><span class="td-date"><?=dt_calendar($value->date_repair)?></span></td>
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