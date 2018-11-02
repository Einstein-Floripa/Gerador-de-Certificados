<?php
    require_once('resources/models/member.class.php');   
    session_start();
    // Blocking to avoid invalid accesses
    if (!isset($_SESSION['logged'])) {
        header("Location: index.php");
        die();
    }
    $member_data = $_SESSION['member_data'];
	
    //  weeks between two date calculator
    function weeks_between($date_in, $date_out) {	
    	// Create Datetimes
        $date_in = new Datetime($date_in);
        $date_out = new Datetime($date_out);
        
        // Take the dif
        $time = $date_out->diff($date_in);
        
        // Divide days by 7 to get number of weeks, rounded down
        return floor($time->days/7);
    }

    // Doompdf shenanigans
    require_once 'resources/dompdf/lib/html5lib/Parser.php';
    require_once 'resources/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
    require_once 'resources/dompdf/lib/php-svg-lib/src/autoload.php';
    require_once 'resources/dompdf/src/Autoloader.php';
    Dompdf\Autoloader::register();
    use Dompdf\Dompdf;

    // Constants for time
    $times['organizer'] = 15;
    $times['director'] = 15;
    $times['teacher'] = 10;
    $times['instructor'] = 5;

    $dompdf = new Dompdf();
    // Open html text in variable
    $html = file_get_contents('resources/models/certificado.html');
    
    
    // A lot of replaces in html file. 
    $html = str_replace("%NAME%", $member_data->get_name(), $html);
    $html = str_replace("%CPF%", $member_data->get_cpf(), $html);
    
    // Switching between member type and gender  
    // Also removing 'Departamento' from teachers and instructors  
    switch ($_POST['member_type']) {
    	case 'organizer':
    	    if ($_POST['gender'] == 'masc')
    	        $html = str_replace("%FUNCTION%", 'ORGANIZADOR', $html);
    	    else
    	        $html = str_replace("%FUNCTION%", 'ORGANIZADORA', $html);
    	    
    	    $html = str_replace("%SECTOR%", 'Departamento', $html);
    	    break;
    	case 'director':
    	    if ($_POST['gender'] == 'masc')
    	        $html = str_replace("%FUNCTION%", 'DIRETOR', $html);
    	    else
    	        $html = str_replace("%FUNCTION%", 'DIRETORA', $html);  
    	        
    	    
    	    $html = str_replace("%SECTOR%", 'Departamento', $html);   	        
    	    break;
    	case 'teacher':
    	    if ($_POST['gender'] == 'masc')
    	        $html = str_replace("%FUNCTION%", 'PROFESSOR', $html);
    	    else
    	        $html = str_replace("%FUNCTION%", 'PROFESSORA', $html);
    	        
    	    
    	    $html = str_replace("%SECTOR%", '', $html);
    	    break;
    	case 'instructor':
    	    if ($_POST['gender'] == 'masc')
    	        $html = str_replace("%FUNCTION%", 'MONITOR', $html);
    	    else
    	        $html = str_replace("%FUNCTION%", 'MONITORA', $html);
    	        
    	    
    	    $html = str_replace("%SECTOR%", '', $html);
    	    break;
    }
    
    $html = str_replace("%DEPARTAMENT%", $member_data->get_department(), $html);
    
    // Calculating weeks between timestamp_in and timestamp_out
    $weeks = weeks_between($member_data->get_timestamp_in(), $member_data->get_timestamp_out());
    
    $html = str_replace("%HOURS%", $weeks*$times[$_POST['member_type']], $html);
    $html = str_replace("%HOURS_PER_WEEK%", $times[$_POST['member_type']], $html);
    
    
    $html = str_replace("%PRESIDENT%", $_POST['president'], $html);
    
    $html = str_replace("%DATETIME%", date('d/m/Y'), $html);
    

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();

    $dompdf->stream("ceritificado_'".$member_data->get_name()."'.pdf");
?>