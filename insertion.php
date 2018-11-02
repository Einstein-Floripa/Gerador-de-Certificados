<!DOCTYPE HTML>
<html>
<?php
    include_once('resources/models/member.class.php');
    // Blocking to avoid invalid accesses
    session_start();
    if ($_SESSION['logged'] != 1) {
        header("Location: index.php");
        die();
    }

    $member_data = $_SESSION['member_data'];
?>
<head>
    <meta charset="utf-8">
    <title>Inserir Membro</title>
    <link rel="icon" type="image/png" href="https://einsteinfloripa.xyz/wp-content/uploads/favicons.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="resources/css/style.css" />
    <!-- Field formatter -->
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
	 <form  action='insert.php' method='post' enctype="text/plain; charset=utf-8">
             <div class='container text-left'>
                    <h3><font color=white> Membro: <input type='text' name='name' class='form-control' value="<?= $member_data->get_name() ?>"></font></h3>
                    
                    <table class='table' style='witdh=80%'>
                        <tr>
                        <td>
                            <p><font color=white><b>CPF: </b></font></p>
                        </td>
                        <td>
                            <div class='input-group default-input'>
                                <input type='text' name='cpf' class='form-control' OnKeyPressed='format(this, "###.###.###-##", event)' value='<?= $member_data->get_cpf() ?>'>
                            </div>
                        </td>
                        </tr>
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
                             <p><font color=white><b>Dia de ingresso:</b></font></p>
                        </td>
                        <td>
                            <div class='input-group default-input'>
                                <input type='date' name='timestamp_in' class='form-control' value='<?= $member_data->get_timestamp_in() ?>'>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <p><font color=white><b>Ativo:</b></font></p>
                        </td>
                        <td>
                            <div class="input-group-btn">
		                <select class='form=control select' name='active'>
		                    <option value=1>Ativo</option>
		                    <option value=0>Inativo</option>
		                </select>
		            </div>
                        </td>
                        </tr>
                        <tr>
                        <td>
                             <p><font color=white><b>Dia de desligamento:</b></font></p>
                        </td>
                        <td>
                            <div class='input-group default-input'>
                                <input type='date' name='timestamp_out' class='form-control' value='<?= $member_data->get_timestamp_out() ?>'>
                            </div>
                        </td>
                        </tr>

                        <tr>
                        <td>
                            <p><font color=white><b>Telefone:</b></font></p>
                       	</td>
                        <td>
                            <div class='input-group default-input'>
                                <input type='text' name='phone_number' class='form-control' value='<?= $member_data->get_phone_number() ?>'
                                 maxlength='13' OnKeyPRess='format(this, "## #####-####", event)'>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <p><font color=white><b>E-mail: </b></font></p>
                        </td>
                        <td>
                            <div class='input-group default-input'>
                                <input type='text' name='email' class='form-control' value='<?= $member_data->get_email() ?>'>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <p><font color=white><b>Curso: </b></font></p>
                        </td>
                        <td>
                            <div class='input-group default-input'>
                                <input type='text' name='course' class='form-control' value='<?= $member_data->get_course() ?>'>
                            </div>
                        </td>
                    </tr>
			<tr>
                        <td>
                            <p><font color=white><b>Usuário: </b></font></p>
                        </td>
                        <td>
                            <div class='input-group default-input'>
                                <input type='text' name='user' class='form-control' value='<?= $member_data->get_user() ?>'>
                            </div>
                        </td>
                    </tr>
                </table>
                <button class='btn' type='button' OnClick='window.location.href="search.php"'>Cancelar</button>
                <button class='btn' type='submit'>Salvar</button>
            </div>
            
        </form>
    </div>
</body>
</html>