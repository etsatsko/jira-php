<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * ActiveRecord task class.
 */
class Task extends ActiveRecord
{
    /**
     * Method get table name.
     *
     * @return String
     */
    public static function tableName() : string
    {
        return 'task';
    }

    /**
     * Method get task id.
     *
     * @return Integer
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Method get task title.
     *
     * @return String
     */
    public function getTitle() : string
    {
        return $this->title;
    }
}