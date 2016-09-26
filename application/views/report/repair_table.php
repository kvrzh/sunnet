<div class="td-top"><?


?>
<div class="table-responsive">
<table id="data" class="table table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>

        <tr>   

        <th >#</th>
        <th>Улица</th>
        <th>Дом</th>
        <th>Кв</th>
        <th>Телефон</th>
        <th >Комментарий</th>
        <th >Статус</th>
        <th >Дата</th>
        <th >Тип</th>
        <th >Группа</th>
        </tr>
    </thead> <tbody>
    <?if($repairs):?>
        <?foreach($repairs as $key=>$value):?>
            <tr>
          <td  width="1%" class="td-bold <?=$value->urgency==1?'text-red':''?>"><?=$value->id?></td>
            <td width="20%"><div class="td-top"><span class="label label-success"> <?=$value->short?></span><span class="td-mbold"><?=$value->street?></span></div>
            <div class="td-bot"><?=$value->name?></div></td>
            <td width="7%"><div class="td-top"><span class="td-mbold"><?=$value->address_house?></span></div><div class="td-bot">Подъезд: <span class="td-bold"><?=$value->address_porch?></span></div></td>
            <td width="5%"><div class="td-top"><span class="td-mbold"><?=$value->address_room?></span></div><div class="td-bot"></span>Этаж: <span class="td-bold"><?=$value->address_floor?></span></div></td>
            <td width="10%" class="td-comment"><div class="td-top"><span><?=phone_ch($value->phone1)?></span></div><div class="td-mbot"><?=phone_ch($value->phone2)?></span></div></td>
            <td width="35%">
            <div class="td-top"><span class="td-comment">Заявки: <span><?=mb_substr($value->comment,0,250)?></span></span></div>
            <div class="td-bot"><span class="td-comment">Мастера: <span><?=mb_substr($value->comment_master,0,250)?></span></span></div></td>
            <td width="8%"><span class="badge" style="background-color:<?=$value->color?>"><?=$value->status?></span></td>
            <td><span class="td-date"><?=dt_calendar($value->date_repair)?></span>
                       <a href="<?=base_url('operator/repair_change/'.$value->id)?>"><i class="ion-edit"></i></a>
          <a href="<?=base_url('operator/repair_detail/'.$value->id)?>"><i class="ion-navicon-round"></i></a></td>
          <td><?=$value->type?></td>
          <td><?=$value->group?></td>
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