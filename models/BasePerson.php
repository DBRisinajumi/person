<?php

/**
 * This is the model base class for the table "person".
 *
 * Columns in table "person" available as properties of the model:
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property integer $user_id
 * @property integer $deleted
 *
 * Relations of table "person" available as properties of the model:
 * @property CcucUserCompany[] $ccucUserCompanies
 * @property Users $user
 */
abstract class BasePerson extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'person';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('first_name, last_name', 'required'),
                array('email, phone, user_id, deleted', 'default', 'setOnEmpty' => true, 'value' => null),
                array('email', 'email'),     
                array('email', 'unique', 'message' => Yii::t('PersonModule.module',"This user's email address already exists.")),
                array('user_id, deleted', 'numerical', 'integerOnly' => true),
                array('first_name, last_name, email', 'length', 'max' => 255),
                array('phone', 'length', 'max' => 50),
                array('id, first_name, last_name, email, phone, user_id, deleted', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->first_name;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(), array(
                'savedRelated' => array(
                    'class' => '\GtcSaveRelationsBehavior'
                ),
              'LoggableBehavior' => array(
                'class' => 'LoggableBehavior'
                ),
            )
        );
    }

    public function relations()
    {
        return array_merge(
            parent::relations(), array(
                'ccucUserCompanies' => array(self::HAS_MANY, 'CcucUserCompany', 'ccuc_person_id'),
                'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('PersonModule.module', 'PersonId'),
            'first_name' => Yii::t('PersonModule.module', 'First Name'),
            'last_name' => Yii::t('PersonModule.module', 'Last Name'),
            'email' => Yii::t('PersonModule.module', 'Email'),
            'phone' => Yii::t('PersonModule.module', 'Phone'),
            'user_id' => Yii::t('PersonModule.module', 'User'),
            'deleted' => Yii::t('PersonModule.module', 'Deleted'),
            'create_at' => Yii::t('PersonModule.module', 'Created at'),
            'lastvisit_at' => Yii::t('PersonModule.module', 'Last visited at'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.first_name', $this->first_name, true);
        $criteria->compare('t.last_name', $this->last_name, true);
        $criteria->compare('t.email', $this->email, true);
        $criteria->compare('t.phone', $this->phone, true);
        $criteria->compare('t.user_id', $this->user_id);
        $criteria->compare('t.deleted', $this->deleted);

        return $criteria;

    }

}
