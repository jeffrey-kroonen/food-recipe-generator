/**
 * Import external files.
 */
let importScriptFile;

importScriptFile = document.createElement("script");
importScriptFile.src = `${WEBSITE_ROOT}/assets/js/ext/jquery.min.js`;
document.head.appendChild(importScriptFile);

importScriptFile = document.createElement("script");
importScriptFile.src = `${WEBSITE_ROOT}/assets/js/ext/bootstrap.min.js`;
document.head.appendChild(importScriptFile);