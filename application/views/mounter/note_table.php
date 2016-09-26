<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>   
        <th >Улица</th>
        <th >Дом</th>
        <th >Заметка</th>
        <th ><i class="ion-edit"></i></th>
        </tr>
    </thead> <tbody>
    <?if($notes):?>
        <?foreach($notes as $key=>$value):?>
            <tr>
            <td width="8%"><?=$value->street?></td>
            <td width="2%"><?=$value->house?></td>
            <td width="90%"><?=$value->note?></td>
            <td width="1%"><a href="<?=base_url('mounter/house_note_edit/'.$value->id)?>"><i class="ion-edit"></i></a></td>
            </tr>
        <?endforeach;?>  
    <?endif;?>

</tbody></table>
<?
?>