(function($) {

    $(document).ready(function(e) {


        var id_pbk = 0;
        var main = "phonebook/pb.data.php";


        $("#data-pb").load(main);

        $('input:text[name=pencarian]').on('input',function(e){
            var v_cari = $('input:text[name=pencarian]').val();

            if(v_cari!="") {
                $.post(main, {cari: v_cari} ,function(data) {

                    $("#data-pb").html(data).show();
                });
            } else {

                $("#data-pb").load(main);
            }
        });


        $('.ubah,.tambah').live("click", function(){

            var url = "phonebook/pb.form.php";

            id_pbk = this.id;

            if(id_pbk != 0) {

                $("#myModalLabel").html("Ubah Data Phonebook");
            } else {
                $("#myModalLabel").html("Tambah Data Phonebook");
            }

            $.post(url, {id: id_pbk} ,function(data) {
                $(".pb").html(data).show();
            });
        });


        $('.halaman').live("click", function(event){

            kd_hal = this.id;

            $.post(main, {halaman: kd_hal} ,function(data) {

                $("#data-pb").html(data).show();
            });
        });


    });
}) (jQuery);