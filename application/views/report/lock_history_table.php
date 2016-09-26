<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>   
        <th >Поьзователь</th>
        <th >Замок</th>
        <th >Дата</th>
        </tr>
    </thead> <tbody>
    <?if($lock):?>
        <?foreach($lock as $key=>$value):?>
            <tr>
            <td width="2%"><?=$value->name?></td>
            <td width="3%"><?=$value->title?></td>
            <td width="3%"><?=default_dt($value->date)?></td>
            </tr>
        <?endforeach;?>  
    <?endif;?>

</tbody></table>