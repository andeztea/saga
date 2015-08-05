(function($) {

    $(document).ready(function(e) {


        var id_inbox = 0;
        var main = "inbox/inbox.data.php";


        $("#data-inbox").load(main);

        $('input:text[name=pencarian]').on('input',function(e){
            var v_cari = $('input:text[name=pencarian]').val();

            if(v_cari!="") {
                $.post(main, {cari: v_cari} ,function(data) {

                    $("#data-inbox").html(data).show();
                });
            } else {

                $("#data-inbox").load(main);
            }
        });


        $('.balas,.baru').live("click", function(){

            var url = "inbox/inbox.form.php";

            id_inbox = this.id;


            $.post(url, {id: id_inbox} ,function(data) {
                $(".datainbox").html(data).show();
            });
        });


        $('.halaman').live("click", function(event){

            kd_hal = this.id;

            $.post(main, {halaman: kd_hal} ,function(data) {

                $("#data-inbox").html(data).show();
            });
        });

    });
}) (jQuery);