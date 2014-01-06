<?php
$this->setPageTitle(
    Yii::t('PersonModule.model', 'People')
    . ' - '
    . Yii::t('PersonModule.crud', 'Manage')
);

$this->breadcrumbs[] = Yii::t('PersonModule.model', 'People');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'person-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
    <h1>

        <?php echo Yii::t('PersonModule.model', 'People'); ?>
        <small><?php echo Yii::t('PersonModule.crud', 'Manage'); ?></small>

    </h1>


<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<?php Yii::beginProfile('Person.view.grid'); ?>


<?php
$this->widget('TbGridView',
    array(
        'id' => 'person-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        #'responsiveTable' => true,
        'template' => '{summary}{pager}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'class' => 'CLinkColumn',
                'header' => '',
                'labelExpression' => '$data->itemLabel',
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("id" => $data["id"]))'
            ),
            array(
                'class' => 'TbEditableColumn',
                'name' => 'id',
                'editable' => array(
                    'url' => $this->createUrl('/person/person/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'TbEditableColumn',
                'name' => 'first_name',
                'editable' => array(
                    'url' => $this->createUrl('/person/person/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'TbEditableColumn',
                'name' => 'last_name',
                'editable' => array(
                    'url' => $this->createUrl('/person/person/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'TbEditableColumn',
                'name' => 'email',
                'editable' => array(
                    'url' => $this->createUrl('/person/person/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'TbEditableColumn',
                'name' => 'phone',
                'editable' => array(
                    'url' => $this->createUrl('/person/person/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'name' => 'user_id',
                'value' => 'CHtml::value($data, \'user.username\')',
                'filter' => '',//CHtml::listData(User::model()->findAll(array('limit' => 1000)), 'id', 'itemLabel'),
            ),
            array(
                'class' => 'TbEditableColumn',
                'name' => 'deleted',
                'editable' => array(
                    'url' => $this->createUrl('/person/person/editableSaver'),
                    //'placement' => 'right',
                )
            ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("Person.Person.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("Person.Person.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("Person.Person.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("id" => $data->id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("id" => $data->id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("id" => $data->id))',
            ),
        )
    )
);
?>
<?php Yii::endProfile('Person.view.grid'); ?>