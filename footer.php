
      <footer>
       <div id="footer" class="footer text-right">
        <hr />
        &copy; 2014 - Sistema Financeiro
        </div></div>
      </footer>
    </div> <!-- /container -->


  <script src="/js/jquery-2.1.1.min.js" type="text/javascript"></script>
  <script src="/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="/js/jquery.dataTables.js" type="text/javascript"></script>
  <script src="/js/dataTables.tableTools.js" type="text/javascript"></script>
  <script src="/js/dataTables.bootstrap.js" type="text/javascript"></script>
  <script src="/js/highcharts.js" type="text/javascript"></script>
  <!-- <script src="/js/docs/panel-charts.js" type="text/javascript"></script> -->
  <script src="/js/application.js" type="text/javascript"></script>

  <script type="text/javascript">

    $(document).ready(function() {
        $('#listdata').DataTable( {
            "language": {
                  "url": "/i18n/Portuguese-Brasil.lang"
              },
            responsive: true
            // "bSort": false,
            // dom: 'T<"clear">lfrtip'
            // tableTools: {
            //   "sSwfPath": "/swf/copy_csv_xls_pdf.swf",
            //   "sRowSelect": "os",
            // }
        } );
    } );

    // For demo to fit into DataTables site builder...
    $('#listdata') 
      .removeClass( 'display' )
      .addClass('table table-striped table-bordered');

  </script>

</body>
</html>
