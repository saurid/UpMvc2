<?php
/**
 * HTML-uppmärkning för en submitknapp
 *
 * @author Ola Waljefors
 * @package UpMVC
 * @subpackage Form
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
?>

<div class="UpMvc_Form_Submit">
    <input type="submit" name="<?php echo $field->getName() ?>" value="<?php echo $field->getLabel() ?>" />
    <?php echo $field->getError('<span class="UpMvc_Error">%s</span>') ?>
</div>
