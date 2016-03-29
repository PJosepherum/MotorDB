<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

/**
 * VehiclesController
 *
 * Manage CRUD operations for vehicles
 */
class VehiclesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your vehicles');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new VehiclesForm;

        $numberPage = 1;
        if ($this->request->getQuery("page", "int")) {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $vehicles = Vehicles::find();
        if (count($vehicles) == 0) {
            $this->flash->notice("The search did not find any vehicles");
            return $this->forward("vehicles/index");
        }

        $paginator = new Paginator(array("data" => $vehicles, "limit" => 9, "page" => $numberPage));

        $this->view->page = $paginator->getPaginate();

    }

    /**
     * Search vehicles based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Vehicles", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $vehicles = Vehicles::find($parameters);
        if (count($vehicles) == 0) {
            $this->flash->notice("The search did not find any vehicles");
            return $this->forward("vehicles/index");
        }

        $paginator = new Paginator(array(
            "data"  => $vehicles,
            "limit" => 9,
            "page"  => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Shows the form to create a new vehicle
     */
    public function newAction()
    {
        $this->view->form = new VehiclesForm(null, array('edit' => true));
    }

    /**
     * Edits a vehicle based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $vehicle = Vehicles::findFirstById($id);
            if (!$vehicle) {
                $this->flash->error("Vehicle was not found");
                return $this->forward("vehicles/index");
            }

            $this->view->form = new VehiclesForm($vehicle, array('edit' => true));
        }
    }

    /**
     * Edits a vehicle based on its id
     */
    public function viewAction($id)
    {
        $vehicle = Vehicles::findFirstById($id);
        if (!$vehicle) {
            $this->flash->error("Vehicle was not found");
            return $this->forward("vehicles/index");
        }
        $this->view->vehicle = $vehicle;
    }

    /**
     * Creates a new vehicle
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("vehicles/index");
        }

        $form = new VehiclesForm;
        $vehicle = new Vehicles();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $vehicle)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('vehicles/new');
        }

        if ($vehicle->save() == false) {
            foreach ($vehicle->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('vehicles/new');
        }

        $form->clear();

        $this->flash->success("Vehicle was created successfully");
        return $this->forward("vehicles/index");
    }

    /**
     * Saves current vehicle in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("vehicles/index");
        }

        $id = $this->request->getPost("id", "int");

        $vehicle = Vehicles::findFirstById($id);
        if (!$vehicle) {
            $this->flash->error("Vehicle does not exist");
            return $this->forward("vehicles/index");
        }

        $form = new VehiclesForm;
        $this->view->form = $form;

        $data = $this->request->getPost();

        if (!$form->isValid($data, $vehicle)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('vehicles/edit/' . $id);
        }

        if ($vehicle->save() == false) {
            foreach ($vehicle->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('vehicles/edit/' . $id);
        }

        $form->clear();

        $this->flash->success("Vehicle was updated successfully");
        return $this->forward("vehicles/index");
    }

    /**
     * Deletes a vehicle
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $vehicles = Vehicles::findFirstById($id);
        if (!$vehicles) {
            $this->flash->error("Vehicle was not found");
            return $this->forward("vehicles/index");
        }

        if (!$vehicles->delete()) {
            foreach ($vehicles->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("vehicles/search");
        }

        $this->flash->success("Vehicle was deleted");
        return $this->forward("vehicles/index");
    }
}
