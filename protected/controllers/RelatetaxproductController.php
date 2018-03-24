<?php

class RelatetaxproductController extends Controller {

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new RelateTaxProduct;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['RelateTaxProduct'])) {
            $model->attributes = $_POST['RelateTaxProduct'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->relate_tax_productId));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate() {
        $id = Yii::app()->request->getParam('id');
        $taxId = Yii::app()->request->getParam('taxId');
        $url = Yii::app()->request->getParam('url');
        $model = $this->loadModel($id);
        $oldPrice = $model->amount * $model->pricePerAmount;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['RelateTaxProduct'])) {
            $model->attributes = $_POST['RelateTaxProduct'];
            if ($model->save()){
                $taxModel = Tax::model()->findByPk($taxId);
                $taxModel->totalPrice += ($model->amount * $model->pricePerAmount)-$oldPrice;
                $taxModel->save();
                $this->redirect($url);
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $id = Yii::app()->request->getParam('id');
        $url = Yii::app()->request->getParam('url');
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);

            $productModel = Product::model()->findByPk($model->productId);

            $taxModel = Tax::model()->findByPk($model->taxId);
            $taxModel->totalPrice -= ($model->pricePerAmount * $model->amount);
            $taxModel->save();

            $model->delete();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect($url);
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('RelateTaxProduct');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new RelateTaxProduct('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['RelateTaxProduct']))
            $model->attributes = $_GET['RelateTaxProduct'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = RelateTaxProduct::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'relate-tax-product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
