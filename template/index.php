<!DOCTYPE>
<html>
<head lang="pl">
	<meta charset="uft-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $_SERVER['SERVER_NAME']; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
    body {
    font-family: 'Raleway';
    font-size: 50px;
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


    p{
    font-size: 15px;
    text-align: center;
    }
</style>
</head>
<body>
<div class="wrapper">
    <div class="box">
        <?php echo $_SERVER['SERVER_NAME']; ?>
        <br>
        <p>Strona została zainstalowana!</p>
    </div>
</div>
</body>
</html>

