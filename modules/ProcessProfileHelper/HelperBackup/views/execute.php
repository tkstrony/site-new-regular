<?php namespace ProcessWire;
/** @var string $subhead */
/** @var string $backupDbForm */
/** @var string $backupFilesForm */
/** @var array $backupDbFiles */
/** @var array $backupSiteFiles */
/** @var bool $limitBackupFiles */

?>

<h2><?= $subhead ?></h2>

<div <?php if(!$limitBackupFiles) echo 'class="uk-grid-divider uk-child-width-expand@s" uk-grid'; ?>>

<?php
    if(!$limitBackupFiles):
?>
    <div>
        <!-- Forms backups -->
        <?= $backupAllForm ?>
        <hr>
        <?= $backupDbForm ?>
        <hr>
        <?= $backupFilesForm ?>
    </div>
<?php
    endif;
?>

    <div>
        <!-- DB backups -->
        <div>
            <h3 class='uk-heading-small uk-heading-bullet'><?= $strDbFiles ?></h3>
            <?= $backupDbFiles ?>
        </div>

        <!-- Files backups -->
        <div>
            <h3 class='uk-heading-small uk-heading-bullet'><?= $strFiles ?></h3>
            <?= $backupSiteFiles ?>
        </div>
    </div>

</div>
