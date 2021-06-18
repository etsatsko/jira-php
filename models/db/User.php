<?php

namespace app\models\db;

use phpseclib3\Math\PrimeField\Integer;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername(string $username)
    {
        return User::find()
            ->where(['login' => $username])
            ->one();
    }

    public function validatePassword(string $password) : bool
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Method get user id.
     *
     * @return Integer
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Method get user login.
     *
     * @return String
     */
    public function getLogin() : string
    {
        return $this->login;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}
