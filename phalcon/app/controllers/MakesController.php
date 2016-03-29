<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MakesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage vehicle makes');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new MakesForm;
    }

    /**
     * Search make based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Makes", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $makes = Makes::find($parameters);
        if (count($makes) == 0) {
            $this->flash->notice("The search did not find any makes");
            return $this->forward("makes/index");
        }

        $paginator = new Paginator(array(
            "data"  => $makes,
            "limit" => 9,
            "page"  => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
        $this->view->makes = $makes;
    }

    /**
     * Shows the form to create a new make
     */
    public function newAction()
    {
        $this->view->form = new MakesForm(null, array('edit' => true));
    }

    /**
     * Edits a make based on its id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $makes = Makes::findFirstById($id);
            if (!$makes) {
                $this->flash->error("Make to edit was not found");
                return $this->forward("makes/index");
            }

            $this->view->form = new MakesForm($makes, array('edit' => true));
        }
    }

    /**
     * Creates a new make
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("makes/index");
        }

        $form = new MakesForm;
        $makes = new Makes();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $makes)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('makes/new');
        }

        if ($makes->save() == false) {
            foreach ($makes->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('makes/new');
        }

        $form->clear();

        $this->flash->success("Make was created successfully");
        return $this->forward("makes/index");
    }

    /**
     * Saves current makes in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("makes/index");
        }

        $id = $this->request->getPost("id", "int");
        $makes = Makes::findFirstById($id);
        if (!$makes) {
            $this->flash->error("Make does not exist");
            return $this->forward("makes/index");
        }

        $form = new MakesForm;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $makes)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('makes/new');
        }

        if ($makes->save() == false) {
            foreach ($makes->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('makes/new');
        }

        $form->clear();

        $this->flash->success("Make was updated successfully");
        return $this->forward("makes/index");
    }

    /**
     * Deletes a makes
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $makes = Makes::findFirstById($id);
        if (!$makes) {
            $this->flash->error("Make was not found");
            return $this->forward("makes/index");
        }

        if (!$makes->delete()) {
            foreach ($makes->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("makes/search");
        }

        $this->flash->success("Make was deleted");
        return $this->forward("makes/index");
    }
}
