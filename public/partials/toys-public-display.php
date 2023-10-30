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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<pre>
    <?php //print_r($steps)
    ?>
</pre>
<div class="toys-container">
    <div class="toys-grid">
        <?php foreach ($steps as $key => $step) : ?>
            <div class="toys-grid-item <?php echo $key % 2 == 1 ? 'toys-grid-item-even' : 'toys-grid-item-odd' ?>" id="toys-item-<?php echo $step["id"] ?>">
                <?php
                // echo "<pre>";
                // print_r($step);
                // echo "</pre>";
                ?>

                <div class="toys-grid-content">
                    <?php if (isset($step["image"]) && !empty($step["image"])) : ?>
                        <div class="toys-grid-box">
                            <div class="toys-item-image" style="background-image: url(<?php echo $step["image"] ?>);"></div>
                            <div class="toys-item-image-overlay"></div>
                        </div>
                    <?php else : ?>
                        <div class="toys-grid-box toys-grid-content-box ">
                            <div class="toys-item-description">
                                <p class="toys-item-description-text"><?php echo strlen($step["description"]) > 100 ? substr($step["description"], 0, 100) . "..." : substr($step["description"], 0, 50) ?></p>
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

                <?php endif; ?>

            </div>

        <?php endforeach; ?>
        <!-- <div class="selector-choice-holder">


        <a href="javascript: void(0)" onclick="selector_selectAnswer(455708, 455752)" class="selector-answer selector-image-answer" data-answer="455752">

            <div class="selector-choice-image">
                <img src="/__files/ic/173545/Coin%20Desktop.jpg">
                <div class="selector-choice-image-overlay"></div>
            </div>

            <div class="selector-choice-image-mobile" style="background-image: url('/__files/ic/173546/DS_coins-jewellery.jpg'); background-size: cover">
                <div class="selector-choice-image-overlay-mobile"></div>
            </div>


            <div class="selector-choice-text">Coins and Jewellery</div>
        </a>




        <a href="javascript: void(0)" onclick="selector_selectAnswer(455708, 455766)" class="selector-answer selector-image-answer" data-answer="455766">

            <div class="selector-choice-image">
                <img src="/__files/ic/173547/Relicdesktop.jpg">
                <div class="selector-choice-image-overlay"></div>
            </div>

            <div class="selector-choice-image-mobile" style="background-image: url('/__files/ic/173548/DS_relic.jpg'); background-size: cover">
                <div class="selector-choice-image-overlay-mobile"></div>
            </div>


            <div class="selector-choice-text">Relics</div>
        </a>




        <a href="javascript: void(0)" onclick="selector_selectAnswer(455708, 455780)" class="selector-answer selector-image-answer" data-answer="455780">

            <div class="selector-choice-image">
                <img src="/__files/ic/173549/Gold%20Desktop.jpg">
                <div class="selector-choice-image-overlay"></div>
            </div>

            <div class="selector-choice-image-mobile" style="background-image: url('/__files/ic/173550/DS_gold.jpg'); background-size: cover">
                <div class="selector-choice-image-overlay-mobile"></div>
            </div>


            <div class="selector-choice-text">Gold Nuggets</div>
        </a>




        <a href="javascript: void(0)" onclick="selector_selectAnswer(455708, 455794)" class="selector-answer selector-image-answer" data-answer="455794">

            <div class="selector-choice-image">
                <img src="/__files/ic/173551/allround.jpg">
                <div class="selector-choice-image-overlay"></div>
            </div>

            <div class="selector-choice-image-mobile" style="background-image: url('/__files/ic/173552/Allroundmobile.jpg'); background-size: cover">
                <div class="selector-choice-image-overlay-mobile"></div>
            </div>


            <div class="selector-choice-text">All-Round</div>
        </a>


    </div> -->
    </div>
</div>