<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class UsersController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage users');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new UsersForm;
    }

    /**
     * Search user based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Users", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $users = Users::find($parameters);
        if (count($users) == 0) {
            $this->flash->notice("The search did not find any users");
            return $this->forward("users/index");
        }

        $paginator = new Paginator(array(
            "data"  => $users,
            "limit" => 9,
            "page"  => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
        $this->view->users = $users;
    }

    /**
     * Shows the form to create a new user
     */
    public function newAction()
    {
        $this->view->form = new UsersForm(null, array('edit' => true));
    }

    /**
     * Edits a user based on its id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $users = Users::findFirstById($id);
            if (!$users) {
                $this->flash->error("User to edit was not found");
                return $this->forward("users/index");
            }

            $this->view->form = new UsersForm($users, array('edit' => true));
        }
    }

    /**
     * Creates a new user
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("users/index");
        }

        $form = new UsersForm;
        $users = new Users();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $users)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('users/new');
        }

        if ($users->save() == false) {
            foreach ($users->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('users/new');
        }

        $form->clear();

        $this->flash->success("User was created successfully");
        return $this->forward("users/index");
    }

    /**
     * Saves current users in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("users/index");
        }

        $id = $this->request->getPost("id", "int");
        $users = Users::findFirstById($id);
        if (!$users) {
            $this->flash->error("User does not exist");
            return $this->forward("users/index");
        }

        $form = new UsersForm;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $users)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('users/new');
        }

        if ($users->save() == false) {
            foreach ($users->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('users/new');
        }

        $form->clear();

        $this->flash->success("User was updated successfully");
        return $this->forward("users/index");
    }

    /**
     * Deletes a users
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $users = Users::findFirstById($id);
        if (!$users) {
            $this->flash->error("User was not found");
            return $this->forward("users/index");
        }

        if (!$users->delete()) {
            foreach ($users->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("users/search");
        }

        $this->flash->success("User was deleted");
        return $this->forward("users/index");
    }
}
