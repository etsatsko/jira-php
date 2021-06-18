<?php

namespace app\services;

use app\models\db\ServiceClass;
use Exception;
use yii\db\ActiveRecord;

/**
 * ServiceClassService is the service for work with ServiceClass ActiveRecord.
 */
class ServiceClassService {
    /**
     * Find and return servce class by id from db.
     *
     * @param $id Integer
     *
     * @return ServiceClass
     * @throws Exception
     */
    public function findById(int $id) : ServiceClass
    {
        $serviceClass = ServiceClass::find()
                    ->where(['id' => $id])
                    ->one();

        if ($serviceClass == null) {
            throw new Exception("Service Class doesn't exist");
        }
        return $serviceClass;
    }

    /**
     * Find and return servce class by id from db.
     *
     * @param $name String
     *
     * @return ServiceClass
     * @throws Exception
     */
    public function findByName(string $name) : ServiceClass
    {
        $serviceClass = ServiceClass::find()
                    ->where(['name' => $name])
                    ->one();
        if ($serviceClass == null) {
            throw new Exception("Service Class doesn't exist");
        }
        return $serviceClass;
    }
}
