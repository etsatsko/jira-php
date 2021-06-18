<?php

namespace app\services;

use app\models\db\Task;
use DateTime;
use Exception;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * TaskService is the service for work with Task ActiveRecord.
 */
class TaskService
{
    /**
     * Create and save task to db.
     *
     * @param $type Integer
     * @param $title String
     * @param $description String
     * @param $status Integer
     * @param $executor Integer
     * @param $service_class Integer
     * @param string $deadline
     * @param int $timeEstimate
     * @throws InvalidConfigException
     */
    public function addTask(
        int $type,
        string $title,
        string $description,
        int $status,
        int $executor,
        int $service_class,
        string $deadline,
        int $timeEstimate
    )
    {
        $task = new Task();
        $task->type = $type;
        $task->title = $title;
        $task->status = $status;
        $task->author_id = Yii::$app->user->id;
        $task->executor_id = $executor;
        $task->create_date = Yii::$app->formatter->asDateTime('now', 'yyyy-MM-dd H:i:s');
        $task->deadline = Yii::$app->formatter->asDateTime($deadline, 'yyyy-MM-dd H:i:s');
        $task->service_class = $service_class;
        $task->time_estimate = $timeEstimate;

        if (!isset($description)) {
            $task->description = "";
        } else {
            $task->description = $description;
        }

        $task->save();
    }

    /**
     * Update and save task to db.
     *
     * @param $id Integer
     * @param $type Integer
     * @param $title String
     * @param $description String
     * @param $status Integer
     * @param $executor Integer
     * @param $service_class Integer
     * @throws Exception
     */
    public function updateTask(
        int $id,
        int $type,
        string $title,
        string $description,
        int $status,
        int $executor,
        int $service_class
    )
    {
        $task = $this->findById($id);
        $task->type = $type;
        $task->title = $title;
        $task->status = $status;
        $task->executor_id = $executor;
        $task->service_class = $service_class;

        if (!isset($description)) {
            $task->description = "";
        } else {
            $task->description = $description;
        }

        $taskSaved = $task->save();
        if (!$taskSaved) {
            throw new Exception("Task doesn't save");
        }
    }

    /**
     *
     * Delete task from db.
     *
     * @param $id Integer
     * @throws Exception
     */
    public function deleteTask(int $id)
    {
        $task = $this->findById($id);
        if (isset($task)) {
            $deleted = $task->delete();
            if (!$deleted) {
                throw new Exception("Task doesn't delete");
            }
        }
    }

    /**
     * Find and return task by id from db.
     *
     * @param $id Integer
     *
     * @return Task|ActiveRecord
     * @throws Exception
     */
    public function findById(int $id): Task
    {
        $task = Task::find()
            ->where(['id' => $id])
            ->one();
        if ($task == null) {
            throw new Exception("Task doesn't exist");
        }
        return $task;
    }

    /**
     * Find and return tasks by id from db.
     *
     * @param $title String
     *
     * @return array|ActiveRecord[]
     * @throws Exception
     */
    public function findByTitle(string $title): array
    {
        $tasks = Task::find()
            ->andWhere(['like', 'title', $title])
            ->all();
        if ($tasks == null) {
            throw new Exception("Tasks don't exist");
        }
        return $tasks;
    }

    /**
     * Return is task deadlined
     *
     * @param $id int
     *
     * @return bool
     * @throws Exception
     */
    public function isDeadlined(int $id) : bool
    {
        $task = Task::find()
            ->where(['id' => $id])
            ->one();
        if ($task == null) {
            throw new Exception("Task doesn't exist");
        }
        $timeNow = Yii::$app->formatter->asDateTime('now', 'yyyy-MM-dd H:i:s');
        return $timeNow > $task->deadline;
    }

    /**
     * Return is task time limited
     *
     * @param $id int
     *
     * @return bool
     * @throws Exception
     */
    public function isTimeLimited(int $id) : bool
    {
        $task = Task::find()
            ->where(['id' => $id])
            ->one();
        if ($task == null) {
            throw new Exception("Task doesn't exist");
        }
        $workCostService = new WorkCostService();
        $sum = $workCostService->getSumWorkCostsByTaskId($id);
        return $sum > $task->time_estimate;
    }
}
