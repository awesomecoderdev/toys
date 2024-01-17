import React, { Fragment, useRef, useState } from "react";
import { Toaster, toast } from "sonner";
import { useDraggable } from "react-use-draggable-scroll";
import { cn, defaultSteps, structureData } from "@/lib/utils";
import { Card } from "@/components/Card";

const App = () => {
	const [steps, setSteps] = useState(structureData(defaultSteps));
	// console.log("steps", steps);

	const canvas = useRef(); // We will use React useRef hook to reference the wrapping div:
	const { events } = useDraggable(canvas); // Now we pass the reference to the useDraggable hook:

	return (
		<Fragment>
			<Toaster
				//  richColors
				duration={4000}
				expand={true}
			/>
			<div
				className={cn(
					"relative bg-white awesomecoder w-full h-full max-h-screen overflow-scroll mx-auto no-scrollbar "
					// (steps[0]?.children?.length ?? 0) < 4 &&
					// 	"flex justify-center"
				)}
				{...events}
				ref={canvas}
			>
				<div className="relative border-zinc-600 inline-flex justify-between space-x-10 py-10 mr-10 p-10 no-scrollbar">
					{steps.map((step, i) => (
						<Fragment key={step.id + i}>
							<Card
								tree={step}
								step={i}
								isFirst={i == 0}
								setSteps={setSteps}
							/>
						</Fragment>
					))}
				</div>
			</div>
		</Fragment>
	);
};

export default App;
