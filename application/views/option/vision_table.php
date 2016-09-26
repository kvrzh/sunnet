

<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>   
        <th >#</th>
        <th >Район</th>
        <th >Улица</th>
        <th >Дом</th>
        <th >Кв.</th>
        <th >Аб.</th>
        <th >%</th>
        </tr>
    </thead> <tbody>
    <?if($house):?>
        <?foreach($house as $key=>$value):?>
            <tr>
            <td width="3%"><?=$value->id?></td>
            <td width="30%"><?=$value->area_title?></td>
            <td width="30%"><?=$value->street_title?></td>
            <td width="10%"><?=$value->title?></td>
            <td width=""><?=$value->house_count?></td>
            <td>4</td>
            <td><?=$value->house_count?round((4)/$value->house_count,2)*100:''?></td>
            </tr>
        <?endforeach;?>  
    <?endif;?>

</tbody></table>