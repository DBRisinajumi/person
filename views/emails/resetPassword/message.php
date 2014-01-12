<?php echo Yii::t(
        'PersonModule.module',
        'Your password reseted by {user} for system {system}',
        array(
            '{user}' => Yii::app()->user->name,
            '{system}' => Yii::app()->name,
        )    
    ) . '<br/><br/>' . PHP_EOL;

echo Yii::t(
        'PersonModule.module',
        'Loging page') . ': ' . Yii::app()->createAbsoluteUrl('user/login') . '<br/>' . PHP_EOL;

echo Yii::t('PersonModule.module','User name') . ': ' . $username . '<br/>' . PHP_EOL;

echo Yii::t('PersonModule.module','New password') . ': ' . $password . '<br/><br/>' . PHP_EOL;

echo 'Cheers,' . '<br/>' . PHP_EOL;
echo 'The '.Yii::app()->name . ' Team';

