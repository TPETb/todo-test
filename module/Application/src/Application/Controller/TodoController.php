<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/8/14
 * Time: 12:34 PM
 */

namespace Application\Controller;


use Application\Entity\Task;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

/**
 * Class TodoController
 * @package Application\Controller
 * @todo add validation to create/update/delete
 */
class TodoController extends AbstractActionController
{
    /**
     *
     * @todo rework post detection for general check rather then param
     */
    public function createAction()
    {
        $session = new Container('user');

        if (!$session->id) {
            $this->flashMessenger()->addMessage('Only logged users are allowed to create todo');
            $this->redirect()->toUrl('/');
        }

        $em = $this
            ->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');

        $user = $em->find('Application\Entity\User', $session->id);

        if ($this->params()->fromPost('name')) {
            $task = new Task();
            $task->setCreator($user);
            $task->setName($this->params()->fromPost('name'));
            $task->setSection($em->find('Application\Entity\Section', $this->params()->fromPost('section')));
            $task->setStatus('todo');

            $em->persist($task);
            $em->flush();

            $this->redirect()->toUrl('/application/todo/read?id=' . $task->getId());
        } else {
            $sections = $em->getRepository('Application\Entity\Section')->findAll();

            return new ViewModel([
                'sections' => $sections
            ]);
        }
    }


    /**
     *
     * @todo rework fromQuery to fromRoute if routes are in use
     * @todo add validator for zero results
     */
    public function readAction()
    {
        $em = $this
            ->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');

        $task = $em->find('Application\Entity\Task', $this->params()->fromQuery('id'));

        return new ViewModel([
            'task' => $task
        ]);
    }


    /**
     *
     */
    public function updateAction()
    {
        $session = new Container('user');

        if (!$session->id) {
            $this->flashMessenger()->addMessage('Only logged users are allowed to update todo');
            $this->redirect()->toUrl('/');
        }

        $em = $this
            ->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');

        $task = $em->find('Application\Entity\Task', $this->params()->fromQuery('id'));

        if ($this->params()->fromPost('name')) {
            $task->setName($this->params()->fromPost('name'));
        }

        if ($this->params()->fromPost('status')) {
            $task->setStatus($this->params()->fromPost('status'));
        }

        $em->persist($task);
        $em->flush();

        $this->flashMessenger()->addMessage('Task updated');
        $this->redirect()->toUrl('/application/todo/read?id=' . $task->getId());
    }


    /**
     *
     */
    public function deleteAction()
    {

    }
}