<?php

namespace app\services;

use app\models\db\Type;
use Exception;
use yii\db\ActiveRecord;

/**
 *
 * TypeService is the service for work with Type ActiveRecord.
 *
 */
class TypeService {
    /**
     * Find and return type by id from db.
     *
     * @param $id Integer
     *
     * @return Type
     * @throws Exception
     */
    public function findById(int $id) : Type
    {
        $type = Type::find()
            ->where(['id' => $id])
            ->one();
        if ($type == null) {
            throw new Exception("Type doesn't exist");
        }
        return $type;
    }

    /**
     * Find and return type by name from db.
     *
     * @param $name String
     *
     * @return Type
     * @throws Exception
     */
    public function findByName(string $name) : Type
    {
        $type = Type::find()
            ->where(['name' => $name])
            ->one();
        if ($type == null) {
            throw new Exception("Type doesn't exist");
        }
        return $type;
    }
}
