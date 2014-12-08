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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
} 