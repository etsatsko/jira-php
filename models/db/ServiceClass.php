<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * ActiveRecord service class class.
 */
class ServiceClass extends ActiveRecord
{
    /**
     * Method get service class id.
     *
     * @return Integer
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Method get service class name.
     *
     * @return String
     */
    public function getName() : string
    {
        return $this->name;
    }
}
