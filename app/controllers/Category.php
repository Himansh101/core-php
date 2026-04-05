<?php
require_once 'app/controllers/Core/Base.php';
require_once 'app/models/Category.php';

class Controller_Category extends Controller_Core_Base
{
    public function listAction()
    {
        $model = new Model_Category();
        $data = $model->fetchAll();

        $this->renderTemplate('category/list.phtml', [
            'data' => $data
        ]);
    }

    public function editAction()
    {
        $model = new Model_Category();
        $id = $this->getRequest()->get('id');

        if ($id) {
            if (!$model->load($id)) {
                throw new Exception("Invalid ID: Record does not exist.");
            }
        }

        $this->renderTemplate('category/edit.phtml', [
            'data' => $model
        ]);
    }

    public function saveAction()
    {
        $model = new Model_Category();

        foreach ($_POST['category'] as $key => $value) {
            $model->$key = $value;
        }

        $model->save();

        $this->redirect('list', 'category');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->get('id');

        if ($id) {
            $model = new Model_Product();
            $model->load($id);
            $model->delete();    
        }

        $this->redirect('list', 'category');
    }
}
