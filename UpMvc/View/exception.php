<?php
/**
 * HTML-uppmärkning för Up MVC's felhantering
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
?>

<h2>Up MVC har genererat ett fel</h2>

<div class="note">
    <p>
        <strong>Meddelande:</strong><br />
        <?php echo $exception->getMessage() ?><br />
        <br />
        <strong>Modul:</strong> <?php echo $router->getModule() ?><br />
        <strong>Controller:</strong> <?php echo $router->getController() ?><br />
        <strong>Action:</strong> <?php echo $router->getAction() ?><br />
        <strong>Parametrar: </strong> <?php echo htmlspecialchars(rtrim(implode($router->getParameters(), ', '), ', ')) ?><br />
    </p>
</div>

<h3>Stackspårning</h3>
<p>
    <strong>Meddelande kastat i:</strong><br />
    <?php echo $exception->getFile() ?>, rad <?php echo $exception->getLine() ?>
</p>

<table>
    <tr>
        <th>#</th>
        <th>sökväg / fil</th>
        <th>rad</th>
        <th>function</th>
    </tr>
    <?php foreach ($trace as $key => $stack): ?>
        <tr>
            <th><?php echo $key ?></th>
            <td><?php if (isset($stack['file'])) echo $stack['file'] ?></td>
            <td><?php if (isset($stack['line'])) echo $stack['line'] ?></td>
            <td><?php echo $stack['function'] ?> (<?php echo implode(', ', $stack['args']) ?>)</td>
        </tr>
    <?php endforeach ?>
    <tr>
        <th><?php echo ++$key ?></th>
        <td colspan="3">{main}</td>
    </tr>
</table>
