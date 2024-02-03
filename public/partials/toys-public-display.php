<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://awesomecoder.dev
 * @since      1.0.0
 *
 * @package    Toys
 * @subpackage Toys/public/partials
 */
?>
<div class="toys-container">
    <?php foreach ($steps as $key => $step) : ?>
        <h2 class="toys-question" id="question-for-step-<?php echo $step["id"] ?>" data-children="<?php echo isset($step["children"]) ? 1 : 0  ?>" style='display:none;'><?php echo $step["question"] ?></h2>
    <?php endforeach; ?>
    <div class="toys-grid grid-cols">
        <?php foreach ($steps as $key => $step) : ?>
            <?php if ($key != 0) : ?>
                <div class="toys-grid-item" id="toys-item-<?php echo $step["id"] ?>" data-id="<?php echo $step["id"] ?>" style="display: none;">
                    <div class="toys-grid-content">
                        <?php if (isset($step["image"]) && !empty($step["image"])) : ?>
                            <div class="toys-grid-box">
                                <div class="toys-item-image" style="background-image: url(<?php echo $step["image"] ?>);"></div>
                                <div class="toys-item-image-overlay"></div>
                            </div>
                        <?php else : ?>
                            <div class="toys-grid-box toys-grid-content-box ">
                                <div class="toys-item-description">
                                    <p class="toys-item-description-text"><?php echo strlen($step["description"] ?? "") > 100 ? substr($step["description"] ?? "", 0, 100) . "..." : substr($step["description"] ?? "", 0, 50) ?></p>
                                </div>
                                <div class="toys-item-image-background"></div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (isset($step["image"]) && !empty($step["image"])) : ?>
                        <div class="toys-grid-footer">
                            <h2 class="toys-grid-item-heading"><?php echo $step["title"]; ?></h2>
                        </div>
                    <?php else : ?>
                        <div class="toys-grid-footer">
                            <h2 class="toys-grid-item-heading"><?php echo $step["title"]; ?></h2>
                        </div>
                    <?php endif; ?>

                    <?php if (!isset($step["children"])) : ?>
                        <div class="toys-grid-selection" id="toys-item-select-<?php echo $step["id"] ?>">
                            <div class="toys-wrap">
                                <p class="toys-item-selection-text"><?php echo $step["description"]; ?></p>
                                <a href="<?php echo !empty($step["link"]) ? $step["link"] : "javascript:void(0);" ?>" class="toys-select-btn">
                                    <?php _e("Select", "toys") ?>
                                    <svg style="height: 18px;width:18px; margin-left:15px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="toys-grid-selection" id="toys-item-select-<?php echo $step["id"] ?>">
                            <div class="toys-wrap">
                                <p class="toys-item-selection-text"><?php //echo $step["description"]; ?></p>
                                <span class="toys-select-btn">
                                    <?php _e("Next", "toys") ?>
                                    <svg style="height: 18px;width:18px; margin-left:15px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="toys-banner-container">
        <div class="toys-banner-content">
            <h2 class="toys-banner-title"> Kids Party Decision Maker </h2>
            <p class="toys-banner-tagline">Let us help you find the best match for your next adventure.</p>
            <a href="javascript:void(0);" class="toys-start-btn" id="toys-start-btn">
                <?php echo isset($steps[0]["title"]) ? $steps[0]["title"] : _("Start", "toys") ?>
                <svg style="height: 18px;width:18px; margin-left:15px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right">
                    <path d="M5 12h14" />
                    <path d="m12 5 7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    <div class="toys-flex">
        <a href="javascript:void(0);" class="toys-reset-btn" id="toys-reset-btn" style="display: none;">
            <?php _e("Start Over", "toys") ?>
            <svg style="height: 18px;width:18px; margin-left:15px; transform: rotate(180deg);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rotate-ccw">
                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                <path d="M3 3v5h5" />
            </svg>
        </a>
    </div>
</div>