<?php
/**
 * Created by PhpStorm.
 * User: BK
 * Date: 08.12.2014
 * Time: 6:28
 */

namespace Application\Entity;

USE Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Section
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="section")
     */
    protected $tasks;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set name
     *
     * @param string $name
     * @return Section
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Add tasks
     *
     * @param \Application\Entity\Task $tasks
     * @return Section
     */
    public function addTask(\Application\Entity\Task $tasks)
    {
        $this->tasks[] = $tasks;

        return $this;
    }


    /**
     * Remove tasks
     *
     * @param \Application\Entity\Task $tasks
     */
    public function removeTask(\Application\Entity\Task $tasks)
    {
        $this->tasks->removeElement($tasks);
    }


    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}
