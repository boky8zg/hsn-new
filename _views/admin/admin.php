<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="utf-8" />
        <title>HSN :: Admin panel</title>

        <link rel="stylesheet" href="//{{root}}/css/bootstrap.min.css" />
        <link rel="stylesheet" href="//{{root}}/css/bootstrap-admin.css" />
        <?php if(isset($array['styles'])) {starteach($array['styles'], 'style'); ?>
            <link rel="stylesheet" href="//{{root}}/css/{{style}}" />
        <?php endeach();} ?>

        <script src="//{{root}}/js/jquery.min.js"></script>
        <script src="//{{root}}/js/bootstrap.min.js"></script>
        <?php if(isset($array['scripts'])) {starteach($array['scripts'], 'script'); ?>
            <script src="//{{root}}/js/{{script}}"></script>
        <?php endeach();} ?>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{root}}">Admin panel</a>
            </div>
        </nav>

        <div class="container-fluid content">
            <div class="row">
                <div class="col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <?php starteach(Menu()); ?>
                        <li{{3}}><a href="//{{root}}{{2}}">{{0}}</a></li>
                        <?php endeach(); ?>
                    </ul>
                </div>

                <div class="col-md-10 col-md-offset-2">
                    {{content}}
                </div>
            </div>
        </div>
    </body>
</html>
