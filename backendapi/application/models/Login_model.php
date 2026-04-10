<?php

	class Login_model extends CI_Model{

		

		public function __construct(){

			parent::__construct();

					}

		public function login($admin_user,$admin_pwd){

  $sqlquery="select * from  admin  where admin_user='$admin_user' and admin_pwd='$admin_pwd' ";

		 //  $row=$this->db->query($qrty);

		  $query=$this->db->query($sqlquery);

		          if($query->num_rows()>0){

            $result=$query->result_array();

            return $result;

		  }
	}

	}		