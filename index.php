<!DOCTYPE HTML>
<?php
    session_start();
    // Blocking to avoid invalid accesses
    if (isset($_SESSION['logged'])) {
        header("Location: search.php");
    }
    header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Gerador de Certificados</title>
    <link rel="icon" type="image/png" href="https://einsteinfloripa.xyz/wp-content/uploads/favicons.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="resources/css/style.css" />
</head>
<body class='image-background'>
    <div class='container bg-1 text-center'>
        <h1 align='center'><b><font color='white'>Login:</font></b></h1>
        <?php
            if ($_SESSION['tryed'] == 1) {
                echo '<p><font color="red">Usuário ou senha incorretos!</font></p>';
            }
        ?>
        <form method='post' action='login.php'>
            <div class="input-group div-1">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="username" type="text" class="form-control" name="username" accept-charset="utf-8" placeholder="Usuário">
            </div>
            <div class="input-group div-1">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="password" type="password" class="form-control" name="password" accept-charset="utf-8" placeholder="Senha">
            </div>
            <button type='submit' class='btn btn-1'>Entrar</button>
        </form>
    </div>
</body>
</html>