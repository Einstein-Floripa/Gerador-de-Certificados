<!DOCTYPE HTML>
<html>
<?php
    require_once('resources/models/member.class.php');   
    session_start();
    // Blocking to avoid invalid accesses
    if (!isset($_SESSION['logged'])) {
        header("Location: index.php");
        die();
    } 
       
    $member_data = $_SESSION['member_data'];

?>
<head>
    <meta charset="utf-8">
    <title>Interface de montagem</title>
    <link rel="icon" type="image/png" href="https://einsteinfloripa.xyz/wp-content/uploads/favicons.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="resources/css/style.css" />
    <!-- Field formatter script -->
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
</head>
<body class='image-background'>
    <div class='container bg-1 text-center'>
	 <form  action='generate.php' method='post' enctype="text/plain; charset=utf-8">
             <div class='container text-left'>
                    <h3><font color=white> Membro: <input type='text' name='name' class='form-control' value="<?= $member_data->get_name() ?>"></font></h3>
                    
                    <table class='table' style='witdh=80%'>
                    <tr>
                        <td>
                            <p><font color=white><b>Departamento:</b></font></p>
                        </td>
                        <td>
                           <div class='input-group default-input'>
                                <select name='department' class='form-control' value='<?= $member_data->get_department() ?>'>
                                    <option value='<?= $member_data->get_department() ?>' ?><?= $member_data->get_department() ?></option>
                                    <option value='Banco Central (Financeiro)'>Banco Central (Financeiro)</option>
                                    <option value='Embaixada do Amor (RH)'>Embaixada do Amor (RH)</option>
                                    <option value='Inteligência (Estatística)'>Inteligência (Estatística)</option>
                                    <option value='Gold Diggers (Captação)'>Gold Diggers (Captação)</option>
                                    <option value='Hogwarts (Ensino)'>Hogwarts (Ensino)</option>
                                    <option value='Hollywood (Marketing)'>Hollywood (Marketing)</option>
                                    <option value='Matrix (TI)'>Matrix (TI)</option>
                                    <option value='Tribunal (Jurídico)'>Tribunal (Jurídico)</option>
                                    <option value='Presidente'>Presidente</option>
                                    <option value='Setor de ensino'>Setor de ensino</option>
                                </select>
                           </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <p><font color=white><b>Data de ingresso:</b></font></p>
                        </td>
                        <td>
                            <div class='input-group default-input'>
                                <input type='date' name='timestamp_in' class='form-control' value='<?= $member_data->get_timestamp_in() ?>'>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <p><font color=white><b>Data de desligamento:</b></font></p>
                        </td>
                        <td>
                            <div class='input-group default-input'>
                                <input type='date' name='timestamp_out' class='form-control' value='<?= $member_data->get_timestamp_out() ?>'>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><font color=white><b>Tipo de certificado:</b></font></p>
                        </td>
                        <td>
                           <div class='input-group default-input'>
                                <select name='member_type' class='form-control' value='<?= $member_data->get_department() ?>'>
                                    <option value='organizer'>Organizador(a)</option>
                                    <option value='director'>Diretor(a)</option>
                                    <option value='teacher'>Professor(a)</option>
                                    <option value='instructor'>Monitor(a)</option>
                                </select>
                           </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><font color=white><b>Gênero:</b></font></p>
                        </td>
                        <td>
                           <div class='input-group default-input'>
                                <select name='gender' class='form-control' value='<?= $member_data->get_department() ?>'>
                                    <option value='masc'>Masculino</option>
                                    <option value='fem'>Feminino</option>
                                </select>
                           </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <p><font color=white><b>Presidente:</b></font></p>
                        </td>
                        <td>
                            <div class='input-group default-input'>
                                <input type='text' name='president' class='form-control' value='Pedro Martins Vieira'>
                            </div>
                        </td>
                    </tr>
                </table>
                <button class='btn' type='button' OnClick='window.location.href="search.php"'>Cancelar</button>
                <button class='btn' type='submit'>Gerar</button>
            </div>
        </form>
    </div>
</body>
</html>