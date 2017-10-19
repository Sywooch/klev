<?php

namespace app\modules\uslugi\controllers;

use app\models\Objects;
use app\models\Uslugi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `uslugi` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionUsluga($id)
    {
        $usluga = Uslugi::findOne($id);
        if (!$usluga) throw new NotFoundHttpException('Услуга не найдена');
        $other_sevices = Uslugi::find()->where('id != ' . $id . '')->orderBy('sort DESC')->all();

        return $this->render('usluga', [
            'usluga' => $usluga,
            'other_sevices' => $other_sevices,
        ]);
    }

    public function actionObject($id)
    {
        $object = Objects::findOne($id);
        if (!$object) throw new NotFoundHttpException('Объект не найден');
        $other_objects = Objects::find()->where('service_id = ' . $object->service_id . ' AND id !='.$id.'')->orderBy('sort DESC')->all();

        return $this->render('object', [
            'object' => $object,
            'other_objects' => $other_objects,
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
