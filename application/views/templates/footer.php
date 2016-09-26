    </section>
  </aside>

  <div class="content-wrapper">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
var act= sessionStorage.getItem('href');
    if(act){
        var act_href = $("a[href='"+act+"']");
        act_href.parent("li").addClass('active')
        act_ul=act_href.parent("li").parent('ul').parent('.treeview');
        if(act_ul){
            act_ul.addClass('active');
        }
    }
    $(".sidebar-menu li a").on("click", function (e) {
    var href=$(this).attr("href");
    if(href!='#'){
        sessionStorage.setItem('href', href);
    }

});
</script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="<?=lte_url()?>bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?=lte_url()?>plugins/morris/morris.min.js"></script>
    <script src="<?=lte_url()?>plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="<?=lte_url()?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?=lte_url()?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?=lte_url()?>plugins/knob/jquery.knob.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?=lte_url()?>plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?=lte_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?=asset_url()?>js/bootstrap-datepicker.ru.js"></script>
    <script src="<?=lte_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="<?=lte_url()?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?=lte_url()?>plugins/fastclick/fastclick.min.js"></script>
    <script src="<?=lte_url()?>plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="<?=lte_url()?>dist/js/app.min.js"></script>
    <script src="<?=asset_url()?>js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?=lte_url()?>plugins/input-mask/inputmask.js"></script>
    <script src="<?=lte_url()?>plugins/input-mask/jquery.inputmask.phone.extensions.js"></script>
    <script src="<?=lte_url()?>plugins/input-mask/jquery.inputmask.regex.extensions.js"></script>
    <script src="<?=lte_url()?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?=lte_url()?>plugins/input-mask/jquery.inputmask.numeric.extensions.js"></script>
        <script src="<?=lte_url()?>plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?=asset_url()?>js/bootstrap-datetimepicker.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.5.0/fullcalendar.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.5.0/lang/ru.js" type="text/javascript"></script>
    <script src="<?=asset_url()?>js/scheduler.js"></script>
    <script src="<?=lte_url()?>plugins/bootstrap-slider/bootstrap-slider.js" type="text/javascript"></script>
    <script src="<?=lte_url()?>plugins/timepicker1/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.js"></script>

    


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>


    <script src="<?=asset_url()?>js/validator.js"></script>
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
$('.sidebar-toggle').on('click',function(){
        $.ajax({
        url: "<?=base_url('main/menu_change')?>",
        method: "POST",
        data: { change : 1 },
    });
});


</script>


