<html>

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="site-storage-url"content="{{asset('storage/')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $options->SiteOptions->site_name}} - admin</title>
    <link rel="icon" type="image/svg+xml" sizes="219x55" href="{{ asset('storage/' . $options->SiteOptions->site_icon)}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/admin/css/styles.css">
</head>

<body>
<img src="/assets/admin/img/Intersection 3.svg" style="position: fixed;bottom: 0;left: 0;width: 30%;" />
<img src="/assets/admin/img/Intersection 4.svg" style="width: 20%;position: fixed;right: 0;top: 0;" />
    <div class="login-clean" style="height: 100vh;">
        <form method="post" action="/admin/utilisateurs/auth" >
            {{ csrf_field() }}
            @method('POST')
            <div class="illustration"><img src="/assets/admin/img/YdEz0PC7qpHBGgL5WLOR250LykIRZYFhF6Aguw2m.svg" /></div>
            @if(isset($_GET['error']))
                <div class="alert alert-danger">Identifiant ou mot de passe incorrect</div>
            @endif
            <div class="form-group"><input type="username" class="form-control" name="username" placeholder="Nom d&#39;utilisateur" /></div>
            <div class="form-group"><input type="password" class="form-control" name="password" placeholder="Mot de passe" /></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">S&#39;identifier</button></div><a class="forgot sr-only" href="#">Vous avez oublié votre nom d&#39;utilisateur ou votre mot de passe?</a></form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>