<?php
/**
 * HTML-uppmärkning för en resetknapp
 *
 * @author Ola Waljefors
 * @package UpMVC
 * @subpackage Form
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
?>

<div class="UpMvc_Form_Reset">
    <input type="reset" id="<?php echo $field->getName() ?>" name="<?php echo $field->getName() ?>" value="<?php echo $field->getLabel() ?>" />
    <?php echo $field->getError('<span class="UpMvc_Error">%s</span>') ?>
</div>
