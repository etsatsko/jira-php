<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * ActiveRecord comment class.
 */
class WorkCost extends ActiveRecord
{
    /**
     * Method get work cost id.
     *
     * @return Integer
     */
    public function getId() : int
    {
        return $this->id;
    }
}
