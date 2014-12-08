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
     * @todo add check for user removal to avoid error 500 if user arrives after his removal
     */
    public function indexAction()
    {
        $session = new Container('user');

        if (!$session->id) {
            $this->redirect()->toUrl('/application/user/login');
        }

        $em = $this
            ->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');

        $user = $em->find('Application\Entity\User', $session->id);

        return new ViewModel([
            'user' => $user,
        ]);
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


    public function logoutAction()
    {
        $session = new Container('user');

        $session->id = null;

        $this->redirect()->toUrl('/application/user/index');
    }
} 