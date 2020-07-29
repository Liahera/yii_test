<?php


namespace app\models;


use yii\base\Model;

class Signup extends Model
{
    public $birthdate;
    public $password;
    public $username;

    public function rules()
    {
        return [
            [['username', 'password', 'birthdate'], 'required'],
            [['birthdate'], 'validateBirthdate'],
            ['username', 'unique', 'targetClass' => 'app\models\User'],
            ['username', 'string', 'min' => 2, 'max' => 10],
            ['password', 'string', 'min' => 2, 'max' => 10]
        ];
    }

    public function validateBirthdate($attribute, $params)
    {
        $date = new \DateTime();
        date_sub($date, date_interval_create_from_date_string('5 years'));
        $minAgeDate = date_format($date, 'Y-m-d');
        date_sub($date, date_interval_create_from_date_string('150 years'));
        $maxAgeDate = date_format($date, 'Y-m-d');
        if ($this->$attribute > $minAgeDate) {
            $this->addError($attribute, 'Too young!');
        } elseif ($this->$attribute < $maxAgeDate) {
            $this->addError($attribute, 'Too old!');
        }
    }

    public function signup()
    {
        $user = new User();
        $user->birthdate = $this->birthdate;
        $user->username = $this->username;
        $user->setPassword($this->password);

        return $user->save(); //вернет true или false
    }
}