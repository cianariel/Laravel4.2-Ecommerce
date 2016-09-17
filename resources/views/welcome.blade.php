<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body class="{{Layout::getRouteClass()}}">
        <div class="container">
            <div class="content">
                <?php
                if(DB::connection()->getDatabaseName())
                {
                    echo "Successfully connected to the DB: " . DB::connection()->getDatabaseName();
                }

                if($disk = Storage::disk('s3')->size('test/test.gif')){
                     echo "<br/> Successfully connected to S3 " ;
                }

                ?>
            </div>
        </div>
    </body>
</html>