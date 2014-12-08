<?php
/**
 * Created by PhpStorm.
 * User: BK
 * Date: 08.12.2014
 * Time: 7:46
 */

namespace Application\Controller;

use Application\Entity\Section;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

class SectionController extends AbstractActionController
{
    public function indexAction()
    {
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


    public function readAction()
    {
        $id = $this->params()->fromQuery('id');

        $em = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');

        $section = $em->getRepository('Application\Entity\Section')->find($id);

        return new ViewModel([
            'section' => $section,
        ]);
    }

    public function createAction()
    {
        $session = new Container('user');

        if (!$session->id) {
            $this->flashMessenger()->addMessage('Only logged users are allowed to create section');
            $this->redirect()->toUrl('/');
        }

        $em = $this
            ->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');

        if ($this->params()->fromPost('name')) {
            $section = new Section();
             $section->setName($this->params()->fromPost('name'));
            $em->persist($section);
            $em->flush();

            $this->redirect()->toUrl('/application/section/read?id=' . $section->getId());
        } else {
            $sections = $em->getRepository('Application\Entity\Section')->findAll();

            return new ViewModel([
                'sections' => $sections
            ]);
        }
    }

    public function updateAction()
    {

    }
} 