import React, { Fragment, useState } from "react";

const App = () => {
	const [steps, setSteps] = useState([
		{
			id: 1,
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
								},
								{
									id: 3,
									title: "Three",
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
												},
												{
													id: 3,
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
										},
									],
								},
							],
						},
						{
							id: 3,
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
						},
						{
							id: 3,
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
	return (
		<Fragment>
			<div className="relative w-full overflow-scroll mx-auto">
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
	return (
		<Fragment>
			<div className="relative space-y-10 space-x-20">
				<div
					className={`relative p-3 mx-auto shadow-md rounded-md w-40 min-h-[1rem] border border-primary-100 ${
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
						<span className="absolute w-0.5 h-10 bg-slate-100 left-1/2 translate-x-[-50%] -top-10"></span>
					)}
					{/* <span className="absolute w-1/2 h-10 bg-primary-100 left-0 -top-10"></span> */}
					<h1 className="text-center">
						{tree?.title}
						{position}
						{end}
					</h1>

					{tree?.children && (
						<span className="absolute w-0.5 h-10 bg-slate-100 left-1/2 translate-x-[-50%] -bottom-10"></span>
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
								className="relative border-t py-10 inline-flex justify-between space-x-20"
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

const Leaf = () => {
	return <Fragment></Fragment>;
};
