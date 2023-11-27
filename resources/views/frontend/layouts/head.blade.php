<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500&family=Playfair+Display+SC&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

<link rel="stylesheet" href="/css/global.min.css">

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" href="/{{ $web_info->detail->favicon->link }}"/>

<style>
    .swal2-popup {
        padding: 0 !important;
    }
    .swal2-html-container {
        margin: 0rem !important;
    }
</style>