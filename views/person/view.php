<?php
    $this->setPageTitle(
        Yii::t('PersonModule.module', 'Person')
        . ' - '
        . Yii::t('PersonModule.crud_static', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
$this->breadcrumbs[Yii::t('PersonModule.module','People')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('PersonModule.crud_static', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('PersonModule.module','Person')?>
        <small>
            <?php echo $model->itemLabel ?>

        </small>

        </h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('PersonModule.crud_static','Data')?>            <small>
                #<?php echo $model->id ?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                array(
                        'name' => 'id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'id',
                                'url' => $this->createUrl('/person/person/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'first_name',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'first_name',
                                'url' => $this->createUrl('/person/person/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'last_name',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'last_name',
                                'url' => $this->createUrl('/person/person/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'email',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'email',
                                'url' => $this->createUrl('/person/person/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'phone',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'phone',
                                'url' => $this->createUrl('/person/person/editableSaver'),
                            ),
                            true
                        )
                    ),
        array(
            'name' => 'user_id',
            'value' => ($model->user !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->user->username,
                            array('/person/user/view','id' => $model->user->id),
                            array('class' => '')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/person/user/update','id' => $model->user->id),
                            array('class' => '')):'n/a',
            'type' => 'html',
        ),
array(
                        'name' => 'deleted',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'deleted',
                                'url' => $this->createUrl('/person/person/editableSaver'),
                            ),
                            true
                        )
                    ),
           ),
        )); ?>
    </div>


    <div class="span5">
        <div class="well">
            <?php $this->renderPartial('_view-relations',array('model' => $model)); ?>        </div>
    </div>
</div>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>