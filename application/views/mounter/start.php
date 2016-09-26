<section class="content-header">
    <h1><?=$head?></h1>
</section>
<section class="content">
<div class="row">

    <div class="col-md-8">
        <?if($this->session->flashdata('success')):?>
          <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?=$this->session->flashdata('success')?>
          </div>
        <?endif;?>
        <?if($this->session->flashdata('danger')):?>
          <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?=$this->session->flashdata('danger')?>
          </div>
        <?endif;?>
        <div class="box box-success">
            <div class="box-body">
                <div id='calendar'></div>
            </div><!-- /.box-body -->

        </div>
        <h4>Оборудование, числиться за Вами</h4>
        <?if($equipment):?>
            <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>  
                <th >Вендор/Модель</th>
                <th >Номер</th>
                <th >Начислено</th>
                <th >Стоимость</th>
                </tr>
            </thead> <tbody>
            <?if($equipment):?>
                <?foreach($equipment as $key=>$value):?>
                    <?if($value->type_has_number):?>
                    <tr>
                    <td width="">
                    <?if($value->photo_thumb):?>
                            <a class="img" src="<?=base_url($value->photo_thumb)?>" data-toggle="lightbox"  href="<?=base_url($value->photo)?>"><i class="ion-image"></i></a>
                        <?endif;?> 
                    <?=$value->type?> <?=$value->vendor?> <?=$value->model?></a></td>
                    <td width=""> <?=$value->serial?></td>
                    <td width="28%"><?=default_dt($value->up_date)?> <?=$value->up_name?></td>
                    <td><?=$value->price_out?>грн.</td>

                    </tr>
                    <?endif;?>
                <?endforeach;?>  
            <?endif;?>

            </tbody></table>

        <?endif;?>
    </div>
    <div class="col-md-4">


        <form role="form" id="<?=$user_w?'report':''?>" method="post" class="form-horizontal" action="<?php echo base_url('mounter/start_action');?>">
            <div class="form-group">
            <?if($user_w):?>
                <?if($user_w->wage_koef==0):?>
                    <input  type="hidden"  name="koef" value="0">
                <?else:?>
                    <label  class="control-label col-md-8">Дополнительный параметр</label>
                <div class="col-md-4">
                <input min="0" type="number" step="0.02" name="koef" class="form-control" required>
                </div>
                <?endif;?>
                </div> 
                <div class="form-group">
                <textarea class="form-control" placeholder="Отчет за день" id="comment" name="comment" required></textarea>
                </div>
            <?else:?>
            <input  type="hidden"  name="koef" value="0">
            <?endif;?>
          
   


            <div class="form-group">
            <div class="col-md-offset-4 col-md-8"  style="margin-top: 0px;">
                <button type="submit" class="btn bg-black btn-block"><?=$head?></button>
            </div>
            </div>
        </form>
            <div>
                <h4>За последний рабочий месяц</h4>
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <tr><td>Зарплата</td><td><?=$sheet['salary']?></td></tr>
                <tr><td>Премии</td><td><?=$sheet['fine']?></td></tr>
                <tr><td>Штрафы</td><td><?=$sheet['damage']?></td></tr>
                <tr><td>Выдали</td><td><?=$sheet['pay']?></td></tr>
                <tr><td>Всего</td><td><?=$sheet['total']?></td></tr>
                <tr><td>Остаток</td><td><?=$sheet['rest']?></td></tr>
                </table>
            </div>
         <div id='sheet_salary'></div> 
    </div>
  
</div>
<div class="row">

    <div class="col-md-8">

    </div>
</div>


    
</section>
<script>
    $("#report").submit(function (e) {
        e.preventDefault();
        bootbox.confirm({
        buttons: {
            confirm: {label: 'Подтвердить',},
            cancel: {label: 'Отменить'}
        },
    message: $('#comment').val(),
    callback: function(result) {
     if(result){
         $('#report')[0].submit()   
        }
    },
    title: "Отчет за день",
    });
});
function get_salary(){
    var date=$('#calendar').fullCalendar('getDate').format('YYYY-MM');
    console.log(date);
    var data={
        user_id:"<?=$user_id?>",
        date:date
    };
    $.ajax({
        type:"POST",
        url:"<?=base_url('mounter/sheet_salary')?>",
        data:data,
        success:function(result){
            $("#sheet_salary").html(result);

        }
    })
}
$(function() { // document ready

        $('#calendar').fullCalendar({
            lang:'ru',

            defaultView: 'month',
            //eventLimit: true, // allow "more" link when too many events
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },
                events: [
        <?if($calendar):?>
        <?foreach($calendar as $key=>$value):?>
        {
            title  : "<?=$value['koef_value']?>x"+"<?=$value['koef_wage']?>= "+"<?=$value['koef']?>грн",
            start  : "<?=$key?>",
            color: "#00A65A",
        },    
        {
            title  : "<?=$value['hour_value']?>x"+"<?=$value['hour_wage']?>= "+"<?=$value['hour']?>грн",
            start  : "<?=$key?>",
            color: "#337ab7 ",
        },

        <?endforeach;?>
        <?endif;?>

    ]

    
    });
            get_salary();
        $('.fc-next-button').click(function(){
           get_salary();
        });

        $('.fc-prev-button').click(function(){
           get_salary();
        });

});
$(document).ready(function(){
    $('#img').ekkoLightbox();
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
    });
});
</script>

