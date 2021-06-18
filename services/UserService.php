<?php

namespace app\services;

use app\models\db\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * UserService is the service for work with User ActiveRecord.
 */
class UserService {
    /**
     * Find and return user by id from db.
     *
     * @param $id Integer
     *
     * @return User|ActiveRecord
     */
    public function findById(int $id) : User
    {
        $user = User::find()
                ->where(['id'=> $id])
                ->one();
        if ($user == null) {
            throw new Exception("User doesn't exist");
        }
        return $user;
    }

    /**
     * Create and save user to db.
     *
     * @param $login String
     * @param $email String
     * @param $password String
     */
    public function addUser(string $login, string $email, string $password)
    {
        $user = new User();
        $user->login = $login;
        $user->email = $email;
        $user->password = $password;
        $user->create_date = Yii::$app->formatter->asDateTime('now', 'yyyy-MM-dd H:i:s');

        $userSaved = $user->save();
        if (!$userSaved) {
            throw new Exception("User doesn't save");
        }
    }
}
