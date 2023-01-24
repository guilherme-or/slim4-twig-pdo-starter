export function contentReady(callback) {
    document.addEventListener("DOMContentLoaded", callback);
}

export function ready(callback) {
    window.addEventListener('load', callback);
}
