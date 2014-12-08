<?php
/**
 * Created by PhpStorm.
 * User: BK
 * Date: 08.12.2014
 * Time: 7:46
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

class SectionController extends AbstractActionController{
    public function indexAction(){
        $session = new Container('user');

        if (!$session->id) {
            $this->redirect()->toUrl('/application/user/login');
        }

        $em = $this
            ->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');

        $sections = $em->getRepository('Application\Entity\Section')
            ->findAll();

        return new ViewModel([
            'sections' => $sections,
        ]);
    }

    public function readAction(){

        $session = new Container('user');

        if (!$session->id) {
            $this->redirect()->toUrl('/application/user/login');
        }
        $id = $this->params()->fromQuery('id');
        $em = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');

        $section = $em->getRepository('Application\Entity\Section')->find($id);

        return new ViewModel([
            'section' => $section,
        ]);


    }
} 