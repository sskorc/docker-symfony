<?php

namespace Domain\Entity;

class Task
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $name;

    /** @var \DateTime */
    protected $createdAt;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
