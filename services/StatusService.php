<?php

namespace app\services;

use app\models\db\Status;
use Exception;
use yii\db\ActiveRecord;

/**
 * StatusService is the service for work with Status ActiveRecord.
 */
class StatusService {
    /**
     * Find and return status by id from db.
     *
     * @param $id Integer
     *
     * @return Status
     * @throws Exception
     */
    public function findById(int $id) : Status
    {
        $status =  Status::find()
                ->where(['id' => $id])
                ->one();
        if ($status == null) {
            throw new Exception("Status doesn't exist");
        }
        return $status;
    }

    /**
     * Find and return status by name from db.
     *
     * @param $name String
     *
     * @return Status
     * @throws Exception
     */
    public function findByName(string $name) : Status
    {
        $status = Status::find()
            ->where(['name' => $name])
            ->one();
        if ($status == null) {
            throw new Exception("Status doesn't exists");
        }
        return $status;
    }
}
