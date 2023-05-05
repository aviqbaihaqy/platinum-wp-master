<!-- SCRIPT -->
<!-- jQuery 3 -->
<script src="{{ asset('dashboard-assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('dashboard-assets/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="{{ asset('dashboard-assets/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('dashboard-assets/bower_components/morris.js/morris.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('dashboard-assets/bower_components/chart.js/Chart.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('dashboard-assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('dashboard-assets/bower_components/datatables.net/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('dashboard-assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.js') }}"></script>
<!-- File Upload -->
<script src="{{ asset('dashboard-assets/dist/js/file-uploader.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('dashboard-assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('dashboard-assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- Export to Excel -->
<script src="{{ asset('dashboard-assets/dist/js/export-excel.js') }}"></script>
<!-- Printable -->
<script src="{{ asset('dashboard-assets/dist/js/printable.js') }}"></script>
<!-- CK Editor -->
<script src="{{ asset('dashboard-assets/bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('dashboard-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
<!-- App -->
<script src="{{ asset('dashboard-assets/dist/js/main-dashboard.min.js') }}"></script>
<script src="{{ asset('dashboard-assets/dist/js/pages/dashboard.js') }}"></script>

<script>
  $(function() {
    $("#selector").change(function() {
      if ($("#addMore").is(":selected")) {
        $(".addMore").show();
      } else {
        $(".addMore").hide();
      }
    }).trigger('change');
  });
</script>

<!-- table page script -->
<script>
  $(function () {
    $('#datatables').DataTable()
    ({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<script>
$(function () {
    "use strict";

    // LINE CHART
    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: [
        {y: '2018 Q1', item1: 266, item2: 210, item3: 330},
        {y: '2018 Q2', item1: 278, item2: 300, item3: 130},
        {y: '2018 Q3', item1: 491, item2: 370, item3: 222},
        {y: '2018 Q4', item1: 377, item2: 320, item3: 330},
        {y: '2019 Q1', item1: 210, item2: 150, item3: 300},
        {y: '2019 Q2', item1: 470, item2: 220, item3: 389},
        {y: '2019 Q3', item1: 480, item2: 155, item3: 410},
        {y: '2019 Q4', item1: 553, item2: 234, item3: 390},
        {y: '2020 Q1', item1: 602, item2: 358, item3: 320},
        {y: '2020 Q2', item1: 542, item2: 459, item3: 268}
      ],
      xkey: 'y',
      ykeys: ['item1', 'item2', 'item3'],
      labels: ['LED Bulb', 'Indoor', 'Outdoor'],
      lineColors: ['#1087D7', '#0030B5', '#00CDFF'],
      hideHover: 'auto'
    });
    
    //DONUT CHART
    // var donut = new Morris.Donut({
    //   element: 'sales-chart',
    //   resize: true,
    //   colors: ["#0030B5", "#1087D7", "#00CDFF"],
    //   data: [
    //     {label: "Outdoor", value: 100},
    //     {label: "Indoor", value: 175},
    //     {label: "LED", value: 380}
    //   ],
    //   hideHover: 'auto'
    // });
 });
</script>

<script src="{{ asset('dashboard-assets/dist/js/easyResponsiveTabs.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function () {
    $('#horizontalTab').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion           
        width: 'auto', //auto or any width like 600px
        fit: true   // 100% fit in a container
    });
});
</script>
<!-- /SCRIPT -->