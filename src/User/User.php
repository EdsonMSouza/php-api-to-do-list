<?php

namespace Api\User;

class User
{
    private int $id = 0;
    private $name = null;
    private $email = null;
    private $username = null;
    private $password = null;
    private $token = null;
    private $picture = null;

    /**
     * Get the value of id
     */

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param $id
     * @return  self
     */

    public function setId($id): User
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */

    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param $name
     * @return  self
     */

    public function setName($name): User
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param $email
     * @return  self
     */

    public function setEmail($email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of username
     */

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param $username
     * @return  self
     */

    public function setUsername($username): User
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param $password
     * @return  self
     */

    public function setPassword($password): User
    {
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
     * @param $token
     * @return  self
     */

    public function setToken($token): User
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of picture
     */

    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param $picture
     * @return  self
     */

    public function setPicture($picture): User
    {
        $this->picture = $picture;

        return $this;
    }
}
