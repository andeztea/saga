<?php
//SourceCode by AndezNET.com
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )

{
    ?>
<div class="row">
    <div class="col-lg-9 main-chart">

        <div class="row mtbox">
            <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                <div class="box1">
                    <a href="?id=inbox"><span class="fa fa-inbox"></span></a>
                    <div class="label label-primary">Kotak Masuk</div>
                </div>

            </div>
            <div class="col-md-2 col-sm-2 box0">
                <div class="box1">
                    <a data-toggle="modal" data-target="#modalsiaran" href=""><span class="fa fa-bullhorn"></span></a>
                    <div class="label label-primary">Pesan Siaran</div>
                </div>

            </div>
            <div class="col-md-2 col-sm-2 box0">
                <div class="box1">
                    <a href="?id=sent"><span class="fa fa-envelope"></span></a>
                    <div class="label label-primary">Pesan Terkirim</div>
                </div>

            </div>
            <div class="col-md-2 col-sm-2 box0">
                <div class="box1">
                    <a href="#"><span class="fa fa-signal"></span></a>
                    <?php
                    $view=mysqli_query($mysqli,"select * from phones");
                    $no=1;
                    while($row=mysqli_fetch_array($view,MYSQL_ASSOC)){
                        ?>
                    <div class="label label-primary"><?php echo $row['Signal'];?>% Sinyal Modem</div>

                     <?php
                     }
                     ?>
                </div>

            </div>
            <div class="col-md-2 col-sm-2 box0">
                <div class="box1">
                    <a href="#"><span class="fa fa-refresh"></span></a>

                <?php

                passthru("net start > service.log");


                $handle = fopen("service.log", "r");


                $status = 0;


                while (!feof($handle))
                {

                    $baristeks = fgets($handle);
                    if (substr_count($baristeks, 'Gammu SMSD Service (GammuSMSD)') > 0)
                    {

                        $status = 1;
                    }
                }

                fclose($handle);

                if ($status == 1) echo "<div class='label label-primary'>Terhubung Gammu</div>";

                else if ($status == 0) echo "<div class='label label-danger'>Terputus</div>";

                ?>

                </div>

            </div>

        </div><!-- /row mt -->


        <div class="row mt">
            <!--CUSTOM CHART START -->
            <div class="border-head">
                <h3>Statistik SMS Masuk Per-Bulan</h3>
            </div>
            <div class="custom-bar-chart">
                <ul class="y-axis">
                    <li><span>100</span></li>
                    <li><span>80</span></li>
                    <li><span>60</span></li>
                    <li><span>40</span></li>
                    <li><span>20</span></li>
                    <li><span>0</span></li>
                </ul>

                <?php
                $total = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox where YEAR(ReceivingDateTime)=2015");
                $data = mysqli_fetch_row($total);
                $totalall = $data[0];

                $hasil1 = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox WHERE MONTH(ReceivingDateTime)='01' and YEAR(ReceivingDateTime)=2015");
                $data1 = mysqli_fetch_row($hasil1);
                $jumlah1 = $data1[0];
                $percent1= $jumlah1 * $totalall /100 ;
                echo "<div class='bar'>
                    <div class='title'>JAN</div>
                    <div class='value tooltips' data-original-title='$data1[0]' data-toggle='tooltip' data-placement='top'>$percent1%</div>
                </div>";

                $hasil2 = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox WHERE MONTH(ReceivingDateTime)='02' and YEAR(ReceivingDateTime)=2015");
                $data2 = mysqli_fetch_row($hasil2);
                $jumlah2 = $data2[0];
                $percent2= $jumlah2 * $totalall /100 ;
                echo "<div class='bar'>
                    <div class='title'>FEB</div>
                    <div class='value tooltips' data-original-title='$data2[0]' data-toggle='tooltip' data-placement='top'>$percent2%</div>
                </div>";

                $hasil3 = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox WHERE MONTH(ReceivingDateTime)='03' and YEAR(ReceivingDateTime)=2015");
                $data3 = mysqli_fetch_row($hasil3);
                $jumlah3 = $data3[0];
                $percent3= $jumlah3 * $totalall /100 ;
                echo "<div class='bar'>
                    <div class='title'>MAR</div>
                    <div class='value tooltips' data-original-title='$data3[0]' data-toggle='tooltip' data-placement='top'>$percent3%</div>
                </div>";

                $hasil4 = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox WHERE MONTH(ReceivingDateTime)='04' and YEAR(ReceivingDateTime)=2015");
                $data4 = mysqli_fetch_row($hasil4);
                $jumlah4 = $data4[0];
                $percent4= $jumlah4 * $totalall /100 ;
                echo "<div class='bar'>
                    <div class='title'>APR</div>
                    <div class='value tooltips' data-original-title='$data4[0]' data-toggle='tooltip' data-placement='top'>$percent4%</div>
                </div>";

                $hasil5 = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox WHERE MONTH(ReceivingDateTime)='05' and YEAR(ReceivingDateTime)=2015");
                $data5 = mysqli_fetch_row($hasil5);
                $jumlah5 = $data5[0];
                $percent5= $jumlah5 * $totalall /100 ;
                echo "<div class='bar'>
                    <div class='title'>MEI</div>
                    <div class='value tooltips' data-original-title='$data5[0]' data-toggle='tooltip' data-placement='top'>$percent5%</div>
                </div>";

                $hasil6 = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox WHERE MONTH(ReceivingDateTime)='06' and YEAR(ReceivingDateTime)=2015");
                $data6 = mysqli_fetch_row($hasil6);
                $jumlah6 = $data6[0];
                $percent6= $jumlah6 * $totalall /100 ;
                echo "<div class='bar'>
                    <div class='title'>JUN</div>
                    <div class='value tooltips' data-original-title='$data6[0]' data-toggle='tooltip' data-placement='top'>$percent6%</div>
                </div>";

                $hasil7 = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox WHERE MONTH(ReceivingDateTime)='07' and YEAR(ReceivingDateTime)=2015");
                $data7 = mysqli_fetch_row($hasil7);
                $jumlah7 = $data7[0];
                $percent7= $jumlah7 * $totalall /100 ;
                echo "<div class='bar'>
                    <div class='title'>JUL</div>
                    <div class='value tooltips' data-original-title='$data7[0]' data-toggle='tooltip' data-placement='top'>$percent7%</div>
                </div>";

                $hasil8 = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox WHERE MONTH(ReceivingDateTime)='08' and YEAR(ReceivingDateTime)=2015");
                $data8 = mysqli_fetch_row($hasil8);
                $jumlah8 = $data8[0];
                $percent8= $jumlah8 * $totalall /100 ;
                echo "<div class='bar'>
                    <div class='title'>AUG</div>
                    <div class='value tooltips' data-original-title='$data8[0]' data-toggle='tooltip' data-placement='top'>$percent8%</div>
                </div>";

                $hasil9 = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox WHERE MONTH(ReceivingDateTime)='09' and YEAR(ReceivingDateTime)=2015");
                $data9 = mysqli_fetch_row($hasil9);
                $jumlah9 = $data9[0];
                $percent9= $jumlah9 * $totalall /100 ;
                echo "<div class='bar'>
                    <div class='title'>SEP</div>
                    <div class='value tooltips' data-original-title='$data9[0]' data-toggle='tooltip' data-placement='top'>$percent9%</div>
                </div>";

                $hasil10 = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox WHERE MONTH(ReceivingDateTime)='10' and YEAR(ReceivingDateTime)=2015");
                $data10 = mysqli_fetch_row($hasil10);
                $jumlah10 = $data10[0];
                $percent10= $jumlah10 * $totalall /100 ;
                echo "<div class='bar'>
                    <div class='title'>OKT</div>
                    <div class='value tooltips' data-original-title='$data10[0]' data-toggle='tooltip' data-placement='top'>$percent10%</div>
                </div>";

                $hasil11 = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox WHERE MONTH(ReceivingDateTime)='11' and YEAR(ReceivingDateTime)=2015");
                $data11 = mysqli_fetch_row($hasil11);
                $jumlah11 = $data11[0];
                $percent11= $jumlah11 * $totalall /100 ;
                echo "<div class='bar'>
                    <div class='title'>NOV</div>
                    <div class='value tooltips' data-original-title='$data11[0]' data-toggle='tooltip' data-placement='top'>$percent11%</div>
                </div>";

                $hasil12 = mysqli_query($mysqli,"SELECT count(*) as jum FROM inbox WHERE MONTH(ReceivingDateTime)='12' and YEAR(ReceivingDateTime)=2015");
                $data12 = mysqli_fetch_row($hasil12);
                $jumlah12 = $data12[0];
                $percent12= $jumlah12 * $totalall /100 ;
                echo "<div class='bar'>
                    <div class='title'>DES</div>
                    <div class='value tooltips' data-original-title='$data12[0]' data-toggle='tooltip' data-placement='top'>$percent12%</div>
                </div>";

                ?>

            </div>
            <!--custom chart end-->
        </div><!-- /row -->

    </div><!-- /col-lg-9 END SECTION MIDDLE -->


    <!-- **********************************************************************************************************************************************************
    RIGHT SIDEBAR CONTENT
    *********************************************************************************************************************************************************** -->

<?php
include "rightsidebar.php";
?>

<?php
}else{
    session_destroy();
    header('Location:index.php?status=Silahkan Login');
}
?>