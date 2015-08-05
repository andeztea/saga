(function($) {

    $(document).ready(function(e) {


        var id_outbox = 0;
        var main = "outbox/outbox.data.php";

        $("#data-outbox").load(main);

        $('input:text[name=pencarian]').on('input',function(e){
            var v_cari = $('input:text[name=pencarian]').val();

            if(v_cari!="") {
                $.post(main, {cari: v_cari} ,function(data) {

                    $("#data-outbox").html(data).show();
                });
            } else {

                $("#data-outbox").load(main);
            }
        });


        $('.halaman').live("click", function(event){

            kd_hal = this.id;

            $.post(main, {halaman: kd_hal} ,function(data) {

                $("#data-outbox").html(data).show();
            });
        });

    });
}) (jQuery);