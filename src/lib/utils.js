import { clsx } from "clsx";
import { twMerge } from "tailwind-merge";

export function cn(...inputs) {
	return twMerge(clsx(inputs));
}

export function structureData(data) {
	const map = {};
	const result = [];

	data.forEach((item) => {
		const newItem = { ...item };
		newItem.children = [];

		map[item.id] = newItem;

		const parent = item.parent_id || null;

		if (!map[parent]) {
			result.push(newItem);
		} else {
			map[parent].children.push(newItem);
		}
	});

	return result;
}
const a = awesomecoder;
export const site_url = typeof a !== "undefined" ? a.url : "/";
export const endpoint = typeof a !== "undefined" ? a.ajaxurl : "/";
export const default_image = typeof a !== "undefined" ? a.image : "/";

// if (typeof wp !== "undefined" && typeof wp.media !== "undefined") {
// 	console.log("wp.media is loaded");
// } else {
// 	console.log("wp.media is not loaded");
// }
