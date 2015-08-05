<?php
//SourceCode by AndezNET.com
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )

{
?>
<div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->


     <h3>System Information</h3>

         <?php
         $view=mysqli_query($mysqli,"select * from phones");
         $no=1;
         while($row=mysqli_fetch_array($view,MYSQL_ASSOC)){

             ?>

     <div class="desc">
             <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label">IMEI </label>
                 <div class="col-sm-10">
                     :<?php echo $row['IMEI'];?>
                 </div>
             </div>
     </div>


       <div class="desc">
          <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">CLIENT </label>
                     <div class="col-sm-10">
                         :<?php echo $row['Client'];?>
                     </div>
          </div>
      </div>

         <?php
         }
         ?>

                      <!-- First Action -->
                      <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>

                      	<div class="details">
                            <input type='submit' class='btn btn-info' name='submit' value='DONASI'>
                      		   <p>Secangkir Kopi selalu menemani saya mengembangkan SAGA, Donasi anda akan membantu saya untuk menyediakannya agar saya terus berkarya
                      		</p>
                            <p>REKENING BCA 3520428860 A/N MUHAMAD PRADESA</p>
                            <p>REKENING BRI 058801009716503 A/N MUHAMAD PRADESA</p>
                      	</div>

                          <div class="thumb">
                              <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                          </div>

                          <div class="details">
                              <?php

                              if ($_POST['submit'])
                              {
                                  passthru("gammu-smsd -c smsdrc -s");
                              }
                              else
                              {
                                  echo "<form method='post' action=".$_SERVER['PHP_SELF'].">
                                  <input type='submit' class='btn btn-info' name='submit' value='START GAMMU'>
                                  </form>";
                              }
                              ?>
                          </div>

                          </div>

                     <div class="desc">
                          <div class="thumb">
                              <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                          </div>

                          <div class="details">
                              <p><muted></muted>Untuk mengaktifkan autoreply klik button dibawah ini<br/>
                              <a class="btn btn-danger" target="_blank" onclick="window.open('autoreply.php'); return false;">Aktifkan</a>
                          </div>
                      </div>


		
                        <!-- CALENDAR-->
                        <div id="calendar" class="mb">
                            <div class="panel green-panel no-margin">
                                <div class="panel-body">
                                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title" style="disadding: none;"></h3>
                                        <div id="date-popover-content" class="popover-content"></div>
                                    </div>
                                    <div id="my-calendar"></div>
                                </div>
                            </div>
                        </div><!-- / calendar -->
                      
                  </div><!-- /col-lg-3 -->
              </div><! --/row -->
<?php
}else{
    session_destroy();
    header('Location:index.php?status=Silahkan Login');
}
?>