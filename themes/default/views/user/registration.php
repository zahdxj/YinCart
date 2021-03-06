<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
    UserModule::t("Registration"),
);
?>
<div class="login_box col-lg-12">
    <div class="login_tit">
        <a class="current">注册</a>
    </div>
    <div class="login_ct">

    <div class="login col-lg-6">
    <div class="login_form form">


<?php if(Yii::app()->user->hasFlash('registration')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('registration'); ?>
    </div>
<?php else: ?>
    <?php CHtml::$afterRequiredLabel = '';?>
    <div class="form">
        <?php $form=$this->beginWidget('UActiveForm', array(
            'id'=>'registration-form',
            'enableAjaxValidation'=>true,
            'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
            'htmlOptions' => array('enctype'=>'multipart/form-data'),
        )); ?>

<!--        <p class="note">--><?php //echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?><!--</p>-->

        <?php echo $form->errorSummary(array($model,$profile)); ?>

        <div class="form_c">
            <div class="form_l"><?php echo $form->labelEx($model,'username'); ?></div>
            <?php echo $form->textField($model,'username'); ?>
          <div class="center" >
            <?php echo $form->error($model,'username'); ?></div>
        </div>

        <div class="form_c">
            <div class="form_l"><?php echo $form->labelEx($model,'email'); ?></div>
            <?php echo $form->textField($model,'email'); ?>
            <div class="center" > <?php echo $form->error($model,'email'); ?></div>
        </div>

        <div class="form_c">
            <div class="form_l"><?php echo $form->labelEx($model,'password'); ?></div>
            <?php echo $form->passwordField($model,'password'); ?>
            <div class="center" >  <?php echo $form->error($model,'password'); ?></div>


<!--            <p class="hint">-->
<!--                --><?php //echo UserModule::t("Minimal password length 4 symbols."); ?>
<!--            </p>-->
        </div>
        <div class="form_c">
            <div class="form_l">密码强度</div>
            <div class="psw_safe">
                <span class="safe_d">弱</span>
                <span class="safe_c">中</span>
                <span class="safe_h">强</span>
            </div>
        </div>

        <div class="form_c">
            <div class="form_l"><?php echo $form->labelEx($model,'verifyPassword'); ?></div>
            <?php echo $form->passwordField($model,'verifyPassword'); ?>
            <div class="center" >  <?php echo $form->error($model,'verifyPassword'); ?></div>
        </div>

        <?php
        $profileFields=Profile::getFields();
        if ($profileFields) {
            foreach($profileFields as $field) {
                ?>
                <div class="form_c">
                    <?php echo $form->labelEx($profile,$field->varname); ?>
                    <?php
                    if ($widgetEdit = $field->widgetEdit($profile)) {
                        echo $widgetEdit;
                    } elseif ($field->range) {
                        echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
                    } elseif ($field->field_type=="TEXT") {
                        echo$form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
                    } else {
                        echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
                    }
                    ?>
                    <?php echo $form->error($profile,$field->varname); ?>
                </div>
            <?php
            }
        }
        ?>
        <?php if (UserModule::doCaptcha('registration')): ?>
                   <div class="">
                                          <div class="form_c">
                                          <div class="form_1"> <?php echo $form->labelEx($model,'verifyCode'); ?></div>
                                          <?php echo $form->textField($model,'verifyCode'); ?>
                                          </div>
                                         <div id="code-div">
                                          <?php $this->widget('CCaptcha'); ?>

                                           <?php echo $form->error($model,'verifyCode'); ?>

                                           <p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
                                               <br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
                                         </div>
                                      </div>
               <?php endif; ?>

        <div class="form_c" id="submit-div">
        <div class="form_submit">
            <?php echo CHtml::submitButton(UserModule::t("Register")); ?>
            <span><font class="cor_gray">已注册请</font><?php echo CHtml::link(UserModule::t("Login"),Yii::app()->getModule('user')->loginUrl);?>
        </div>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
<?php endif; ?>
  </div>


  </div>
        <div class="logo_b col-lg-6">
            <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/images/login_logo.png" width="257" height="152"/>
        </div>
</div>
    </div>
<div class="clear"></div>
<div style="padding-bottom: 20px"></div>