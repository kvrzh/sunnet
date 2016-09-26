
<div class="table-responsive">
<table id="data" class="table table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>

        <tr>   

        <th ><i class="ion-clock"></i></th>
        <th >#</th>
        <th>Улица</th>
        <th>Дом</th>
        <?if($type==1 || $type==2):?>
        <th>Кв</th>
        <?endif;?>
        <th>Телефон</th>
        <th >Комментарий</th>
        <th >Статус</th>
        <th >Дата</th>
        </tr>
    </thead> <tbody>
    <?if($repairs):?>
        <?foreach($repairs as $key=>$value):?>
            <?if($type==1 && $value->repair_start):?>
                <?if($value->repair_start<(date('U')-86400*2) && !in_array($value->status_id, array(5,10,11,12))):?>
                    <tr class="bg-r">
                <?elseif($value->repair_start<(date('U')-86400*1) && !in_array($value->status_id, array(5,10,11,12))):?>
                    <tr class="bg-y">
                <?else:?>
                    <tr>
                <?endif;?>
            <?elseif($type==2 && $value->repair_start):?>
                <?if($value->repair_start<(date('U')-3600*24) && !in_array($value->status_id, array(5,10,11,12))):?>
                    <tr class="bg-r">
                <?elseif($value->repair_start<(date('U')-3600*5) && !in_array($value->status_id, array(5,10,11,12))):?>
                    <tr class="bg-y">
                <?else:?>
                    <tr>
                <?endif;?>
            <?else:?>
                <tr>
            <?endif;?>
            
            <td><?=default_time($value->repair_start)?>  <?=default_time($value->repair_end)?></td>
            <td  width="1%" class="td-bold <?=$value->urgency==1?'text-red':''?>"><?=$value->id?></td>
            <td width="20%"><div class="td-top"><span class="label label-success"> <?=$value->short?></span><span class="td-mbold"><?=$value->street?></span></div>
            <div class="td-bot"><?=$value->name?></div></td>
            <td width="7%"><div class="td-top"><span class="td-mbold"><?=$value->address_house?></span></div><div class="td-bot">Подъезд: <span class="td-bold"><?=$value->address_porch?></span></div></td>
           <?if($type==1 || $type==2):?>
            <td width="6%"><div class="td-top"><span class="td-mbold"><?=$value->address_room?></span></div><div class="td-bot"></span>Этаж: <span class="td-bold"><?=$value->address_floor?></span></div></td>
            <?endif;?>
            <td width="7%" class="td-comment"><div class="td-top"><span><?=phone_ch($value->phone1)?></div><div class="td-mbot"><?=phone_ch($value->phone2)?></span></div></td>
            <td width="60%">
            <span class="td-comment"><div class="td-top">Заявки: <span><?=mb_substr($value->comment,0,250)?></span></span></div>
            <div class="td-bot"><span class="td-comment">Мастера: <span><?=mb_substr($value->comment_master,0,250)?></span></span></div></td>
            <td width="7%"><div class="td-top"><span class="badge" style="background-color:<?=$value->color?>"><?=$value->status?></span>
            <?if($value->status_id==7):?>
                <i class="ion-clock"></i> <?=$value->status_time==60?'40+':$value->status_time?> мин.
            <?endif;?>
            </div>
            <div class="td-bot">
            <?if($value->status_id!=1):?>
            <?=$value->group?>
            <?endif;?>
            </div>
            </td>
            <td><div class="td-top"><span class="td-date"><?=dt_calendar($value->date_repair)?></span>
                       <a href="<?=base_url('operator/repair_change/'.$value->id)?>"><i class="ion-edit"></i></a>
          <a href="<?=base_url('operator/repair_detail/'.$value->id)?>"><i class="ion-navicon-round"></i></a></div>
           <div class="td-bot">login</div>
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