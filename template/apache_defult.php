<?php
    function getURL()
    {
        echo $_SERVER['SERVER_NAME'];
    }

    function desc()
    {
        echo "Website was installed!";
    }
?>

<!DOCTYPE>
<html>
<head lang="pl">
	<meta charset="uft-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php getURL(); ?></title>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">

    <link rel="icon" href="https://www.php.net//images/logos/new-php-logo.svg">
    <style>
        body {
        font-family: 'Raleway';
        }

        h1{
        font-size: 25px;
        font-weight: 800;
        }

        .info{
            font-size: 10px;
            text-align: center;
        }

        .wrapper{
            display: flex;
            justify-content: center;
            margin: 50px;
        }
        .box {
        background: #fff;
        padding: 30px;
        border-radius: 2px;
        display: inline-block;
        margin: 1rem;
        position: relative;
        text-align: center;
        vertical-align: middle;
        line-height: 50px;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }

    </style>
</head>
<body>
<div class="wrapper">
    <div class="box">
        <h1><?php getURL(); ?></h1>
        <p><?php desc(); ?></p>
    </div>
</div>
</body>
</html>

