import { Toast } from "bootstrap";

export function showToast(message) {
    const toastLiveExample = document.getElementById('toast');
    const toastMessage = document.getElementById('toast-message');
    const toastBootstrap = Toast.getOrCreateInstance(toastLiveExample);

    toastMessage.innerHTML = message;
    toastBootstrap.show();
}