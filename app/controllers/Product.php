<?php
require_once 'app/controllers/Core/Base.php';
require_once 'app/models/Product.php';

class Controller_Product extends Controller_Core_Base
{
    public function listAction()
    {
        $model = new Model_Product();
        $data = $model->fetchAll();

        $this->renderTemplate('product/list.phtml', [
            'data' => $data
        ]);
    }

    public function editAction()
    {
        $model = new Model_Product();
        $id = $this->getRequest()->get('id');

        if ($id) {
            if (!$model->load($id)) {
                throw new Exception("Invalid ID: Record does not exist.");
            }
        }

        $this->renderTemplate('product/edit.phtml', [
            'data' => $model
        ]);
    }

    public function saveAction()
    {
        $model = new Model_Product();

        foreach ($_POST['product'] as $key => $value) {
            $model->$key = $value;
        }

        $model->save();

        $this->redirect('list', 'product');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->get('id');

        if ($id) {
            $model = new Model_Product();
            $model->load($id);
            $model->delete();    
        }

        $this->redirect('list', 'product');
    }
}
