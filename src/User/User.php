<?php

namespace Api\User;

class User {
    private $id = 0;
    private $name = null;
    private $email = null;
    private $username = null;
    private $password = null;
    private $token = null;

    /**
    * Get the value of id
    */

    public function getId() {
        return $this->id;
    }

    /**
    * Set the value of id
    *
    * @return  self
    */

    public function setId( $id ) {
        $this->id = $id;

        return $this;
    }

    /**
    * Get the value of name
    */

    public function getName() {
        return $this->name;
    }

    /**
    * Set the value of name
    *
    * @return  self
    */

    public function setName( $name ) {
        $this->name = $name;

        return $this;
    }

    /**
    * Get the value of email
    */

    public function getEmail() {
        return $this->email;
    }

    /**
    * Set the value of email
    *
    * @return  self
    */

    public function setEmail( $email ) {
        $this->email = $email;

        return $this;
    }

    /**
    * Get the value of username
    */

    public function getUsername() {
        return $this->username;
    }

    /**
    * Set the value of username
    *
    * @return  self
    */

    public function setUsername( $username ) {
        $this->username = $username;

        return $this;
    }

    /**
    * Get the value of password
    */

    public function getPassword() {
        return $this->password;
    }

    /**
    * Set the value of password
    *
    * @return  self
    */

    public function setPassword( $password ) {
        $this->password = $password;

        return $this;
    }

    /**
    * Get the value of token
    */

    public function getToken()
 {
        return $this->token;
    }

    /**
    * Set the value of token
    *
    * @return  self
    */

    public function setToken( $token )
 {
        $this->token = $token;

        return $this;
    }
}