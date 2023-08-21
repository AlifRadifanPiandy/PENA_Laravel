    
    <title>{{ $meta['title'] }}</title> 
    <meta name="description" content="{{ $meta['description'] }}" />
    <meta name="keywords" content="{{ $meta['keywords'] }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="{{ $meta['type'] }}" />
    <meta property="og:title" content="{{ $meta['title'] }}" />
    <meta property="og:url" content="{{ $meta['url'] }}" />
    <meta property="og:site_name" content="{{ $meta['site_name'] }}" />
    
    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <!-- Vendor Stylesheets -->
    <link rel="stylesheet" type="text/css" href="/assets/plugins/custom/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/plugins/custom/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/plugins/custom/prismjs/prismjs.bundle.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/plugins/custom/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/custom/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/bootstrap-icons/bootstrap-icons.css">

    <!-- Global Stylesheets Bundle -->
    {{-- <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" /> --}}
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <!-- Global Javascript Bundle -->
    <script src="/assets/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/js/scripts.bundle.js"></script>
    
    <!-- Template Main JS File -->
    <script src="/assets/plugins/custom/sweetalert2/sweetalert2.all.min.js"></script>

    <style type="text/css">
        html{scroll-behavior:smooth}
        .btn-sm {font-size: 6px !important; border-radius: 5px !important;}
        .dt-buttons{display: none}
        .of-cover {object-fit: cover;}
        .menu-link i {font-size: 16px; width:16px; margin: 8px 12px 8px 0px;}
        .menu-link.active i {color: #009EF7;}
    </style>