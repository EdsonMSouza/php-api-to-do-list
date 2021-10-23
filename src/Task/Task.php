<?php

namespace Api\Task;

class Task
{
    private int $id = 0;
    private int $userId = 0;
    private $name = null;
    private $date = null;
    private bool $realized = false;

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

    public function setId($id): Task
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of userId
     */

    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @param $userId
     * @return  self
     */

    public function setUserId($userId): Task
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
     * @param $date
     * @return  self
     */

    public function setDate($date): Task
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of realized
     */

    public function getRealized(): bool
    {
        return $this->realized;
    }

    /**
     * Set the value of realized
     *
     * @param $realized
     * @return  self
     */

    public function setRealized($realized): Task
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
     * @param $name
     * @return  self
     */
    public function setName($name): Task
    {
        $this->name = $name;

        return $this;
    }
}