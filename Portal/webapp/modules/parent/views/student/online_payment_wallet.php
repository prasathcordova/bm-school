<script>
    load_student(<?php echo $student_id ?>)

    function load_student(student_id) {
        var ops_url = baseurl + 'parent-portal/show_student_wallet/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": student_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-content').html(data.view);
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    return false;
                } else {
                    swal('', 'An error occured while fetching data. Please try again later or contact administrator with error code : DPRDTAER10005', 'info');
                    return false;
                }


            }
        });
    }
</script>