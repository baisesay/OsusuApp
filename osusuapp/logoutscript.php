<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../js/sweetalert2.all.min.js"></script>
</head>

<body>
    <script>
    $('#logout').on('click', function(e) {


        e.preventDefault();
        var logout = $(this).attr('href');
        swal.fire({
            title: 'LOGOUT!',
            text: 'Do you want to logout?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3885d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Logout',

        }).then((result) => {

            if (result.value) {

                document.location.href = logout;
            }

        });
    });
    </script>
</body>

</html>