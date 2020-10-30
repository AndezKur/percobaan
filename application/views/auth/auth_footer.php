    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#username').on("input", function(e) {
                var username = $('#username').val();
                if (username != '') {
                    $.ajax({
                        url: "<?php echo base_url('auth/check_username'); ?>",
                        method: "POST",
                        data: {
                            username: username
                        },
                        success: function(data) {
                            $('#pesan').html(data);
                        }
                    });
                } else {
                    $("#pesan").html("<small class='text-danger pl-3'><i class='fas fa-exclamation-circle'></i> Username is required field!</small>");
                }
            });
        });
    </script>
    <!-- script show password-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.checkbox-form').click(function() {
                if ($(this).is(':checked')) {
                    $('.password-form').attr('type', 'text');
                } else {
                    $('.password-form').attr('type', 'password');
                }
            });
        });
    </script>

    </body>

    </html>