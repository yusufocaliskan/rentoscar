<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Page not found.</title>
    <style>
    @import url(http://fonts.googleapis.com/css?family=Ubuntu) ;
        *{
            margin: 0;
            padding: 0;
        }
        body{
            background: url("<?php echo BASEPATH?>views/error/img/bg.jpg");
            color: #666;
            font-family: 'Ubuntu';
        }

        .wrapper{
            width: 1060px;
            margin: 0 auto;
            position: relative;
        }

        .go-back{
            position: absolute;
            top: 20px;
            right: 0;
        }

        .go-back a{
            font-size: 13px;
            color: #FFF;
            border: 1px solid #3F3F3F;
            padding: 3px 5px;
            border-radius: 4px;
            background: #555;
            text-decoration: none;
            margin-bottom: 5px;
            display: block;

        }

        .go-back a:hover{
            background: #222;

        }
        ul{
            list-style: none;

        }

        ul ul{
            list-style: none;

        }
            </style>
</head>
<body>

    <div class="wrapper">

<?php settings::getMenu('','go-back');?>

        <img src="<?php echo BASEPATH?>images/error.jpg" alt="">
    </div>
</body>
</html>