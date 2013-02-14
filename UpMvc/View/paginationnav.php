<?php
/**
 * HTML-uppmärkning för sidnavigation (pagination)
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.2.2
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
?>
<nav class="UpMvc_Pagination">
    <ul>
        <?php if ($pagination->getCurrent() != 1): ?>
            <li class="UpMvc_Page_First"><a href="?page=1">&laquo; Första</a></li>
            <li class="UpMvc_Page_Previous"><a href="?page=<?php echo $pagination->getCurrent() - 1 ?>">&lsaquo; Bakåt</a></li>
        <?php endif; ?>

        <?php foreach ($pagination->getArray() as $page): ?>
            <?php if ($pagination->getCurrent() != $page): ?>
                <li class="UpMvc_Page"><a href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>
            <?php else: ?>
                <li class="UpMvc_Page_Current"><?php echo $page ?></li>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if ($pagination->getCurrent() != $pagination->getPages()): ?>
            <li class="UpMvc_Page_Next"><a href="?page=<?php echo $pagination->getCurrent() + 1 ?>">Framåt &rsaquo;</a></li>
            <li class="UpMvc_Page_Last"><a href="?page=<?php echo $pagination->getPages() ?>">Sista &raquo;</a></li>
        <?php endif; ?>

        <li class="UpMvc_Page_Sum"><small>Visar <?php echo $pagination->getOffset() + 1 ?> - <?php echo $pagination->getOffset() + $pagination->getLimit() ?> av <?php echo $pagination->getTotal() ?> funna poster</small></li>
    </ul>
</nav>