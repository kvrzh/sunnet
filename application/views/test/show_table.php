<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>  
        <th >#</th> 
        <th >Название</th>
        <th>Отдел</th>
        <th >Вопросов</th>
        </tr>
    </thead> <tbody>
    <?if($theme):?>
        <?foreach($theme as $key=>$value):?>
            <tr>
            <td width="3%"><?=$value->id?></td>
            <td width="45%"><a href="<?=base_url('test/show_theme/'.$value->id)?>"><?=$value->title?></a> </td>
            <td width="35%"><?=$value->branch_title?></td>
            <td width="5%"><?=$value->question_count?></td>

            </tr>
        <?endforeach;?>  
    <?endif;?>

</tbody></table>
