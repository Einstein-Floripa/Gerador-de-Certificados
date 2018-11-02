<!DOCTYPE HTML>
<?php
    session_start();
    if (!isset($_SESSION['logged'])) {
        header('Location: index.php');
        die();
    }
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Gerador de Certificados</title>
    <link rel="icon" type="image/png" href="https://einsteinfloripa.xyz/wp-content/uploads/favicons.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 
    <!-- Script de formatação de campos -->
    <script>
        function format(item, mask, event) {
            if (event.keyCode == 8) // Backspace pressed
                return;
    
            var i = item.value.length;
            var out = mask.substring(0, 1);
            var text = mask.substring(i);

            if (text.substring(0, 1) != out) {
                item.value += text.substring(0, 1);
            }
        }
    </script>
    <link rel="stylesheet" href="resources/css/style.css" />
</head>
<body class='image-background'>
    <div class='container bg-1 text-center'>
        <h1 align='center'><b><font color='white'>Pesquisar:</font></b></h1>
        <form action='result.php' method='post'>
            <div class="input-group-btn">
                <select class='form=control select' name='option'>
                    <option value="consult">Pesquisar informações</option>
                    <option value="alter">Alterar dados</option>
                    <option value="generate">Gerar certificados</option>
                    <option value="insert">Inserir membro</option>
                </select>
            </div>
            <div class="input-group-btn">
                <select class='form=control select' name='member_type'>
                    <option value="organizer">Organizador</option>
                    <option value="instructor">Docente</option>
                </select>
            </div>
            <div class='input-group default-input'>
                <input type='text' maxlength='14' onkeypress='format(this, "###.###.###-##",event)' 
                       name='searching_cpf' class='form-control' placeholder='CPF'>
            </div>
            <button type='submit' class='btn btn-1'>Ok</button>
        </form>
    </div>
</body>
</html>