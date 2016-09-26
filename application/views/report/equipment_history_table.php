<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>   
        <th >Кто</th>
        <th >Дата</th>
        <th >Модель</th>
        <th >Место</th>
        <th >Логин</th>
        <th >Цена</th>
        </tr>
    </thead> <tbody>
    <?if($equipment_history):?>
        <?foreach($equipment_history as $key=>$value):?>
            <tr>
            <td width="10%"><?=$value->equipment_id?> <?=$value->admin_name?></td>
            <td width="12%"><?=default_dt($value->date)?></td>
            <td width="50%">
            <?=$value->vendor?> <?=$value->model?> <?=$value->serial?></td>
            <td width="20%">
            <div class="td-top">
            <?=$value->location?> <?=$value->admin_name?'('.$value->admin_name.')':''?>
            </div>
            <?if($value->house):?>
            <div class="td-bot">
                
             <?=$value->street?> д.<?=$value->house?> п.<?=$value->porch?>
             </div>
            <?endif;?>
            </td>
            <td><?=$value->login?></td>
            <td><?=$value->price_out?></td>
            </tr>
        <?endforeach;?>  
    <?endif;?>

</tbody></table>
