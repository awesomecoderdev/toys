import React, { Fragment, useRef, useState } from "react";
import { useDraggable } from "react-use-draggable-scroll";

const App = () => {
	const [steps, setSteps] = useState([
		{
			id: 0,
			title: "Start",
			image: null,
			link: null,
			children: [
				{
					id: 1,
					title: "One",
					image: null,
					link: null,
				},
				{
					id: 2,
					title: "Two",
					image: null,
					link: null,
					children: [
						{
							id: 4,
							title: "One",
							image: null,
							link: null,
						},
						{
							id: 5,
							title: "Two",
							image: null,
							link: null,
							children: [
								{
									id: 10,
									title: "One",
									image: null,
									link: null,
								},
								{
									id: 11,
									title: "Two",
									image: null,
									link: null,
								},
								{
									id: 12,
									title: "Three",
									image: null,
									link: null,
									children: [
										{
											id: 13,
											title: "One",
											image: null,
											link: null,
										},
										{
											id: 14,
											title: "Two",
											image: null,
											link: null,
											children: [
												{
													id: 16,
													title: "One",
													image: null,
													link: null,
												},
												{
													id: 17,
													title: "Two",
													image: null,
													link: null,
												},
												{
													id: 18,
													title: "Three",
													image: null,
													link: null,
												},
											],
										},
										{
											id: 15,
											title: "Three",
											image: null,
											link: null,
										},
									],
								},
							],
						},
						{
							id: 6,
							title: "Three",
							image: null,
							link: null,
						},
					],
				},
				{
					id: 3,
					title: "Three",
					image: null,
					link: null,
					children: [
						{
							id: 7,
							title: "One",
							image: null,
							link: null,
						},
						{
							id: 8,
							title: "Two",
							image: null,
							link: null,
						},
						{
							id: 9,
							title: "Three",
							image: null,
							link: null,
						},
					],
				},
			],
		},
	]);
	console.log("steps", steps);

	const ref = useRef(); // We will use React useRef hook to reference the wrapping div:
	const { events } = useDraggable(ref); // Now we pass the reference to the useDraggable hook:

	return (
		<Fragment>
			<div
				className="relative awesomecoder w-full h-full max-h-screen overflow-scroll mx-auto no-scrollbar "
				{...events}
				ref={ref} // add reference and events to the wrapping div
			>
				<div className="relative p-10">
					{steps.map((step, i) => (
						<Fragment key={step.id + i}>
							<Card tree={step} step={i} />
						</Fragment>
					))}
				</div>
			</div>
		</Fragment>
	);
};

export default App;

const Card = ({ tree, step, position, end }) => {
	var frame;

	const handleMediaUploader = (e, step) => {
		// Uploading files
		e.preventDefault();
		e.stopPropagation();
		console.log("step", step);
		// If the media frame already exists, reopen it.
		if (frame) {
			frame.open();
			return;
		}

		// Create the media frame.
		frame = wp.media.frames.downloadable_file = wp.media({
			title: "Choose an image",
			button: {
				text: "Select an image",
			},
			multiple: false,
		});

		// When an image is selected, run a callback.
		frame.on("select", function () {
			const attachment = frame.state().get("selection").first().toJSON();
			const image = attachment.sizes.thumbnail || attachment.sizes.full;

			console.log("attachment", attachment.id, attachment);
			console.log("image", image, image.url);
		});

		// Finally, open the modal.
		frame.open();
	};

	return (
		<Fragment>
			<div
				onClick={(e) => handleMediaUploader(e, tree)}
				className="relative space-y-10 space-x-20"
			>
				<div
					className={`relative p-3 mx-auto shadow-md rounded-md w-40 min-h-[10rem] border border-zinc-600 ${
						position === 0
							? ""
							: // "-translate-x-20"
							  ""
					} ${
						step == null && end == position
							? //  "translate-x-20"
							  ""
							: ""
					}`}
				>
					{step == null && (
						<span className="absolute w-0.5 h-10 border-r border-dashed border-zinc-600 left-1/2 translate-x-[-50%] -top-10"></span>
					)}
					{/* <span className="absolute w-1/2 h-10 bg-primary-100 left-0 -top-10"></span> */}
					<h1 className="text-center">
						ID: {tree?.id}
						Title: {tree?.title}
						Pos: {position}
						End: {end}
					</h1>

					{tree?.children && (
						<span className="absolute w-0.5 h-10 border-r border-dashed border-zinc-600 left-1/2 translate-x-[-50%] -bottom-10"></span>
					)}
				</div>

				{(() => {
					if (tree?.children) {
						const end = tree?.children?.length ?? 0;
						return (
							<div
								// className="relative grid gap-10"
								// style={{
								// 	"grid-template-columns": `repeat(${
								// 		tree?.children?.length ?? 1
								// 	}, minmax(0, 1fr))`,
								// }}
								className="relative border-t border-dashed border-zinc-600 py-10 inline-flex justify-between space-x-20"
							>
								{tree?.children?.map((steps, i) => (
									<Card
										key={`${tree?.id}.${steps?.length}.${i}`}
										tree={steps}
										position={i}
										end={end - 1}
									/>
								))}
							</div>
						);
					}
				})()}
			</div>
		</Fragment>
	);
};
