/**
 *	INIT JS
 *
 *																__
 *	                                                           |  |
 *	  __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __|  | ___ _ ____
 *	 / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _`  |/ _ \ ' __|
 *	| (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_|  |  __/  |
 *	\__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,___|\___|__|
 */
function structureData(data) {
	const map = {};
	const result = [];

	data?.forEach((item) => {
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
