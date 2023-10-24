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
