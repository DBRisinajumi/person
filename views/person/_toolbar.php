<?php Yii::beginProfile('Person.view.toolbar'); ?>

<?php
    $showDeleteButton = (Yii::app()->request->getParam("id"))?true:false;
    $showManageButton = true;
    $showCreateButton = true;
    $showUpdateButton = true;
    $showCancelButton = true;
    $showSaveButton   = true;
    $showViewButton   = true;

    switch($this->action->id){
        case "admin":
            $showCancelButton = false;
            $showSaveButton   = false;
            $showViewButton   = false;
            $showUpdateButton = false;
            break;
        case "update":
            $showCreateButton = false;
            $showUpdateButton = false;
            break;
        case "create":
            $showCreateButton = false;
            $showViewButton   = false;
            $showUpdateButton = false;
            break;
        case "view":
            $showViewButton   = false;
            $showSaveButton   = false;
            $showCreateButton = false;
            break;
    }
?>
<div class="clearfix">
    <div class="btn-toolbar pull-right">
        <!-- relations -->
                    <div class="btn-group">
                <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
                       'size'=>'large',
                       'buttons' => array(
                               array(
                                #'label'=>Yii::t('PersonModule.crud_static','Relations'),
                                'icon'=>'icon-random',
                                'items'=>array(array(
                    'icon' => 'arrow-right','label' => Yii::t('PersonModule.module','relation.CcucUserCompanies'), 'url' =>array('/person/ccucUserCompany/admin')),array(
                    'icon' => 'circle-arrow-left','label' => Yii::t('PersonModule.module','relation.User'), 'url' =>array('/person/user/admin')),
            )
          ),
        ),
    ));
?>            </div>

        
        <div class="btn-group">
            <?php
             $this->widget("bootstrap.widgets.TbButton", array(
                           "label"=>Yii::t("PersonModule.crud_static","Manage"),
                           "icon"=>"icon-list-alt",
                           "size"=>"large",
                           "url"=>array("admin"),
                           "visible"=>$showManageButton && (Yii::app()->user->checkAccess("Person.Person.*") || Yii::app()->user->checkAccess("Person.Person.View"))
                        ));
         ?>        </div>
    </div>

    <div class="btn-toolbar pull-left">
        <div class="btn-group">
            <?php
                   $this->widget("bootstrap.widgets.TbButton", array(
                       #"label"=>Yii::t("PersonModule.crud_static","Cancel"),
                       "icon"=>"chevron-left",
                       "size"=>"large",
                       "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
                       "visible"=>$showCancelButton && (Yii::app()->user->checkAccess("Person.Person.*") || Yii::app()->user->checkAccess("Person.Person.View")),
                       "htmlOptions"=>array(
                                       "class"=>"search-button",
                                       "data-toggle"=>"tooltip",
                                       "title"=>Yii::t("PersonModule.crud_static","Cancel"),
                                   )
                    ));
                   $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>Yii::t("PersonModule.crud_static","Create"),
                        "icon"=>"icon-plus",
                        "size"=>"large",
                        "type"=>"success",
                        "url"=>array("create"),
                        "visible"=>$showCreateButton && (Yii::app()->user->checkAccess("Person.Person.*") || Yii::app()->user->checkAccess("Person.Person.Create"))
                   ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>Yii::t("PersonModule.crud_static","Delete"),
                        "type"=>"danger",
                        "icon"=>"icon-trash icon-white",
                        "size"=>"large",
                        "htmlOptions"=> array(
                            "submit"=>array("delete","id"=>$model->{$model->tableSchema->primaryKey}, "returnUrl"=>(Yii::app()->request->getParam("returnUrl"))?Yii::app()->request->getParam("returnUrl"):$this->createUrl("admin")),
                            "confirm"=>Yii::t("PersonModule.crud_static","Do you want to delete this item?")
                        ),
                        "visible"=> $showDeleteButton && (Yii::app()->user->checkAccess("Person.Person.*") || Yii::app()->user->checkAccess("Person.Person.Delete"))
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        #"label"=>Yii::t("PersonModule.crud_static","Update"),
                        "icon"=>"icon-edit icon-white",
                        "type"=>"primary",
                        "size"=>"large",
                        "url"=>array("update","id"=>$model->{$model->tableSchema->primaryKey}),
                        "visible"=> $showUpdateButton &&  (Yii::app()->user->checkAccess("Person.Person.*") || Yii::app()->user->checkAccess("Person.Person.Update"))
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        #"label"=>Yii::t("PersonModule.crud_static","View"),
                        "icon"=>"icon-eye-open",
                        "size"=>"large",
                        "url"=>array("view","id"=>$model->{$model->tableSchema->primaryKey}),
                        "visible"=>$showViewButton &&  (Yii::app()->user->checkAccess("Person.Person.*") || Yii::app()->user->checkAccess("Person.Person.View")),
                        "htmlOptions"=>array(
                                      "data-toggle"=>"tooltip",
                                      "title"=>Yii::t("PersonModule.crud_static","View Mode"),
                        )
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                       "label"=>Yii::t("PersonModule.crud_static","Save"),
                       "icon"=>"icon-thumbs-up icon-white",
                       "size"=>"large",
                       "type"=>"primary",
                       "htmlOptions"=> array(
                            "onclick"=>"$('.crud-form form').submit();",
                       ),
                       "visible"=>$showSaveButton &&  (Yii::app()->user->checkAccess("Person.Person.*") || Yii::app()->user->checkAccess("Person.Person.View"))
                    ));
             ?>        </div>
        <?php if($this->action->id == 'admin'): ?>        <div class="btn-group">
            
            <?php
                $this->widget(
                       "bootstrap.widgets.TbButton",
                       array(
                           #"label"=>Yii::t("PersonModule.crud_static","Search"),
                                   "icon"=>"icon-search",
                                   "size"=>"large",
                                   "htmlOptions"=>array(
                                       "class"=>"search-button",
                                       "data-toggle"=>"tooltip",
                                       "title"=>Yii::t("PersonModule.crud_static","Advanced Search"),
                                   )
                           )
                       );
                    ?>
                    <?php
                $this->widget(
                       "bootstrap.widgets.TbButton",
                       array(
                           #"label"=>Yii::t("PersonModule.crud_static","Clear"),
                                   "icon"=>"icon-remove-sign",
                                   "size"=>"large",
                                   "url"=>Yii::app()->baseURL."/".Yii::app()->request->getPathInfo(),
                                   "htmlOptions"=>array(
                                      "data-toggle"=>"tooltip",
                                      "title"=>Yii::t("PersonModule.crud_static","Clear Search"),
                                   )
                           )
                       );
                    ?>
                            </div>
        <?php endif; ?>
    </div>


</div>


<?php if($this->action->id == 'admin'): ?><div class="search-form" style="display:none">
    <?php Yii::beginProfile('Person.view.toolbar.search'); ?>    <?php $this->renderPartial('_search',array('model' => $model,)); ?>
    <?php Yii::endProfile('Person.view.toolbar.search'); ?></div>
<?php endif; ?>
<?php Yii::endProfile('Person.view.toolbar'); ?>