<script>
    $(document).ready(function (e) {
        // Function to preview image after validation
        $(function() {
            $("#file").change(function() {
                $("#message").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                {
                    $('#previewing').attr('src','noimage.png');
                    $("#message").html("<p id='error'>Mohon Pilih File dengan benar</p>"+"<h4>Catatan</h4>"+"<span id='error_message'>Hanya gambar jpeg, jpg dan png yang di ijinkan</span>");
                    return false;
                }else{
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
        function imageIsLoaded(e) {
            $("#file").css("color","#FFFFFF");
            $('#image_preview').css("display", "block");
            $('#previewing').attr('src', e.target.result);
            $('#previewing').attr('width', '250px');
            $('#previewing').attr('height', '230px');
        };

    });

    //SourceCode by AndezNET.com
    $.validator.setDefaults({
        submitHandler: function () {
            register();

        }

    });

    $().ready(function () {
        // validate the comment form when it is submitted
        $("#valid-pass").validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {

                pass1: {
                    required: true,
                    minlength: 5
                },
                pass2: {
                    required: true,
                    minlength: 5,
                    equalTo: "#pass1"
                }


            },

            messages: {

                password: {
                    required: "Please specify a password.",
                    minlength: "Please specify a secure password."
                }

            },


            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            },

            success: function (e) {
                $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                $(e).remove();
            },

            errorPlacement: function (error, element) {
                if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                    var controls = element.closest('div[class*="col-"]');
                    if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                    else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else error.insertAfter(element.parent());
            }

        });


    });

</script>
