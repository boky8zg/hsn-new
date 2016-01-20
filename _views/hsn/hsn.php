<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $sites[$site]['menu']; ?> &#x2756; Hrvatska Sveučilišna Naklada</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Hrvatska sveučilišna naklada" />
        <meta name="keywords" content="hsn,hrvatska,sveučilišna,naklada" />
        <meta name="author" content="Bojan Došen" />

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800|PT+Serif:400,700&subset=latin,latin-ext" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/css/bootstrap-hsn.css" />
        <link rel="stylesheet" href="/css/jquery.scrollbar.css" />
        <link rel="icon" href="/images/favicon.png" />

        <script src="/js/jquery.min.js"></script>
        <script src="/js/jquery.scrollbar.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/hsn.js"></script>
    </head>
    <body>
        <!--
        <div class="alert alert-warning" role="alert" style="position: fixed; bottom: 0; right: 20px; display: inline-block; z-index: 1000;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>U izradi!</strong>
            Stranica je još u izdradi, te su moguće poteškoće sa radom.
        </div>
        -->
        <div class="outer-wrapper">
            <div class="wrapper">
                <div class="navbar-left">
                    <div class="brand">
                        <img height="80" style="position: relative; top: -10px;" src="/images/logo.png" alt="Hrvatska Sveučilišna Naklada" />
                        
                        <small style="text-shadow: 0 0 5px #15150f">Hrvatska Sveučilišna Naklada</small>
                    </div>

                    <h3>Izbornik</h3>
                    <ul class="nav nav-pills nav-stacked">
                        <?php starteach(Menu()); ?>
                            <li{{3}}><a href="{{2}}">{{0}}</a></li>
                        <?php endeach(); ?>
                    </ul>

                    <?php if (fnmatch('/biblioteke/*/', route())): ?>
                    <h3>Kategorije</h3>
                    <ul class="nav nav-pills nav-stacked sub-menu">
                        <li><a href="">Test</a></li>
                    </ul>
                    <?php endif; ?>

                    <footer>
                        <small>&copy; Bojan Došen, 2015.</small>
                    </footer>
                </div>

                {{content}}
            </div>
        </div>
    </body>
</html>
