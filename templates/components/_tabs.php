<?php namespace ProcessWire;

/**
 * Name _tabs
 * @var string $itemClassName
 * @var string $class
 * @var string $tContent
 * @var string $tabBtn
 * @var string $allContent
 * @var int $activeTab
 */

if(!isset($tabs)) return ''; ?>

<div class="<?= $itemClassName ?> tabs-container <?= $class; ?>" x-data="{ activeTab: <?= $activeTab; ?> }">
    <ul class="tabs -list-none">
        <?php $i = 0; ?>
        <?php foreach ($tabs as $tName => $tContent): ?>
            <?php $i++; ?>
            <li>
                <a href="#"
                    class="btn"
                    :class="{ 'active': activeTab === <?= $i; ?> }"
                    @click.prevent="activeTab = <?= $i; ?>">
                        <?= $tName; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php $i = 0; ?>
    <?php foreach ($tabs as $tName => $tContent): ?>
        <?php $i++; ?>
        <div x-show="activeTab === <?= $i; ?>" class="tab-content">
            <?= $tContent; ?>
        </div>
    <?php endforeach; ?>
</div>

<?php
$style = <<<CSS
.tabs-container {
    .tabs {
        display: flex;
        flex-wrap: wrap;
        gap: var(--sp-xs);
        li {
            padding-left: 0;
            a {
                margin-bottom: 0;
                border-bottom: var(--sp-2xs) solid transparent;
                &.active {
                    border-bottom: var(--sp-2xs) solid var(--color-contrast-70);
                }
            }
        }
    }
    .tab-content {
        background-color: var(--bg-color);
        margin-top: var(--sp-md);
        padding-bottom: var(--sp-md);
        border-bottom: var(--sp-6xs) dashed var(--color-contrast-70);
    }
}
CSS;

// set region
echo _globalRegion($itemClassName, Html::styleTag($style));
