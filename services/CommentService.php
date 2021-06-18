<?php

namespace app\services;

use app\models\db\Comment;
use Exception;
use Yii;
use yii\db\ActiveRecord;

/**
 * CommentService is the service for work with Comment ActiveRecord.
 */
class CommentService {
    /**
     * Create and save comment to db.
     * @param int $task_id
     * @param $text
     * @throws \yii\base\InvalidConfigException
     */
    public function addComment(int $task_id, string $text)
    {
        $comment = new Comment();
        $comment->task_id = $task_id;
        $comment->author_id = Yii::$app->user->id;
        $comment->create_date = Yii::$app->formatter->asDateTime('now', 'yyyy-MM-dd H:i:s');

        if (!isset($text)) {
            $comment->text = "";
        } else {
            $comment->text = $text;
        }

        $commented = $comment->save();

        if (!$commented) {
            throw new Exception("Comment not added");
        }
    }

    /**
     * Find and return comment by id from db.
     *
     * @param $id Integer
     *
     * @return Comment|ActiveRecord
     * @throws Exception
     */
    public function findById(int $id) : Comment
    {
        $comment = Comment::find()
            ->where(['id' => $id])
            ->one();
        if ($comment == null) {
            throw new Exception("Comment doesn't exist");
        }
        return $comment;
    }

    /**
     * Find and return comment by task id from db.
     *
     * @param $id Integer
     *
     * @return array|ActiveRecord[]
     * @throws Exception
     */
    public function findByTaskId(int $id) : array
    {
        $comments =  Comment::find()
            ->where(['task_id' => $id])
            ->all();
        return $comments;
    }
}
