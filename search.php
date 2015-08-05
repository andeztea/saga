<?php
//SourceCode by AndezNET.com
include('config/koneksi.php');
if(isset($_POST['search_keyword']))
{
    $search_keyword = $mysqli->real_escape_string($_POST['search_keyword']);
    $sqlphonebook="SELECT ID,Name,Number FROM pbk WHERE Name LIKE '%$search_keyword%' or Number LIKE '%$search_keyword%'  ";
    $resphonebook=$mysqli->query($sqlphonebook);

    if($resphonebook === false) {
        trigger_error('Error: ' . $mysqli->error, E_USER_ERROR);
    }else{
        $rows_returned = $resphonebook->num_rows;
    }

    $bold_search_keyword = '<strong>'.$search_keyword.'</strong>';
    if($rows_returned > 0){
        while($rowphonebook = $resphonebook->fetch_assoc())
        {
            echo '<div class="show" align="left"><span class="name">'.str_ireplace($search_keyword,$bold_search_keyword,$rowphonebook['Name']).'</span>&nbsp <span class="phonebook">'.str_ireplace($search_keyword,$bold_search_keyword,$rowphonebook['Number']).'</span></div>';
        }
    }else{
        echo '<div class="show" align="left">No matching records.</div>';
    }
}
?>