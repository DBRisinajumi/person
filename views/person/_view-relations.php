
<!--
<h2>
    <?php echo Yii::t('PersonModule.crud_static', 'Relations') ?></h2>
-->


<?php 
        echo '<h3>';
            echo Yii::t('PersonModule.module','relation.CcucUserCompanies').' ';
            $this->widget(
                'bootstrap.widgets.TbButtonGroup',
                array(
                    'type' => '', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'mini',
                    'buttons' => array(
                        array(
                            'icon' => 'icon-list-alt',
                            'url' =>  array('//person/ccucUserCompany/admin','CcucUserCompany' => array('ccuc_person_id' => $model->{$model->tableSchema->primaryKey}))
                        ),
                        array(
                'icon' => 'icon-plus',
                'url' => array(
                    '//person/ccucUserCompany/create',
                    'CcucUserCompany' => array('ccuc_person_id' => $model->{$model->tableSchema->primaryKey})
                )
            ),
            
                    )
                )
            );
        echo '</h3>' ?>
<ul>

    <?php
    $records = $model->ccucUserCompanies(array('limit' => 250, 'scopes' => ''));
    if (is_array($records)) {
        foreach ($records as $i => $relatedModel) {
            echo '<li>';
            echo CHtml::link(
                '<i class="icon icon-arrow-right"></i> ' . $relatedModel->itemLabel,
                array('/person/ccucUserCompany/view', 'ccuc_id' => $relatedModel->ccuc_id)
            );
            echo CHtml::link(
                ' <i class="icon icon-pencil"></i>',
                array('/person/ccucUserCompany/update', 'ccuc_id' => $relatedModel->ccuc_id)
            );
            echo '</li>';
        }
    }
    ?>
</ul>

