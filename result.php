<!DOCTYPE HTML>
<?php
include_once "resources/models/member.class.php";
include_once "resources/models/organizerDAO.class.php";
include_once "resources/models/instructorDAO.class.php";

// Blocking to avoid invalid accesses
session_start();
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    die();
}
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Resultado de pesquisa</title>
    <link rel="icon" type="image/png" href="https://einsteinfloripa.xyz/wp-content/uploads/favicons.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="resources/css/style.css" />
</head>
<body class='image-background'>
    <div class='container bg-1 text-center'>
        <?php
            session_start();
            
            // Set variables to be used on search
            $searching_cpf = $_POST['searching_cpf'];
            $member_type = $_POST['member_type'];
            $option = $_POST['option'];
            $member_info_cpf = new member();
            $member_info_cpf->set_cpf($searching_cpf);
            $member_data;
            
            // According to type of member, search database and load informations
            switch ($member_type) {
                case 'instructor':
                $dao = new instructorDAO();
                $member_data = $dao->get_member_data($member_info_cpf);
                break;
                
                case 'organizer':
                $dao = new organizerDAO();
                $member_data = $dao->get_member_data($member_info_cpf);
                break;
            }
            
            // Case no member found, returns to search interface
            if ($member_data->get_name() == '' && $option != 'insert') {
                echo "<script>
	                  alert('CPF não encontrado!')
	                  document.location = 'search.php'
	              </script>";
	     }
            
            $_SESSION['member_data'] = $member_data;
            $_SESSION['member_type'] = $member_type;

            switch ($option) {
            	// Redirecting to inferfaces acconding to option selected in search interface.
                case 'insert':
                    header('Location: insertion.php');
                    break;
                case 'alter':
                    header('Location: modify.php');
                    break;
                case 'generate':
                    header('Location: generator.php');
                    break;
                case 'consult':
                    echo "
                        <div class='container text-left'>
                            <h3><font color=white> Membro: ".$member_data->get_name()."</font></h3>
                            <table class='table' style='witdh=80%'>
                            <tr>
                            	<td>
                            		<p><font color=white><b>ID:</b></font></p>
                            	</td>
                            	<td>
                            		<p><font color=white> ".$member_data->get_id()." </font></p>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
                            		<p><font color=white><b>Departamento:</b></font></p>
                            	</td>
                            	<td>
                            		<p><font color=white> ".$member_data->get_department()." </font></p>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
                            		<p><font color=white><b>Data de entrada:</b></font></p>
                            	</td>
                            	<td>
                            		<p><font color=white> ".$member_data->get_timestamp_in()." </font></p>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
                            		<p><font color=white><b>Ativo:</b></font></p>
                            	</td>
                            	<td>
                            		<p><font color=white><b>".($member_data->get_active() == 1 ? "<font color=green>ATIVO</font>" : "<font color=red>DESLIGADO</font>")."</b></font></p>
                            	</td>
                            </tr>
                                ".($member_data->get_active() == 0 ? "<tr><td>
                            		<p><font color=white><b>Data de desligamento:</b></font></p>
                            	</td>
                            	<td>
                            		<p><font color=white>".$member_data->get_timestamp_out()."</font></p>
                            	</td></tr>": NULL)."
                            <tr>
                            	<td>
                            		<p><font color=white><b>Telefone:</b></font></p>
                            	</td>
                            	<td>
                            		<p><font color=white> ".$member_data->get_phone_number()." </font></p>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
                            		<p><font color=white><b>E-mail: </b></font></p>
                            	</td>
                            	<td>
                            		<p><font color=white> ".$member_data->get_email()." </font></p>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
                            		<p><font color=white><b>Curso: </b></font></p>
                            	</td>
                            	<td>
                            		<p><font color=white> ".$member_data->get_course()." </font></p>
                            	</td>
                            </tr>
			    <tr>
                            	<td>
                            		<p><font color=white><b>Usuário: </b></font></p>
                            	</td>
                            	<td>
                            		<p><font color=white> ".$member_data->get_user()." </font></p>
                            	</td>
                            </tr>
                            </table>
                               <button class='btn' OnClick='window.location.href=".'"search.php"'."'>Nova Pesquisa</button>
                               <button class='btn' OnClick='window.location.href=".'"modify.php"'."'>Modificar</button>
                               <button class='btn' OnClick='window.location.href=".'"generator.php"'."'>Gerar certificado</button>
                        </div>
                        ";
                break;
            }
        ?>
    </div>
</body>
</html>