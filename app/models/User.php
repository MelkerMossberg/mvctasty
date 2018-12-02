<?php
    class User {
        private $db;
        public function __construct(){
            $this->db = new Database();
        }

        // Regsiter user
        public function register($data){
            $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
            // Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        //Login user
        public function login($email, $password){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();
            $hashedPassword = $row->password;
            if (password_verify($password, $hashedPassword)){
                return $row;
            }else{
                return false;
            }
        }

        //Find user by email
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            //Bind values
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            //Check row
            if ($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        //Get user by id
        public function getUserById($id){
            $this->db->query('SELECT * FROM users WHERE id = :id');
            //Bind values
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }
    }