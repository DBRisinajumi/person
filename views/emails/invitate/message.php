<?php echo Yii::t(
        'PersonModule.model',
        'You have been invited by {user} to become a user of system {system}',
        array(
            '{user}' => Yii::app()->user->name,
            '{system}' => Yii::app()->name,
        )    
    ) . '<br/><br/>' . PHP_EOL;

echo Yii::t(
        'PersonModule.model',
        'Loging page') . ': ' . Yii::app()->createAbsoluteUrl('user/login') . '<br/>' . PHP_EOL;

echo Yii::t('PersonModule.model','User name') . ': ' . $username . '<br/>' . PHP_EOL;

echo Yii::t('PersonModule.model','Password') . ': ' . $password . '<br/><br/>' . PHP_EOL;

echo 'Cheers,' . '<br/>' . PHP_EOL;
echo 'The '.Yii::app()->name . ' Team';

