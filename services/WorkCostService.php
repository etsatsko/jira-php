<?php

namespace app\services;

use app\models\db\Comment;
use app\models\db\WorkCost;
use Exception;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

/**
 * WorkCostService is the service for work with WorkCost ActiveRecord.
 */
class WorkCostService {
    /**
     * Create and save work cost to db.
     * @param int $task_id
     * @param int $time
     * @param string $comment
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function addWorkCost(int $task_id, int $time, string $comment)
    {
        $workCost = new WorkCost();
        $workCost->task_id = $task_id;
        $workCost->author_id = Yii::$app->user->id;
        $workCost->create_date = Yii::$app->formatter->asDateTime('now', 'yyyy-MM-dd H:i:s');

        if (!isset($comment)) {
            $workCost->comment = "";
        } else {
            $workCost->comment = $comment;
        }

        if (!isset($time)) {
            $workCost->time = 4;
        } else {
            $workCost->time = $time;
        }

        $workSaved = $workCost->save();
        if (!$workSaved) {
            throw new Exception("Work Cost doesn't save");
        }
    }

    /**
     * Find and return work cost by id from db.
     *
     * @param $id Integer
     *
     * @return WorkCost
     * @throws Exception
     */
    public function findById(int $id) : WorkCost
    {
        $workCost = WorkCost::find()
            ->where(['id' => $id])
            ->one();
        if ($workCost == null) {
            throw new Exception("Work Cost doesn't exist");
        }
        return $workCost;
    }

    /**
     * Find and return work cost by task id from db.
     *
     * @param $id Integer
     *
     * @return array|ActiveRecord[]
     */
    public function findByTaskId(int $id) : array
    {
        $workCosts = WorkCost::find()
            ->where(['task_id' => $id])
            ->all();
        return $workCosts;
    }

    /**
     * Get sum of all work costs by task
     *
     * @param $id Integer
     *
     * @return int
     * @throws Exception
     */
    public function getSumWorkCostsByTaskId(int $id) : int
    {
        $workCosts = WorkCost::find()
            ->where(['task_id' => $id])
            ->all();
        $sum = 0;
        foreach ($workCosts as $wc) {
            $sum += $wc->time;
        }
        return $sum;
    }
}
