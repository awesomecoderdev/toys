<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://awesomecoder.dev
 * @since      1.0.0
 *
 * @package    Toys
 * @subpackage Toys/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div id="toysLoadingScreen" class="fixed inset-0 z-[99999999999] h-screen overflow-hidden block bg-white duration-500"></div>
<script>
    const toysLoadingScreen = document.getElementById("toysLoadingScreen"),
        toyStyles = document.querySelectorAll("link"),
        toyScripts = document.querySelectorAll("script"),
        toyStyleTags = document.querySelectorAll("style");
    toyStyles.forEach((e => {
        const t = e.getAttribute("rel"),
            l = e.getAttribute("id"),
            h = e.getAttribute("href");
        !h.includes("wp-admin/load-styles.php") && "stylesheet" == t && !["toys-css", "toys-backend-css"].includes(l) && e.remove()
    })), toyStyleTags.forEach((e => {
        e.remove()
    })), toyScripts.forEach((e => {
        e.getAttribute("src") && e.remove()
    })), setTimeout((() => {
        toysLoadingScreen && (toysLoadingScreen.classList.add("opacity-0"), toysLoadingScreen.remove())
    }), 1e3);
</script>