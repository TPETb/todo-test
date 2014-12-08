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
 * @todo make status enumerable
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
     * @orm\ManyToOne(targetEntity="User", inversedBy="tasks")
     * @orm\JoinColumn(name="creator_id", referencedColumnName="id")
     **/
    protected $creator;


}