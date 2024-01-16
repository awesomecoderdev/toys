(function ($) {
	"use strict";

	/**
	 * All of the code for your public-facing JavaScript source
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
	const data = awesomecoder?.steps ?? [];
	let steps = structureData(data);

	// start steps
	$(document).on("click", "#toys-start-btn", function (e) {
		e.stopPropagation();
		$("#toys-reset-btn").show();
		$(".toys-grid-item").hide();
		$(this).hide();
		steps[0]?.children?.map((item) => $(`#toys-item-${item.id}`).show());
	});

	// reset steps
	$(document).on("click", "#toys-reset-btn", function (e) {
		e.stopPropagation();
		$("#toys-start-btn").show();
		$(".toys-grid-item").hide();
		$(".toys-question").hide();
		$(".toys-question:first-child").show();
		$(this).hide();
		steps[0]?.children?.map((item) => $(`#toys-item-${item.id}`).show());
	});

	// next steps
	$(document).on("click", ".toys-grid-item", function (e) {
		e.stopPropagation();
		$("#toys-start-btn").hide();
		$("#toys-reset-btn").show();
		let next = $(this).attr("data-id");
		let hasChild =
			data?.filter((i) => i?.parent_id == next)?.length > 0 ?? false;
		console.log("hasChild", hasChild);
		if (hasChild) {
			$(".toys-grid-item").hide();
			$(".toys-question").hide();
			$(`#question-for-step-${next}`).show();

			data?.map((item) => {
				if (item?.parent_id == next) {
					$(`#toys-item-${item.id}`).show();
				}
			});
		}
	});
})(jQuery);
