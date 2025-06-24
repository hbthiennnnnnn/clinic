<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>{{ ($title ?? 'Admin') . ' | Healing Care' }}</title>
<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
<link rel="icon" href="{{ asset('user/assets/img/favicon.ico') }}?v=1" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('user/assets/img/favicon.ico') }}?v=1" type="image/x-icon">

<!-- Fonts and icons -->
<script src="/admin-assets/js/plugin/webfont/webfont.min.js"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["/admin-assets/css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="/admin-assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="/admin-assets/css/plugins.min.css" />
<link rel="stylesheet" href="/admin-assets/css/kaiadmin.min.css" />
<link rel="stylesheet" href="/admin-assets/css/custom.css" />
<link rel="stylesheet" href="/admin-assets/css/toastr.min.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@routes