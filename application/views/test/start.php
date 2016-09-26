<section class="content-header">
    <h1>Тестирование<small></small></h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-10">
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
    <input type="hidden" id="task_id" value="<?=$task->id?>">
    <input type="hidden" id="start" value="<?=$task->start?>">
	<div class=" row">
		<div class="col-md-4">
		<div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion-ios-time-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Всего времени</span>
                <span class="info-box-number">20:00</span>
            </div><!-- /.info-box-content -->
        </div>
		</div>
		<div class="col-md-4">
		<div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion-ios-time-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Осталось времени</span>
                <span class="info-box-number" id="worked">
                <?if($task->start):?>
                    <?$start=$task->start+1200;?>
                	<?=$start<date('U')?'00:01':default_ms(1200-(date('U')-$task->start))?>
                <?else:?>
                20:00
                <?endif?>
                </span>
            </div><!-- /.info-box-content -->
        </div>
        </div>
        <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion-ios-help-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Номер вопроса</span>
                <span class="info-box-number" id="question_number">0</span>
            </div><!-- /.info-box-content -->
        </div>
		</div>
	</div>
	<div id="question_block">
		
	</div>

    </div>
	<div class="col-md-2">
			<button class="btn btn-btn-block bg-red <?=$task->start?'display-none':''?>" id="start_test">Начать тестирование</button>
	</div>
</div>
	
</section>
<script type="text/javascript">
    function start_question(){
		$.ajax({
    		method:"POST",  
    		data: {
    			task_id:$('#task_id').val()
    		},
    		url:"<?=base_url('test/start_question')?>",
    		success:function(result){
    			$('#question_block').html(result);
                var pos=$('input[name=pos]').val();
                if(pos){
                    $('#question_number').html(pos);
                }

    		}

		});	
	}
$(document).ready(function (e) {
    var $worked = $("#worked");
    function update() {
        var myTime = $worked.html();
        var ss = myTime.split(":");
        var dt = new Date();
        dt.setHours(0);
        dt.setMinutes(ss[0]);
        dt.setSeconds(ss[1]);

        var dt2 = new Date(dt.valueOf() - 1000);

        var temp = dt2.toTimeString().split(" ");
        var ts = temp[0].split(":");
        $worked.html(ts[1]+":"+ts[2]);
   		if(parseInt(ts[1])<=0 && parseInt(ts[2])<=0){
    		start_question();
   		}
   		else{
            if($('#finish').val()!=1){
   			  setTimeout(update, 1000);
            }
   			

   		}

    }

    $('#start_test').on('click',function(){
    		console.log($('#task_id').val());
    	    setTimeout(update, 1000);
    	    $('#start_test').css('display','none');
    		$.ajax({
    		method:"POST",  
    		data: {
    			task_id:$('#task_id').val()
    		},
    		url:"<?=base_url('test/start_test')?>",
    		success:function(obj){
    			start_question();

    		}
    	});	
    });
    var start=$('#start').val();
    console.log($('#finish').val());
    if(start &&  $('#finish').val()!=1){
	    setTimeout(update, 1000);
		start_question();
    }
    $(document).on('click','#answer',function(){
    	var right_choose=$('input[name=right]:radio:checked').val();
    	var id=$('input[name=id]').val();
    	var right_question=$('input[name=right_question]').val();
    	var right=right_choose==right_question?1:0
		$.ajax({
    		method:"POST",  
    		data: {
    			id:id,
    			right:right,
    			answer:right_choose,
    		},
    		url:"<?=base_url('test/start_answer')?>",
    		success:function(result){
    			start_question();
    		}

		});	

    });

});
</script>