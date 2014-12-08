<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/8/14
 * Time: 12:36 PM
 */

namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

/**
 * Class UserController
 * @package Application\Controller
 */
class UserController extends AbstractActionController
{
    /**
     *
     */
    public function indexAction()
    {
        $session = new Container('user');
        if (!$session->id) {
            $this->redirect()->toUrl('/application/user/login');
        }
    }


    /**
     *
     * @todo reshape form submission check
     */
    public function loginAction()
    {
        $session = new Container('user');

        if ($session->id) {
            $this->redirect()->toUrl('/application/user/index');
        }

        if ($this->params()->fromPost('login')) {
            $em = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');

            $users = $em->getRepository('Application\Entity\User')
                ->findBy(array('login' => $this->params()->fromPost('login')));

            if (!count($users)) {
                return new ViewModel(array(
                    'message' => 'Wrong login or password',
                ));
            }

            $user = array_pop($users);

            if ($user->getPassword() == $this->params()->fromPost('password')) {
                $session->id = $user->getId();
                $this->redirect()->toUrl('/application/user/index');
            } else {
                return new ViewModel(array(
                    'message' => 'Wrong login or password',
                ));
            }
        }
    }
} 