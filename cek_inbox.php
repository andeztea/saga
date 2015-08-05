<?php
//SourceCode by AndezNET.com
include "config/koneksi.php" 

?>

<a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
    <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme">
                                <?php

                                $count=mysqli_query($mysqli,"select count(ID)as jum from inbox where Processed='false'");
                                while($row4=mysqli_fetch_array($count,MYSQL_ASSOC)) {
                                    echo "" . $row4['jum'] . "";
                                }
                                ?>
                            </span>
</a>
<ul class="dropdown-menu extended inbox">
    <div class="notify-arrow notify-arrow-green"></div>
    <li>
        <?php

        $count=mysqli_query($mysqli,"select count(ID)as jum from inbox where Processed='false' ");
        while($row4=mysqli_fetch_array($count,MYSQL_ASSOC)) {
            echo "<p class='green'> " . $row4['jum'] . " Pesan</p>";
        }
        ?>

    </li>
    <li>
        <?php
        $pesan=mysqli_query($mysqli,"select ID,SenderNumber,TextDecoded,
		(select a.Name from pbk a where a.Number=b.SenderNumber) as Name,
		(select a.Foto from pbk a where a.Number=b.SenderNumber) as Foto from inbox b 
		where Processed='false' order by ReceivingDateTime DESC limit 5 ");
        $cekpesan=mysqli_num_rows($pesan);
        if ($cekpesan>='1')
        {
        while($row3=mysqli_fetch_array($pesan,MYSQL_ASSOC)) {
            echo "<a href='?id=inbox&mod=cek&idinbox=".$row3['ID']."'>
                <span class='photo'><img alt='avatar' src='".$row3['Foto']."'></span>
                                    <span class='subject'>
									<span class='from'>".$row3['Name']."</span>
                                    <span class='from'>".$row3['SenderNumber']."</span>
                                    <span class='time'></span>
                                    </span>
                                    <span class='message'>
                                        ".substr($row3['TextDecoded'],0,30)."
                                    </span>
            </a>


            ";
        }
            ?>
            <div hidden="hidden">
                <audio controls="controls" autoplay="autoplay">
                    <source src="sound.mp3" type="audio/mpeg" />
                    <embed src="sound.mp3" />
                </audio>
            </div>
        <?php
        }
        ?>
    </li>



    <li>
        <a href="?id=inbox">See all messages</a>
    </li>
</ul>