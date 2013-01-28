<?php
/**
 * HTML-uppmärkning för en textarea
 *
 * @author Ola Waljefors
 * @package UpMVC
 * @subpackage Form
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
?>

<div class="UpMvc_Form_Textarea">
    <label for="<?php echo $field->getName() ?>" class="UpMvc_Form_Label"><?php echo $field->getLabel() ?></label>
    <textarea id="<?php echo $field->getName() ?>" name="<?php echo $field->getName() ?>"><?php echo $field->getRequest($field->getName()) ?></textarea>
    <?php echo $field->getError('<span class="UpMvc_Error">%s</span>') ?>
</div>
