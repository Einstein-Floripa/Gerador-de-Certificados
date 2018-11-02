<?php
    class member {
        private $cpf;
        private $id;
        private $name;
        private $department;
        private $semester_in;
        private $semester_out;
        private $active;
        private $phone_number;
        private $email;
        private $course;
        private $user;

        // Getters
        public function get_cpf() {
            return $this->cpf;
        }

        public function get_id() {
            return $this->id;
        }
        
        public function get_name() {
            return $this->name;
        }
        
        public function get_department() {
            return $this->department;
        }
        
        public function get_timestamp_in() {
            return $this->semester_in;
        }

        public function get_timestamp_out() {
            return $this->semester_out;
        }

        public function get_active() {
            return $this->active;
        }

        public function get_phone_number() {
            return $this->phone_number;
        }

        public function get_email() {
            return $this->email;
        }

        public function get_course() {
            return $this->course;
        }

        public function get_user() {
            return $this->user;
        }

        // Setters
        public function set_cpf($cpf) {
            $this->cpf = $cpf;
        }

        public function set_id($id) {
            $this->id = $id;
        }
        
        public function set_name($name) {
            $this->name = $name;
        }
        
        public function set_department($department) {
            $this->department = $department;
        }
        
        public function set_timestamp_in($semester_in) {
            $this->semester_in = $semester_in;
        }

        public function set_timestamp_out($semester_out) {
            $this->semester_out = $semester_out;
        }

        public function set_active($active) {
            $this->active = $active;
        }

        public function set_phone_number($phone_number) {
            $this->phone_number = $phone_number;
        }

        public function set_email($email) {
            $this->email = $email;
        }

        public function set_course($course) {
            $this->course = $course;
        }

        public function set_user($user) {
            $this->user = $user;
        }
    }
?>