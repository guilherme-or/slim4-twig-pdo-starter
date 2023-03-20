import { contentReady, ready } from "./util.js";

contentReady(() => {
    console.log("DOM Content State: " + document.readyState);
});

ready(() => {
    console.log("Window Content State: " + document.readyState);
});
