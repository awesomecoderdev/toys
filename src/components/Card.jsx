import React, { Fragment, useRef, useState } from "react";
import { toast } from "sonner";
import {
	Dialog,
	DialogContent,
	DialogDescription,
	DialogFooter,
	DialogHeader,
	DialogTitle,
	DialogTrigger,
} from "@/components/ui/dialog";
import {
	AlertDialog,
	AlertDialogAction,
	AlertDialogCancel,
	AlertDialogContent,
	AlertDialogDescription,
	AlertDialogFooter,
	AlertDialogHeader,
	AlertDialogTitle,
	AlertDialogTrigger,
} from "@/components/ui/alert-dialog";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { Repeat1, XCircle } from "lucide-react";

import {
	cn,
	structureData,
	site_url,
	default_image,
	endpoint,
	defaultSteps,
} from "@/lib/utils";
import axios from "axios";

export const Card = ({ tree, step, position, end, setSteps, isFirst }) => {
	let frame;
	const [open, setOpen] = useState(false);
	const imageRef = useRef(null);
	const [title, setTitle] = useState(null);
	const [link, setLink] = useState(null);
	const [question, setQuestion] = useState(null);
	const [description, setDescription] = useState(null);

	const handleMediaUploader = (e, step) => {
		try {
			console.log("imageRef", imageRef.current);
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
			// frame = wp.media({
			// 	title: "Choose step image",
			// 	button: {
			// 		text: "Save Changes",
			// 	},
			// 	multiple: false,
			// });

			frame = wp.media.frames.file_frame = wp.media({
				title: "Choose Media",
				button: {
					text: "Select",
				},
				multiple: false, // Set to true if you want to allow multiple file uploads
			});

			// When an image is selected, run a callback.
			frame.on("select", function () {
				const attachment = frame
					.state()
					.get("selection")
					.first()
					.toJSON();
				// const image =
				// 	attachment.sizes.thumbnail || attachment.sizes.full;
				// const image = attachment.url;
				// console.log("attachment", attachment.id, attachment);
				// console.log("image", image);

				if (attachment?.id && attachment?.url) {
					axios
						.post(
							endpoint,
							{
								do: "update",
								id: step.id,
								thumbnail_id: attachment.id,
								image: attachment.url,
							},
							{
								headers: {
									"X-Requested-With": "XMLHttpRequest",
									"Content-type": "multipart/form-data",
									// "Keep-Alive": "timeout=5, max=1000",
								},
							}
						)
						.then(({ data: { data } }) => {
							const response = data;
							console.log("res", data);
							if (response.success) {
								toast.success(response.message);
								if (response.data.steps) {
									try {
										setSteps(
											structureData(response.data.steps)
										);
									} catch (err) {
										console.log("err", err);

										if (err.message) {
											toast.error(err.message);
										} else {
											toast.error(
												"Something went wrong."
											);
										}
									}
								}
							} else {
								toast.error(response.message);
							}
						})
						.catch((err) => {
							console.log("err", err);
							if (err.message) {
								toast.error(err.message);
							} else {
								toast.error("Something went wrong.");
							}
						});
				} else {
					toast.error("Invalid attachment, select different image.");
				}
			});

			// Finally, open the modal.
			frame.open();
		} catch (error) {
			console.log("error", error);
			toast.error(error?.message ?? "Wordpress media is not enabled.");
		}
	};

	const addNewDataToLists = (e, step) => {
		try {
			axios
				.post(
					endpoint,
					{
						do: "create",
						id: step.id,
					},
					{
						headers: {
							"X-Requested-With": "XMLHttpRequest",
							"Content-type": "multipart/form-data",
							// "Keep-Alive": "timeout=5, max=1000",
						},
					}
				)
				.then(({ data: { data } }) => {
					const response = data;
					console.log("res", data);
					if (response.success) {
						toast.success(response.message);

						if (response.data.steps) {
							console.log(
								"steps",
								structureData(response.data.steps)
							);
							try {
								setSteps(structureData(response.data.steps));
							} catch (error) {
								console.log("error", error);
							}
						}
					} else {
						toast.error(response.message);
					}
				})
				.catch((err) => {
					console.log("err", err);

					if (err.message) {
						toast.error(err.message);
					} else {
						toast.error("Something went wrong.");
					}
				});
		} catch (err) {
			console.log("err", err);

			if (err.message) {
				toast.error(err.message);
			} else {
				toast.error("Something went wrong.");
			}
		}
	};

	const deleteDataFromLists = (e, step) => {
		try {
			axios
				.post(
					endpoint,
					{
						do: "delete",
						id: step.id,
					},
					{
						headers: {
							"X-Requested-With": "XMLHttpRequest",
							"Content-type": "multipart/form-data",
							// "Keep-Alive": "timeout=5, max=1000",
						},
					}
				)
				.then(({ data: { data } }) => {
					const response = data;
					console.log("res", data);
					if (response.success) {
						toast.success(response.message);

						if (response.data.steps) {
							console.log(
								"steps",
								structureData(response.data.steps)
							);
							try {
								setSteps(structureData(response.data.steps));
							} catch (err) {
								console.log("err", err);

								if (err.message) {
									toast.error(err.message);
								} else {
									toast.error("Something went wrong.");
								}
							}
						}
					} else {
						toast.error(response.message);
					}
				})
				.catch((err) => {
					console.log("err", err);

					if (err.message) {
						toast.error(err.message);
					} else {
						toast.error("Something went wrong.");
					}
				});
		} catch (err) {
			console.log("err", err);

			if (err.message) {
				toast.error(err.message);
			} else {
				toast.error("Something went wrong.");
			}
		}
	};

	const updateDataToLists = (e, step) => {
		e.preventDefault();
		try {
			axios
				.post(
					endpoint,
					{
						do: "update",
						id: step.id,
						title,
						link,
						question,
						description,
					},
					{
						headers: {
							"X-Requested-With": "XMLHttpRequest",
							"Content-type": "multipart/form-data",
							// "Keep-Alive": "timeout=5, max=1000",
						},
					}
				)
				.then(({ data: { data } }) => {
					const response = data;
					console.log("res", data);
					if (response.success) {
						toast.success(response.message);
						if (response.data.steps) {
							try {
								setSteps(structureData(response.data.steps));
							} catch (err) {
								console.log("err", err);
								console.log("err", err);

								if (err.message) {
									toast.error(err.message);
								} else {
									toast.error("Something went wrong.");
								}
							}
						}
					} else {
						toast.error(response.message);
					}

					setTimeout(() => {
						setOpen(false);
					}, 800);
				})
				.catch((err) => {
					console.log("err", err);
					if (err.message) {
						toast.error(err.message);
					} else {
						toast.error("Something went wrong.");
					}
				});
		} catch (error) {
			toast.error(error.message);
		}
	};

	const duplicateDataToLists = (e, step) => {
		e.preventDefault();
		console.log("e", e);
		console.log("step", step.children);
		try {
			axios
				.post(
					endpoint,
					{
						do: "duplicate",
						id: step.id,
						parent_id: step.parent_id,
						thumbnail_id: step.thumbnail_id,
						description: step.description,
						title: step.title,
						image: step.image,
						link: step.link,
						question: step.question,
					},
					{
						headers: {
							"X-Requested-With": "XMLHttpRequest",
							"Content-type": "multipart/form-data",
							// "Keep-Alive": "timeout=5, max=1000",
						},
					}
				)
				.then(({ data: { data } }) => {
					const response = data;
					console.log("step", response.data.steps);
					console.log("res", data);

					if (response.success) {
						toast.success(response.message);
						if (response.data.steps) {
							try {
								setSteps(structureData(response.data.steps));
							} catch (err) {
								console.log("err", err);
								console.log("err", err);

								if (err.message) {
									toast.error(err.message);
								} else {
									toast.error("Something went wrong.");
								}
							}
						}
					} else {
						toast.error(response.message);
					}

					// setTimeout(() => {
					// 	setOpen(false);
					// }, 800);
				})
				.catch((err) => {
					console.log("err", err);
					if (err.message) {
						toast.error(err.message);
					} else {
						toast.error("Something went wrong.");
					}
				});
		} catch (error) {
			toast.error(error.message);
		}
	};

	const removeImageFromDataLists = (e, step) => {
		e.preventDefault();
		try {
			axios
				.post(
					endpoint,
					{
						do: "remove",
						id: step.id,
					},
					{
						headers: {
							"X-Requested-With": "XMLHttpRequest",
							"Content-type": "multipart/form-data",
							// "Keep-Alive": "timeout=5, max=1000",
						},
					}
				)
				.then(({ data: { data } }) => {
					const response = data;
					console.log("res", data);
					if (response.success) {
						toast.success(response.message);
						if (response.data.steps) {
							try {
								setSteps(structureData(response.data.steps));
							} catch (err) {
								console.log("err", err);
								console.log("err", err);

								if (err.message) {
									toast.error(err.message);
								} else {
									toast.error("Something went wrong.");
								}
							}
						}
					} else {
						toast.error(response.message);
					}
				})
				.catch((err) => {
					console.log("err", err);
					if (err.message) {
						toast.error(err.message);
					} else {
						toast.error("Something went wrong.");
					}
				});
		} catch (error) {
			toast.error(error.message);
		}
	};

	return (
		<Fragment>
			<div className={cn("relative")}>
				<div
					className={cn(
						"pointer-events-none",
						position == 0 && "absolute w-1/2 bg-white h-5 -top-11",
						step == null &&
							end == position &&
							"absolute w-1/2 bg-white h-5 -top-11 -right-[1px]"
					)}
				></div>
				<div
					className={cn(
						"relative mx-auto bg-white mb-10 z-10 shadow-xl drop-shadow-2xl rounded-md w-56 min-h-[10rem] border border-dashed border-zinc-600",
						position === 0
							? "" // "-translate-x-20"
							: "",
						step == null && end == position
							? //  "translate-x-20"
							  ""
							: ""
					)}
				>
					{step == null && (
						<span
							className={cn(
								"absolute w-0.5 h-10 border-r border-dashed border-zinc-600 left-1/2 translate-x-[-50%] -top-10"
								// tree?.children?.length < 1 && "hidden"
							)}
						></span>
					)}
					{/* content */}
					<div className="relative space-y-2">
						<div className="relative border-b border-dashed border-zinc-600 p-2">
							<div className="flex justify-between space-x-2">
								<p className="truncate w-40">{tree?.title}</p>

								<div className="relative flex space-x-2">
									{/* awesomecoder.url == "https://wordpress.co.bd" && */}

									{!isFirst && (
										<svg
											onClick={(e) =>
												duplicateDataToLists(e, tree)
											}
											xmlns="http://www.w3.org/2000/svg"
											fill="none"
											viewBox="0 0 24 24"
											strokeWidth="1.5"
											stroke="currentColor"
											className="cursor-pointer w-4 h-4"
										>
											<path
												strokeLinecap="round"
												strokeLinejoin="round"
												d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75"
											/>
										</svg>
									)}

									<Dialog open={open} onOpenChange={setOpen}>
										<DialogTrigger asChild>
											<svg
												xmlns="http://www.w3.org/2000/svg"
												fill="none"
												viewBox="0 0 24 24"
												strokeWidth="1.5"
												stroke="currentColor"
												className="cursor-pointer w-4 h-4"
											>
												<path
													strokeLinecap="round"
													strokeLinejoin="round"
													className="pointer-events-none"
													d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
												/>
											</svg>
										</DialogTrigger>
										<DialogContent className="sm:max-w-[525px]">
											<DialogHeader>
												<DialogTitle>
													Edit Steps
												</DialogTitle>
												<DialogDescription>
													Make changes to the steps
													here. Click save when you're
													done.
												</DialogDescription>
											</DialogHeader>
											<form
												onSubmit={(e) =>
													e.preventDefault()
												}
												className="grid gap-4 pt-4"
											>
												<div className="grid grid-cols-4 items-center gap-4">
													<Input
														id="title"
														defaultValue={
															title
																? title
																: tree?.title
														}
														className="col-span-4"
														placeholder="e.g. Mohammad Ibrahim"
														onChange={(e) =>
															setTitle(
																e.target.value
															)
														}
													/>

													<Input
														id="link"
														defaultValue={
															link
																? link
																: tree?.link
														}
														className="col-span-4"
														placeholder={
															"e.g. https://awesomecoder.dev/"
														}
														onChange={(e) =>
															setLink(
																e.target.value
															)
														}
													/>
													<Input
														id="question"
														defaultValue={
															question
																? question
																: tree?.question
														}
														className="col-span-4"
														placeholder={"Question"}
														disabled={
															tree?.children
																?.length == 0
														}
														onChange={(e) =>
															setQuestion(
																e.target.value
															)
														}
													/>
													<div className="relative col-span-4">
														<Textarea
															name="description"
															id="description"
															placeholder={
																"e.g. I'm Mohammad Ibrahim. I live in the Future, where I develop the universe. For more details visit https://www.awesomecoder.dev/."
															}
															rows="8"
															className="capitalize"
															onChange={(e) =>
																setDescription(
																	e.target
																		.value
																)
															}
														>
															{description
																? description
																: tree?.description}
														</Textarea>
													</div>
												</div>

												<DialogFooter>
													<Button
														type="submit"
														onClick={(e) =>
															updateDataToLists(
																e,
																tree
															)
														}
													>
														Save changes
													</Button>
												</DialogFooter>
											</form>
										</DialogContent>
									</Dialog>
									<svg
										onClick={(e) =>
											addNewDataToLists(e, tree)
										}
										xmlns="http://www.w3.org/2000/svg"
										fill="none"
										viewBox="0 0 24 24"
										strokeWidth="1.5"
										stroke="currentColor"
										className="cursor-pointer w-4 h-4"
									>
										<path
											className="pointer-events-none"
											strokeLinecap="round"
											strokeLinejoin="round"
											d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
										/>
									</svg>

									{!isFirst && (
										<AlertDialog>
											<AlertDialogTrigger asChild>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													fill="none"
													viewBox="0 0 24 24"
													strokeWidth="1.5"
													stroke="currentColor"
													className="cursor-pointer w-4 h-4 text-red-600"
												>
													<path
														className="pointer-events-none"
														strokeLinecap="round"
														strokeLinejoin="round"
														d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
													/>
												</svg>
											</AlertDialogTrigger>
											<AlertDialogContent>
												<AlertDialogHeader>
													<AlertDialogTitle>
														Are you absolutely sure?
													</AlertDialogTitle>
													<AlertDialogDescription>
														This action cannot be
														undo. This will
														permanently delete
														current steps with all
														child steps from
														database.
													</AlertDialogDescription>
												</AlertDialogHeader>
												<AlertDialogFooter>
													<AlertDialogCancel>
														Cancel
													</AlertDialogCancel>
													<AlertDialogAction
														onClick={(e) =>
															deleteDataFromLists(
																e,
																tree
															)
														}
													>
														Continue
													</AlertDialogAction>
												</AlertDialogFooter>
											</AlertDialogContent>
										</AlertDialog>
									)}
								</div>
							</div>
						</div>
						<div className="relative overflow-hidden">
							{tree?.image ? (
								<Fragment>
									<div
										style={{
											backgroundImage:
												tree?.image && tree.thumbnail_id
													? `url(${tree.image})`
													: `url(${default_image})`,
										}}
										ref={imageRef}
										className="relative mx-2 col-span-4 bg-cover bg-no-repeat bg-top flex justify-center items-center aspect-[8/5] rounded-md bg-slate-50"
									>
										<div className="absolute bg-gradient-to-b from-white to-transparent bg-blend-soft-light flex justify-end p-3 gap-3 top-0 left-0 w-full ">
											<Repeat1
												onClick={(e) =>
													handleMediaUploader(e, tree)
												}
												className="h-4 w-4 text-indigo-600 cursor-pointer"
											/>
											<XCircle
												onClick={(e) =>
													removeImageFromDataLists(
														e,
														tree
													)
												}
												className="h-4 w-4 text-red-500 cursor-pointer"
											/>
										</div>
									</div>
									<p className="lead text-xs capitalize px-2 py-1 line-clamp-3">
										{tree.description}
									</p>
								</Fragment>
							) : (
								<Fragment>
									<div className="relative">
										<div
											onClick={(e) =>
												handleMediaUploader(e, tree)
											}
											className="relative cursor-pointer pb-2 border-b border-dashed border-zinc-600 w-full flex items-center justify-end"
										>
											<p className="pointer-events-none text-[10px]">
												Choose Image
											</p>
											<svg
												xmlns="http://www.w3.org/2000/svg"
												fill="none"
												viewBox="0 0 24 24"
												strokeWidth="1.5"
												stroke="currentColor"
												className="pointer-events-none w-4 h-4 mx-2"
											>
												<path
													className="pointer-events-none"
													strokeLinecap="round"
													strokeLinejoin="round"
													d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
												/>
											</svg>
										</div>
										<p className="lead text-xs capitalize px-2 py-1 line-clamp-6">
											{tree.description}
										</p>
									</div>
								</Fragment>
							)}

							<h1 className="text-sm hidden">
								ID: {tree?.id}
								{/* <br />
								Title: {tree?.title}
								<br />
								Pos: {position}
								<br />
								End: {end} */}
							</h1>
						</div>
					</div>

					{tree?.children?.length > 0 && (
						<span
							className={cn(
								"absolute w-0.5 h-10 border-r border-dashed border-zinc-600 left-1/2 translate-x-[-50%] -bottom-10",
								tree?.children?.length == 1 && "hidden"
							)}
						></span>
					)}
				</div>

				{(() => {
					if (tree?.children?.length > 0) {
						const end = tree?.children?.length ?? 0;
						return (
							<div
								className={cn(
									"relative border-dashed border-zinc-600  inline-flex justify-between space-x-10",
									tree?.children?.length != 1 && "border-t",
									tree?.children?.length > 1 && "py-10",
									isFirst && "mr-10"
								)}
							>
								{tree?.children?.map((steps, i) => (
									<Card
										key={`${tree?.id}.${steps?.length}.${i}`}
										tree={steps}
										position={i}
										end={end - 1}
										setSteps={setSteps}
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

export default Card;
