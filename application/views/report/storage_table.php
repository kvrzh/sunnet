<div class="row" style="margin-bottom:5px">
</div>
<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>   
        <th >Дата</th>
        <th >Товар</th>
        <th >Количество</th>
        <th >Передвижение</th>
        <th >Откуда</th>
        <th >Куда</th>
        <th >Кто</th>
        <th >Коментарий</th>
        </tr>
    </thead> <tbody>
    <?if($move):?>
        <?foreach($move as $key=>$value):?>
            <tr>
            <td><?=default_dt($value->date_move)?></td>
            <td><?=$value->title?></a></td>
            <td><?=$value->count." ".$value->unit?></td>
            <td><?=$value->type?></td>
            <td><?=$value->user_from?></td>
            <td><?=$value->user_to?></td>
            <td><?=$value->user_name?></td>
            <td><?=$value->comment?></td>
            </tr>
        <?endforeach;?>  
    <?endif;?>

</tbody></table>
<?
?>