<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<section class="content-header">
    <h1>Админ Панель</h1>

</section>
<section class="content">


<div class="row">
 <div class="col-md-10">
    <?if($this->session->flashdata('danger')):?>
      <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?=$this->session->flashdata('danger')?>
      </div>
    <?endif;?>
    <?if($this->session->flashdata('success')):?>
      <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?=$this->session->flashdata('success')?>
      </div>
    <?endif;?>
    </div>
 <div class="col-md-3">
    <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion-ios-flag-outline"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Заявок</span>
            <span class="info-box-number"><?=$sum_rep?> принято</span>
   
        </div><!-- /.info-box-content -->
    </div>  
</div>
<div class="col-md-3">
    <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion-ios-person-outline"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Сейчас на работе</span>
            <span class="info-box-number"><?=$on_work?> чел.</span>
        </div><!-- /.info-box-content -->
    </div>
</div>

<div class="col-md-3">
     <div class="info-box">
        <span class="info-box-icon bg-red"><i class="ion-ios-pricetags-outline"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Сальдо</span>
                                                  
            <span class="info-box-number"><?=round($sum,2)?> грн</span>
                                                </div><!-- /.info-box-content -->
    </div>
</div>
<div class="col-md-3">
     <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion-ios-email-outline"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Сообщений</span>
            <span class="info-box-number"><?=$count_m?> новых</span>
        </div><!-- /.info-box-content -->
    </div>
</div>
</div>
                      
<div class="row">

	<div class="col-md-8">
        <div class="box box-success">
        <div class="box-header with-borer">
        </div>
        <div class="box-body">
        	<div id="container" style="height: 400px; min-width: 310px"></div>
        </div>
        </div>
		
	</div>
		<div class="col-md-4">
        <div class="box box-primary">
        <div class="box-header with-borer">
        </div>
        <div class="box-body">
        	<div id="container1" style="height: 400px; min-width: 310px"></div>
        </div>
        </div>
		
	</div>
</div>


		
</section>
<script type="text/javascript">
	$(function () {
		Highcharts.setOptions({
            lang: {
                loading: 'Загрузка...',
                months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                weekdays: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
                shortMonths: ['Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сент', 'Окт', 'Нояб', 'Дек'],
                exportButtonTitle: "Экспорт",
                printButtonTitle: "Печать",
                rangeSelectorFrom: "С",
                rangeSelectorTo: "По",
                rangeSelectorZoom: "Период",
                downloadPNG: 'Скачать PNG',
                downloadJPEG: 'Скачать JPEG',
                downloadPDF: 'Скачать PDF',
                downloadSVG: 'Скачать SVG',
                printChart: 'Напечатать график'
            }
    });
		var data=[];
			function getSeries(){
				var i=0;
				<?if($repairs):?>
					<?foreach ($repairs as $key1 => $value1):?>
						 data[i] = {
						name:"<?=$key1?>",
						data:
						<?if($value1):?>
						[
						<?foreach ($value1 as $key => $value):?>
							[Date.UTC(<?=$key?>), <?=$value?>],

						<?endforeach;?>
						]
						<?endif;?>
						};
									i++;
					<?endforeach;?>
					createChart();
					
				<?endif;?>
			}
getSeries();

    function createChart() {

        $('#container').highcharts('StockChart', {

            rangeSelector: {
                selected: 1
            },

	    yAxis: {
		        title: {
		            text: 'Заказы'
		        },
		        height: 200,
		        lineWidth: 2
		    },


            series: data

        });


    }
});
$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#container1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Статистика заказов '
            },
  
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Тип',
                colorByPoint: true,
                data: [
                <?if($repairs_s):?>
                <?foreach($repairs_s as $key=>$value):?>
                {
                    name: '<?=$key?>',
                    y: <?=$value?>
                },
                <?endforeach;?>
                <?endif;?>
                ]
            }]
        });
    });
});
</script>

