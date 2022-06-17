<!-- jQuery -->
<script src="<?php echo base_url()?>assets/vendor/jquery/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/jquery/jquery_migrate/jquery-migrate-3.0.0.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- HighCharts Plugin -->
<script src="<?php echo base_url()?>assets/vendor/plugins/highcharts/highcharts.js"></script>

<!-- Theme Javascript -->
<script src="<?php echo base_url()?>assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>assets/js/main.js"></script>

<!-- <script src="<?php echo base_url()?>assets/js/custom.js"></script> -->
<script src="<?php echo base_url()?>assets/vendor/plugins/pnotify/pnotify.js"></script>

<script>

         
function alertbox(title,error,type)
{
    new PNotify({
        title:title,
        text:error ,
        shadow: true,
        opacity: 1,
        addclass: "stack_top_right",
        type:type,
        stack: {
            "dir1": "down",
            "dir2": "left",
            "push": "top",
            "spacing1": 10,
            "spacing2": 10
        },
        width: "auto",
        delay: 1500
    });
}
</script>
<?php alertbox(); ?>