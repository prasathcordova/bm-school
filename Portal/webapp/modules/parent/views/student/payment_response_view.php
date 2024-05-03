<div class="row">
    <div class="col-lg-6 col-lg-offset-3" style="text-align:center">
        <h2 id="msg_resp"></h2>
    </div>
</div>
<?php if ($this->session->userdata('is_parent') == 1) { ?>
    <script>
        $(document).ready(function() {
            swal({
                title: '<?php echo $title ?>',
                text: '<?php echo $msg ?>',
                type: '<?php echo $type ?>',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK',
                closeOnConfirm: true
            }, function(isConfirm) {
                window.location = '<?php echo base_url(); ?>'
            });
        })
    </script>
<?php } else { ?>
    <script>
        $(document).ready(function() {
            swal({
                title: '<?php echo $title ?>',
                text: '<?php echo $msg ?>',
                type: '<?php echo $type ?>',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK',
                closeOnConfirm: true
            }, function(isConfirm) {
                window.location = '<?php echo $redirect_link; ?>';
                $('#msg_resp').html('Please close this window for security.')
            });
        })
    </script>

<?php } ?>