<?php
    include_once('resources/models/member.class.php');
    include_once('resources/models/organizerDAO.class.php');
    include_once('resources/models/instructorDAO.class.php');

    session_start();
    // Blocking to avoid invalid accesses
    $member_data = $_SESSION['member_data'];
    if (!isset($_POST['name'])) {
    	header("Location: search.php");
    	die();
    }
    
    // Set values to be inserted
    $member_data->set_department($_POST['department']);
    $member_data->set_name($_POST['name']);
    $member_data->set_timestamp_in($_POST['timestamp_in']);
    $member_data->set_phone_number($_POST['phone_number']);
    $member_data->set_email($_POST['email']);
    $member_data->set_user($_POST['user']);
    $member_data->set_course($_POST['course']);
    $member_data->set_active($_POST['active']);
    $member_data->set_timestamp_out($_POST['timestamp_out']);
    
    $dao;  // Data Access Object
    
    // Create proper dao
    if ($_SESSION['member_type'] == 'organizer') {
        $dao = new organizerDAO();
    } else {
        $dao = new instructorDAO();
    }
   
    $dao->insert_new_member($member_data);
    echo "<script>
	      alert('Informações salvas!')
	      document.location = 'search.php'
	  </script>";
    die();
?>