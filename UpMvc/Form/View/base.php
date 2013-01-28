<?php
/**
 * HTML-uppmärkning formuläret
 *
 * @author Ola Waljefors
 * @package UpMVC
 * @subpackage Form
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
?>

<form id="<?php echo $form->getId() ?>" method="<?php echo $form->getMethod() ?>" action="<?php echo $form->getAction() ?>">
<?php foreach ($form->getFields() as $field): ?>
    <?php echo $field->render() ?>
<?php endforeach ?>
</form>
