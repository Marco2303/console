<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cons_users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $cusersnome
 * @property string $cuserscognome
 * @property string $cuserslevel
 * @property string $authKey
 */
class ConsUsers extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cons_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'cusersnome', 'cuserscognome', 'cuserslevel', 'authKey'], 'required'],
            [['cuserslevel'], 'string'],
            [['username', 'password', 'cusersnome', 'cuserscognome', 'authKey'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'cusersnome' => 'Cusersnome',
            'cuserscognome' => 'Cuserscognome',
            'cuserslevel' => 'Cuserslevel',
            'authKey' => 'Auth Key',
        ];
    }
    public function getAuthKey() {
        return $this->authKey;//Here I return a value of my authKey column
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException();//I don't implement this method because I don't have any access token column in my database
    }
    
    public function validatePassword($password){
        return $this->password === $password;
    }
   /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

}
