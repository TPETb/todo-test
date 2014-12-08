<?php
/**
 * Created by PhpStorm.
 * User: BK
 * Date: 08.12.2014
 * Time: 6:31
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Task {
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
     * @ORM\Column(name="status", type="string")
     */
    protected $status;

    /**
     * @orm\ManyToOne(targetEntity="Section", inversedBy="tasks")
     * @orm\JoinColumn(name="section_id", referencedColumnName="id")
     **/
    protected $section;

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
     * @return Task
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
     * Set status
     *
     * @param string $status
     * @return Task
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set section
     *
     * @param \Application\Entity\Section $section
     * @return Task
     */
    public function setSection(\Application\Entity\Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \Application\Entity\Section 
     */
    public function getSection()
    {
        return $this->section;
    }
}
