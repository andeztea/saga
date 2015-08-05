(function($) {

    $(document).ready(function(e) {


        var id_pbk = 0;
        var main = "group/group.data.php";


        $("#data-group").load(main);

        $('input:text[name=pencarian]').on('input',function(e){
            var v_cari = $('input:text[name=pencarian]').val();

            if(v_cari!="") {
                $.post(main, {cari: v_cari} ,function(data) {

                    $("#data-group").html(data).show();
                });
            } else {

                $("#data-group").load(main);
            }
        });


        $('.ubah,.tambah').live("click", function(){

            var url = "group/group.form.php";

            id_group = this.id;

            if(id_group != 0) {

                $("#myModalLabel").html("Ubah Data Group");
            } else {
                $("#myModalLabel").html("Tambah Data Group");
            }

            $.post(url, {id: id_group} ,function(data) {
                $(".group").html(data).show();
            });
        });


        $('.hapus').live("click", function(){
            var url = "group/group.input.php";

            id_group = this.id;

            var answer = confirm("Apakah anda ingin menghapus group ini?");

            if (answer) {

                $.post(url, {hapus: id_group} ,function() {

                    $("#data-group").load(main);
                });
            }
        });

        $('.halaman').live("click", function(event){

            kd_hal = this.id;

            $.post(main, {halaman: kd_hal} ,function(data) {

                $("#data-group").html(data).show();
            });
        });

        $("#simpan-group").bind("click", function(event) {
            var url = "group/group.input.php";

            var vid_group = $('input:text[name=id_group]').val();

            var vnmgroup= $('input:text[name=namegroup]').val();

            $.post(url, {id_group: vid_group, namegroup: vnmgroup,
                id: id_group},function() {
                $("#data-group").load(main);
                $("#dialog-group").modal('hide');
                $("#myModalLabel").html("Tambah Data Group");

            });
        });
    });
}) (jQuery);