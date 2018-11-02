<?php
include_once('resources/core/connection.class.php');
include_once('resources/models/member.class.php');

class organizerDAO {
    const INSERT_ORG = "insert into organizers (CPF, name, timestamp_in, timestamp_out, phone_number, email, course, user, active, department) values(?,?,?,?,?,?,?,?,?,?)";
    const SELECT_BY_CPF = "select * from organizers where CPF=?";
    const SELECT_NAME = "select * from organizers where name=?";
    const EDIT_ORG_PHONE_BY_CPF = "update organizers set phone_number=? where CPF=?";
    const EDIT_ORG_NAME_BY_CPF = "update organizers set name=? where CPF=?";
    const EDIT_ORG_EMAIL_BY_CPF = "update organizers set email=? where CPF=?";
    const EDIT_ORG_COURSE_BY_CPF = "update organizers set course=? where CPF=?";
    const EDIT_ORG_USER_BY_CPF = "update organizers set user=? where CPF=?";
    const EDIT_ORG_ACTIVE_BY_CPF = "update organizers set active=? where CPF=?";
    const EDIT_ORG_DEPARTMENT_BY_CPF = "update organizers set department=? where CPF=?";
    const EDIT_ORG_TIMESTAMP_OUT_BY_CPF = "update organizers set timestamp_out=? where CPF=?";
    const EDIT_ORG_TIMESTAMP_IN_BY_CPF = "update organizers set timestamp_in=? where CPF=?";
    
    
    function insert_new_member(member $m) {
        $connection = new Connection();
        $conn = $connection->getConnect();
        
        $pst = $conn->prepare(self::SELECT_BY_CPF);
        $pst->bindValue(1, $m->get_cpf(), PDO::PARAM_STR);
        $pst->execute();
        $result = $pst->fetch(PDO::FETCH_OBJ);
        
        if ($result->name != '') {
            self::save_member_data($m);
            return;
        }
        
        $pst = $conn->prepare(self::INSERT_ORG);
        $pst->bindValue(1, $m->get_cpf(), PDO::PARAM_STR);
        $pst->bindValue(2, $m->get_name(), PDO::PARAM_STR);
        $pst->bindValue(3, $m->get_timestamp_in(), PDO::PARAM_STR);
        $pst->bindValue(4, $m->get_timestamp_out(), PDO::PARAM_STR);
        $pst->bindValue(5, $m->get_phone_number(), PDO::PARAM_STR);
        $pst->bindValue(6, $m->get_email(), PDO::PARAM_STR);
        $pst->bindValue(7, $m->get_course(), PDO::PARAM_STR);
        $pst->bindValue(8, $m->get_user(), PDO::PARAM_STR);
        $pst->bindValue(9, $m->get_active(), PDO::PARAM_INT);
        $pst->bindValue(10, $m->get_department(), PDO::PARAM_INT);
        $pst->execute();
        $conn = NULL;
    }
    
    function get_member_data(member $m) {
        $connection = new Connection();
        $conn = $connection->getConnect();
        $pst = $conn->prepare(self::SELECT_BY_CPF);
        $pst->bindValue(1, $m->get_cpf(), PDO::PARAM_STR);
        $pst->execute();
        $result = $pst->fetch(PDO::FETCH_OBJ);
        $conn = NULL;
       
        $m->set_name($result->name);
        $m->set_id($result->ID);
        $m->set_department($result->department);
        $m->set_timestamp_in($result->timestamp_in);
	$m->set_timestamp_out($result->timestamp_out);
	$m->set_active($result->active);
	$m->set_phone_number($result->phone_number);
	$m->set_email($result->email);
	$m->set_course($result->course);
	$m->set_user($result->user);

        return $m;
    }
    
    function save_member_data(member $m) {
        $connection = new Connection();
        $conn = $connection->getConnect();
        
        $pst = $conn->prepare(self::SELECT_BY_CPF);
        $pst->bindValue(1, $m->get_cpf(), PDO::PARAM_STR);
        $pst->execute();
        $result = $pst->fetch(PDO::FETCH_OBJ);
        
        $pst = $conn->prepare(self::EDIT_ORG_PHONE_BY_CPF);
        $pst->bindValue(1, $m->get_phone_number(), PDO::PARAM_STR);
        $pst->bindValue(2, $m->get_cpf(), PDO::PARAM_STR);
        $pst->execute();
        
        
        $pst = $conn->prepare(self::EDIT_ORG_NAME_BY_CPF);
        $pst->bindValue(1, $m->get_name(), PDO::PARAM_STR);
        $pst->bindValue(2, $m->get_cpf(), PDO::PARAM_STR);
        $pst->execute();
        
        
        $pst = $conn->prepare(self::EDIT_ORG_EMAIL_BY_CPF);
        $pst->bindValue(1, $m->get_email(), PDO::PARAM_STR);
        $pst->bindValue(2, $m->get_cpf(), PDO::PARAM_STR);
        $pst->execute();
        
        $pst = $conn->prepare(self::EDIT_ORG_USER_BY_CPF);
        $pst->bindValue(1, $m->get_user(), PDO::PARAM_STR);
        $pst->bindValue(2, $m->get_cpf(), PDO::PARAM_STR);
        $pst->execute();
        
        $pst = $conn->prepare(self::EDIT_ORG_ACTIVE_BY_CPF);
        $pst->bindValue(1, $m->get_active(), PDO::PARAM_INT);
        $pst->bindValue(2, $m->get_cpf(), PDO::PARAM_STR);
        $pst->execute();

        $pst = $conn->prepare(self::EDIT_ORG_DEPARTMENT_BY_CPF);
        $pst->bindValue(1, $m->get_department(), PDO::PARAM_STR);
        $pst->bindValue(2, $m->get_cpf(), PDO::PARAM_STR);
        $pst->execute();

        $pst = $conn->prepare(self::EDIT_ORG_TIMESTAMP_IN_BY_CPF);
        $pst->bindValue(1, $m->get_timestamp_in(), PDO::PARAM_STR);
        $pst->bindValue(2, $m->get_cpf(), PDO::PARAM_STR);
        $pst->execute();

        $pst = $conn->prepare(self::EDIT_ORG_TIMESTAMP_OUT_BY_CPF);
        $pst->bindValue(1, $m->get_timestamp_out(), PDO::PARAM_STR);
        $pst->bindValue(2, $m->get_cpf(), PDO::PARAM_STR);
        $pst->execute();
        
        $pst = $conn->prepare(self::EDIT_ORG_COURSE_BY_CPF);
        $pst->bindValue(1, $m->get_course(), PDO::PARAM_STR);
        $pst->bindValue(2, $m->get_cpf(), PDO::PARAM_STR);
        $pst->execute();
        $conn = NULL;        
    }
}
?>