<?php
session_start();
error_reporting(0);
include "database_connection.php";
//include_once('simple_html_dom.php');
if (isset($_SESSION['global'])) {
    ?>
    <link href="css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="css/buttons.dataTables.min.css" rel="stylesheet">
    <?php include("header.php"); ?>

    <style>
        #emailto{ width:20%;}
        .extra{
            background-color:#F6F6F6 !important;
        }
        table.dataTable tbody th, table.dataTable tbody td{
            padding:3px 10px;
            border-bottom: 1px solid #ddd;
        }
        table.dataTable, table.dataTable th, table.dataTable td,.header{
            border-style: none;
        }
        t1{
            font-size:12px;
            padding-right:0px;
            margin-right:10px;

            line-height: 1.42857;
            padding: 8px;
            vertical-align: top;
            box-sizing: content-box;

        }

        .header > td{
            border-top:none !important;
        }
        .header > td > span{
            background-image: none;         
        }
        .header{

            border-color:white !important;
        }
        b, strong {
            float: none!important;
        }
        .dataTable {
            background:#F0F0F0;
        }
        .skill {
            float: left;
        }
        .tanktable {
            float: left;
        }

        .error {
            border-color: red;
        }
        .ui-datepicker-calendar {
            display: none;
        }
        .title {
            visibility: hidden;
        }
        table.dataTable tbody th, table.dataTable tbody td {
            padding: 3px 40px;
        }
        /*    .panel-wrapper {
                padding: 0 40px !important;
                position: relative;
            }*/
        h1,
        .h1,    
        h2,
        .h2,
        h3,
        .h3 {
            margin-top: 0px !important;
            margin-bottom: -27px;
        }
        table td,
        table th {
            padding: 3px 10px;
            text-align: center;
        }
        table {
            background-color: transparent;
            font-size: 13px;
            margin-left: 0;
            width: 100%;
        }
        .outer {
            width: 150px;
            height: 60px;
            border: 2px solid #ccc;
            overflow: hidden;
            position: relative;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
        }
        .outer2 {
            width: 100%;
            height: 140px;
            border: 2px solid #ccc;
            overflow: hidden;
            position: relative;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
        }
        .inner > div {
            background: black transparent none repeat scroll 0 0;
            color: black;
        }
        .inner,
        .inner div {
            width: 100%;
            overflow: hidden;
            background: black;
            left: -2px;
            position: absolute;
        }
        .inner {
            border: 2px solid black;
            border-top-width: 0;
            background-color: #2FA4E7;
            filter: alpha(opacity=60);
            opacity: 0.6;
            bottom: 0;
            height: 100%;
        }
        .inner div {
            border: 2px solid #7CB5EC;
            border-bottom-width: 0;
            background-color: #2FA4E7;
            top: 0;
            width: 100%;
            height: 5px;
        }
        p {
            margin: 0 0 -17px;
        }
        .ui-dialog { 
            position: absolute;
            padding: .2em;
            /*width: 465px !important;*/
            overflow: hidden;
        }
        b, strong {
            float: right;
            font-weight: bold;
        }
        .tank-detail{
            margin-left: 0px;
        }
        h7{
            color: #317eac;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-weight: 500;
            line-height: 1.1;
        }
        a {
            cursor: pointer;
        }
    </style>


    <div class="box col-md-12">
        <div class="def box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Tank Detail</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default" id="min"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>


            <div class="box-content">
                <div id="" class="center" style="">
                    <div id="container" class="tank-detail">
                        <?php
                        $query1 = "SELECT * FROM Tank ta,TvsStatus tv where ta.term_id = tv.term_id and ta.tank_id = tv.tank";
                        $result = $mysqli->query($query1);
                        // $value = mysqli_fetch_array($result);
                        //echo $row = (mysqli_num_rows($result));
                        ?>

                        <form id="frmemail" name="frmemail" method="POST">
<!--                            <b> Email To:</b><input name="emailto" class="emailto" id="emailto" type="text">
                            <input type="button" id="send" value="Send"></button>-->
                            <table border="1" width="" id="tank-detail" align="center" name="tank-detail" style="float:left">
                                <thead>
                                    <tr>

                                        <th>Id</th>
                                        <th>Tank</th>
                                        <th>Product Id</th>
                                        <th>Gross Inv</th>
                                        <th>Net Inv</th>
                                        <th>Capacity</th>
                                        <!--<th>Product Level</th>-->
                                        <th>Height</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $count = 0;
                                    $level = 0;
                                    $ans1 = 1;
                                    $ans2 = 1;
                                    while ($value = mysqli_fetch_array($result)) {
                                        $ans = $ans1;
                                        ?>

                                        <?php echo "<tr>";
                                        $ans1++;
                                        ?>
                                        <?php
                                        if ($value) {
                                            $count++;
                                            $level++;
                                            ?>


                                            <?php
                                            $gross_inv = $value['gross_inv'];
                                            $net_inv = $value['net_inv'];
                                            $capacity = $value['capacity'];
                                            $per = ($net_inv * 100) / ($capacity);
                                            $pro_percentage = round($per, 2);
                                            $tank_id = $value['tank_id'];
                                            ?>                                                
                                        <td id="1c" class="details-control"> <a>+<?php echo "T-" . $tank_id; ?></a>

                                        </td>
                                        <td>
                                            <div  value="<?php echo $tank_id ?>" OnClick="//tank(this);" id="outer<?php echo $count ?>" class="outer" width="50%" style="float:right">

                                                <b><?php echo $pro_percentage; ?>%</b>
                                                <div id="innertank<?php echo $level; ?>" class="inner" data-progress="<?php echo $pro_percentage; ?>%">

                                                    <div></div>
                                                </div> 
                                            </div>
                                        </td>

                                        <td><?php echo $value['prod_id']; ?> </td>
                                        
                                        <td><?php echo $value['capacity']; ?></td>

                                        <td><?php echo $value['gross_inv']; ?></td>
                                        
                                        <td><?php echo $value['net_inv']; ?></td>

                                        <!--<td><?php //echo $value['prod_level']; ?> </td>-->

                                        <td><?php echo $value['height']; ?></td>




                                        </tr>


                                        <?php }
                                    ?>
                                <?php } ?>

                                </tbody></table>
                        <?php } ?>    

                        <input type="hidden" name="vol_total" id="vol_total" value="<?php echo $level; ?>">
                        <?php
                        for ($i = 0; $i < $level; $i++) {
                            // echo $i;
                            ?>
                            <script>
                                var tankDiv = $('#innertank<?php echo $i; ?>');

                                var tankPct = tankDiv.attr("data-progress");
                                // alert();
                                $(tankDiv).animate({
                                    height: tankPct
                                }, 2500);

                            </script>
    <?php
}
?>

                </div>
            </div>
        </div>
    </div>
