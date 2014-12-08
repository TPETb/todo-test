<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/8/14
 * Time: 12:12 PM
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package Application\Entity
 *
 * @ORM\Entity
 * @todo add *mandatory* to login/password
 * @todo add *unique* to login
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;


    /** @ORM\Column(type="string") */
    protected $fullName;


    /** @ORM\Column(type="string") */
    protected $login;


    /** @ORM\Column(type="string") */
    protected $password;


    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }


    /**
     * @param mixed $fullName
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }


    /**
     * @param mixed $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }


}
