<?php
/**
 * Login Form
 */
?>
<noscript>If you see this you have probably JavaScript deactivated. LimeSurvey does not work without Javascript being activated in the browser!</noscript>
<div class="container-fluid welcome">
    <div class="row text-center">
        <div class="col-lg-3 col-lg-offset-4 col-sm-6 col-sm-offset-3">
            <div class="panel panel-primary login-pannel" id="pannel-1">

                <!-- Header -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                          <img alt="logo" id="profile-img" class="profile-img-card img-responsive center-block" src="<?php echo LOGO_URL;?>" />
                             <p><?php eT("Administration");?></p>
                        </div>
                    </div>
                </div>

                <!-- Action Name -->
                <div class="row login-title login-content">
                      <div class="col-lg-12">
                       <h3><?php eT("Log in");?></h3>
                    </div>
                </div>

                <!-- Form -->
                <?php echo CHtml::form(array('admin/authentication/sa/login'), 'post', array('id'=>'loginform', 'name'=>'loginform'));?>
                    <div class="row login-content login-content-form">
                        <div class="col-lg-12">
                            <?php
                                $pluginNames = array_keys($pluginContent);
                                if (!isset($defaultAuth))
                                {
                                    // Make sure we have a default auth, if not set, use the first one we find
                                    $defaultAuth = reset($pluginNames);
                                }

                                if (count($pluginContent)>1)
                                {
                                    $selectedAuth = App()->getRequest()->getParam('authMethod', $defaultAuth);
                                    if (!in_array($selectedAuth, $pluginNames))
                                    {
                                        $selectedAuth = $defaultAuth;
                                    }
                            ?>

                           <label for='authMethod'><?php eT("Authentication method"); ?></label>
                                <?php
                                    $possibleAuthMethods = array();
                                    foreach($pluginNames as $plugin)
                                    {
                                        $info = App()->getPluginManager()->getPluginInfo($plugin);
                                        $possibleAuthMethods[$plugin] = $info['pluginName'];
                                    }
                                    //print_r($possibleAuthMethods); die();

                                    $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                                        'name' => 'authMethod',
                                        'data' => $possibleAuthMethods,
                                        'value' => $selectedAuth,
                                        'pluginOptions' => array(
                                            'options' => array(
                                                    'onChange'=>'this.form.submit();'
                                                    )
                                    )));


                                }
                                else
                                {
                                    echo CHtml::hiddenField('authMethod', $defaultAuth);
                                    $selectedAuth = $defaultAuth;
                                }
                                if (isset($pluginContent[$selectedAuth]))
                                {
                                    $blockData = $pluginContent[$selectedAuth];
                                    /* @var $blockData PluginEventContent */
                                    echo $blockData->getContent();
                                }

                                $languageData = array(
                                    'default' => gT('Default')
                                );
                                foreach (getLanguageDataRestricted(true) as $sLangKey => $aLanguage)
                                {
                                    $languageData[$sLangKey] =  html_entity_decode($aLanguage['nativedescription'], ENT_NOQUOTES, 'UTF-8') . " - " . $aLanguage['description'];
                                }
                                echo CHtml::label(gT('Language'), 'loginlang');

                                //$this->widget('bootstrap.widgets.TbSelect2', array(

                                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                                    'name' => 'loginlang',
                                    'data' => $languageData,
                                    'pluginOptions' => array(
                                    'options' => array(
                                        'width' => '230px'
                                    ),
                                    'htmlOptions' => array(
                                        'id' => 'loginlang'
                                    ),
                                    'value' => 'default'
                                )));
                                ?>

                                <?php   if (Yii::app()->getConfig("demoMode") === true && Yii::app()->getConfig("demoModePrefill") === true)
                                { ?>
                                    <p><?php eT("Demo mode: Login credentials are prefilled - just click the Login button."); ?></p>
                                    <?php
                                } ?>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row login-submit login-content">
                        <div class="col-lg-12">
                                <p><input type='hidden' name='action' value='login' />
                                    <button type="submit" class="btn btn-default" name='login_submit' value='login'><?php eT('Log in');?></button><br />
                                    <br/>
                                    <?php
                                    if (Yii::app()->getConfig("display_user_password_in_email") === true)
                                    {
                                        ?>
                                        <a href='<?php echo $this->createUrl("admin/authentication/sa/forgotpassword"); ?>'><?php eT("Forgot your password?"); ?></a><br />
                                        <?php
                                    }
                                    ?>
                                </p>
                        </div>

                    </div>
                <?php echo CHtml::endForm(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Set focus on user input -->
<script type='text/javascript'>
    document.getElementById('user').focus();
</script>
