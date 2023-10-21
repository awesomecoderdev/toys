import React, { Fragment } from "react";
import ReactDOM from "react-dom/client";
import App from "./App";

// if (document.getElementById("wpwrap") != null) {
// 	const root = ReactDOM.createRoot(document.getElementById("wpwrap"));
// 	root.render(<App />);
// }

if (document.getElementById("wpcontent") != null) {
	const root = ReactDOM.createRoot(document.getElementById("wpcontent"));
	root.render(<App />);
}
