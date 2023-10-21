(function ($) {
	"use strict";

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	// // Uploading files
	// var file_frame;

	// $(document).on("click", "#selectme", function (event) {
	// 	event.preventDefault();

	// 	// If the media frame already exists, reopen it.
	// 	if (file_frame) {
	// 		file_frame.open();
	// 		return;
	// 	}

	// 	// Create the media frame.
	// 	file_frame = wp.media.frames.downloadable_file = wp.media({
	// 		title: "Choose an image",
	// 		button: {
	// 			text: "Select Slider",
	// 		},
	// 		multiple: false,
	// 	});

	// 	// When an image is selected, run a callback.
	// 	file_frame.on("select", function () {
	// 		var attachment = file_frame
	// 			.state()
	// 			.get("selection")
	// 			.first()
	// 			.toJSON();
	// 		var attachment_thumbnail =
	// 			attachment.sizes.thumbnail || attachment.sizes.full;

	// 		$("#slider_thumbnail_id").val(attachment.id);
	// 		$("#slider_thumbnail").css(
	// 			"background-image",
	// 			`url(${attachment_thumbnail.url})`
	// 		);
	// 		// $(".remove_image_button").show();
	// 		$("#slider_thumbnail_placeholder").css("z-index", "-1");
	// 	});

	// 	// Finally, open the modal.
	// 	file_frame.open();
	// });
})(jQuery);
