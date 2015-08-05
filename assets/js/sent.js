(function($) {

    $(document).ready(function(e) {


        var id_sent = 0;
        var main = "sent/sent.data.php";


        $("#data-sent").load(main);

        $('input:text[name=pencarian]').on('input',function(e){
            var v_cari = $('input:text[name=pencarian]').val();

            if(v_cari!="") {
                $.post(main, {cari: v_cari} ,function(data) {

                    $("#data-sent").html(data).show();
                });
            } else {

                $("#data-sent").load(main);
            }
        });




        $('.halaman').live("click", function(event){

            kd_hal = this.id;

            $.post(main, {halaman: kd_hal} ,function(data) {

                $("#data-sent").html(data).show();
            });
        });

    });
}) (jQuery);