<?php

namespace Api\Task;

class Task {
    private $id = 0;
    private $userId = 0;
    private $name = null;
    private $date = null;
    private $realized = false;

    /**
    * Get the value of id
    */

    public function getId()
 {
        return $this->id;
    }

    /**
    * Set the value of id
    *
    * @return  self
    */

    public function setId( $id )
 {
        $this->id = $id;

        return $this;
    }

    /**
    * Get the value of userId
    */

    public function getUserId()
 {
        return $this->userId;
    }

    /**
    * Set the value of userId
    *
    * @return  self
    */

    public function setUserId( $userId )
 {
        $this->userId = $userId;

        return $this;
    }

    /**
    * Get the value of date
    */

    public function getDate()
 {
        return $this->date;
    }

    /**
    * Set the value of date
    *
    * @return  self
    */

    public function setDate( $date )
 {
        $this->date = $date;

        return $this;
    }

    /**
    * Get the value of realized
    */

    public function getRealized()
 {
        return $this->realized;
    }

    /**
    * Set the value of realized
    *
    * @return  self
    */

    public function setRealized( $realized )
 {
        $this->realized = $realized;

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
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}