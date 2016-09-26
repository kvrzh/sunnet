<link rel="stylesheet" href="<?=lte_url()?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=asset_url()?>css/lte_paint.css">
<div class="col-md-12">
<?if($work):?>
<?foreach($work as $key=>$value_w):?>
	<?if($value_w['work']):?>
	<h4>Дата <?=dot_day($value_w['date'])?> Группа <?=$value_w['group']?></h4>
	<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
	    <thead>
	        <tr>
	        <th >Время</th>
	        <th>Улица</th>
	        <th>Дом</th>
	        <?if($value_w['type']!=3):?>
	        	<th>Кв</th>
	        	<th>Телефон</th>
	        <?endif;?>
	        <th >Комментарий</th>
	        </tr>
	    </thead> <tbody>
	        <?foreach($value_w['work'] as $key=>$value):?>
	            <tr>
	            <td  width="6%"><div class="td-top"><?=default_time($value->start)?> - <?=default_time($value->end)?></div>
	            <div class="td-bot">№ <span class="td-bold"><?=$value->id?></span></div></td>
	              	<td width="16%"><div class="td-top"><span class="td-bold"><?=$value->street?></span></div>
		            <div class="td-bot"><?=$value->name?></div></td>
		            <td width="6%"><div class="td-top"><span class="td-bold"><?=$value->address_house?></span></div><div class="td-bot">Под.: <span class="td-bold"><?=$value->address_porch?></span></div></td>
		            <?if($value_w['type']!=3):?>
		            	<td width="5%"><div class="td-top"><span class="td-bold"><?=$value->address_room?></span></div><div class="td-bot"></span>Эт.: <span class="td-bold"><?=$value->address_floor?></span></div></td>
		            <td width="11%" class="td-comment"><div class="td-top"><span><?=phone_ch($value->phone1)?></span></div><div class="td-bot"><?=phone_ch($value->phone2)?></span></div></td>
		             <?endif;?>
		            <td width="65%">
		            <div class="td-top"><span class="td-comment"><span><?=mb_substr($value->comment,0,250)?></span></span></div>
		            <div class="td-bot"><span class="td-comment"><span><?=mb_substr($value->comment_master,0,250)?></span></span></div></td>
		           
		            
	        </tr>
	        <?endforeach;?>  
	</tbody></table>
	<?endif;?>
<?endforeach;?>
<?endif;?>


<?if($work):?>
<?foreach($work as $key=>$value_w):?>
	<?if($value_w['work']):?>
	<h4>Заметки</h4>
	<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
	    <thead>
	        <tr>
	        <th>У</th>
	        <th>Д</th>
	        <th>Заметка</th>
	        </tr>
	    </thead> <tbody>
	        <?foreach($value_w['work'] as $key=>$value):?>
	        	<?if($value->house_note):?>
	            <tr>
	              	<td width="6%"><?=$value->str_short?></td>
		            <td width="2%"><?=$value->address_house?></td>
		            <td width="90%"><?=$value->house_note?></td>	              
	        	</tr>
	        	<?endif;?>
	        <?endforeach;?>  
	</tbody></table>
	<?endif;?>
<?endforeach;?>
<?endif;?>

<?if($work):?>
<?foreach($work as $key=>$value_w):?>
	<?if($value_w['work'] && $value_w['type']==1 ):?>
	<h4>Свободные кабеля</h4>
	<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
	    <thead>
	        <tr>
	        <th>У</th>
	        <th>Д</th>
	        <th>Кабель</th>
	        </tr>
	    </thead> <tbody>
	        <?foreach($value_w['work'] as $key=>$value):?>
	         	<?if($value->house_cable):?>
	            <tr>
	              	<td width="6%"><?=$value->str_short?></td>
		            <td width="2%"><?=$value->address_house?></td>
		            <td width="90%">
		            <?if($value->house_cable):?>
		            	<?foreach($value->house_cable as $cable):?>
		            	<b><?=$cable->login?></b> 
		            	(п:<?=$cable->porch?> эт:<?=$cable->floor?> 
		            	<?if($cable->com_id):?>к:<?=$cable->com_id?> <?endif;?>
		            	п:<b><?=$cable->number?></b> 
		            	),
		            	<?endforeach;?>
		            <?endif;?>
		            	
		            	</td>	              
	        		</tr>
	        		<?endif?>
	        <?endforeach;?>  
	</tbody></table>
	<?endif;?>
<?endforeach;?>
<?endif;?>

<?if($work):?>
<?foreach($work as $key=>$value_w):?>
	<?if($value_w['work'] && $value_w['type']==2 ):?>
	<h4>Скрука на кабеле</h4>
	<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
	    <thead>
	        <tr>
	        <th>У</th>
	        <th>Д</th>
	        <th>Скрутка</th>
	        </tr>
	    </thead> <tbody>
	        <?foreach($value_w['work'] as $key=>$value):?>
	            <tr>
	              	<td width="6%"><?=$value->str_short?></td>
		            <td width="2%"><?=$value->address_house?></td>
		            <td width="90%">
		   
		            </td>	              
	        </tr>
	        <?endforeach;?>  
	</tbody></table>
	<?endif;?>
<?endforeach;?>
<?endif;?>

</div>

