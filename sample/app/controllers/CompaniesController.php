<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CompaniesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('New Microposts');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
    
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction()
    {
        
    }

    /**
     * Shows the form to create a new company
     */
    public function newAction()
    {
        $this->view->form = new CompaniesForm(null, array('edit' => true));
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $company = Companies::findFirstById($id);
            if (!$company) {
                $this->flash->error("Micropost was not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "companies",
                        "action"     => "search",
                    ]
                );
            }
            $this->view->form = new CompaniesForm($company, array('edit' => true));
        }
    }

    /**
     * Creates a new company
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "companies",
                    "action"     => "search",
                ]
            );
        }

        $form = new CompaniesForm;
        $company = new Companies();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $company)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "companies",
                    "action"     => "new",
                ]
            );
        }

        if ($company->save() == false) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "companies",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Micropost was created successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "companies",
                "action"     => "search",
            ]
        );
    }

    /**
     * Saves current company in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "companies",
                    "action"     => "search",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");
        $company = Companies::findFirstById($id);
        if (!$company) {
            $this->flash->error("Micropost does not exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "companies",
                    "action"     => "search",
                ]
            );
        }

        $form = new CompaniesForm;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $company)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "companies",
                    "action"     => "new",
                ]
            );
        }

        if ($company->save() == false) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "companies",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Micropost was updated successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "companies",
                "action"     => "search",
            ]
        );
    }

    /**
     * Deletes a company
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $companies = Companies::findFirstById($id);
        if (!$companies) {
            $this->flash->error("Micropost was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "companies",
                    "action"     => "search",
                ]
            );
        }

        if (!$companies->delete()) {
            foreach ($companies->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "companies",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("Micropost was deleted");

        return $this->dispatcher->forward(
            [
                "controller" => "companies",
                "action"     => "search",
            ]
        );
    }
}