</div>
</div></div>

<script>
    function format(d) {

        return '<div class ="tank-extra-detail"></div>';
    }
</script>      
<script src="js/dataTables.buttons.min.js"></script>
<!--<script src="/js/buttons.flash.min.js"></script>-->
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
<script src="js/fnAddTr.js"></script>


<?php
$detect = new Mobile_Detect;

// Any mobile device (phones or tablets).
if ($detect->isMobile()) {
    // echo "mobile bhai";
    ?>



    <script>

        var table;
        var htmlString = "InitialVal";

        /*function initDataTable() {
         dataTable = $('#tank-detail').dataTable(options);
         }*/

        function initDataTable() {
            table = $('#tank-detail').dataTable({
                "bSort": false,
                "bPaginate": false,
                "responsive": true,
                "dom": 'Bfrtip',
                "scrollX": true,
                "pageLength": 10,
                "scrollCollapse": true,
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "drawCallback": function (data, settings) {

                    htmlString = $(this).html();
                    //$( '#data' ).text( htmlString );


                }

            });

        }

    </script>

<?php } else { ?>
    <script>


        var table;
        var htmlString = "InitialVal";

        /*function initDataTable() {
         dataTable = $('#tank-detail').dataTable(options);
         }*/

        function initDataTable() {
            table = $('#tank-detail').dataTable({
                "bSort": false,
                "bPaginate": false,
                "responsive": true,
                "pageLength": 10,
                "dom": 'Bfrtip',
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "drawCallback": function (data, settings) {

                    htmlString = $(this).html();
                    //$( '#data' ).text( htmlString );
                    //alert(htmlString);


                }

            });

        }



    </script>
<?php } ?>
<script>

    var newRow = '';
    function attachClickHandler() {
        $('#tank-detail tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var index = tr.index();
            //var index=$(this).attr('index');
            var tank_id = tr.find("td.details-control>a").html();
            //alert(tank_id);
            //alert($(this).id);
            //if(tr.id == 'notclicked')
            //{
            var nexttr = $("#tank-detail tbody tr").eq(index + 1);
            var trdata = tr.find("td").find("a").html().toString();
            var toggleSign = trdata.substring(0, 1);
            var tankStr = trdata.substring(1);
            var strAfterToggle = "-" + tankStr;
            //tr.find("td").find("a").html("");
            //alert(strAfterToggle);
            //tr.id = 'clicked';
            //alert(tr.id)
            $.ajax({
                type: "POST",
                url: "tank-extra-detail.php",
                dataType: 'html',
                data: ({tank_id: tank_id}),
                success: function (data) {
                    console.log(data);
                    var buttons = [];

                    $.each(table.DataTable().buttons()[0].inst.s.buttons,
                            function () {
                                buttons.push(this);
                            });
                    $.each(buttons,
                            function () {
                                table.DataTable().buttons()[0].inst.remove(this.node);
                            });

                    table.DataTable().destroy();


                    if (toggleSign === "+")
                    {
                        var newRow = '<tr>' + data + '</tr>';
                        //alert(index);
                        $("#tank-detail tbody tr").eq(index).after(newRow);
                        initDataTable();
                        tr.find("td").find("a").html(strAfterToggle);
                    } else
                    {
                        $("#tank-detail tbody tr").eq(index + 1).remove("tr");
                        tr.find("td").find("a").html("+" + tankStr);
                        initDataTable();
                    }

                },
                error: function (data) {
                    console.log("error");
                }
            });
            //}
            //else
            //{
            //  tr.id = '';

            //}
            //attachClickHandler()
            //alert(tr.id);
        });
    }


    $('#send').click(function (event) {
        var email = document.getElementById('emailto').value;
        var elements = $("#tank-detail_filter").find("[aria-controls='tank-detail']").val();
        //alert(htmlString);

        event.preventDefault();
        $.ajax({
            url: "emailtest.php",
            cache: "false",
            type: "POST",
            dataType: 'html',
            //'emailto='+email+
            data: '&data=' + htmlString + '&element=' + elements + '&emailto=' + email,
            success: function (result) {
                //alert(result);
            }

        });
    });


    initDataTable();
    attachClickHandler();


    //$( ".player" ).html(row_num);


</script>

<?php include("footer.php"); ?>  

