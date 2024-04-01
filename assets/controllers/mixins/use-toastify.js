import Toastify from 'toastify-js'

export const useToastify = controller => {
    Object.assign(controller, {
        showSuccessToast(message) {
            Toastify({
                text: '<i class="bi bi-check2-circle fs-5 pe-2"></i>' + message,
                duration: 2000,
                escapeMarkup: false,
            }).showToast();
        },
        showErrorToast(message) {
            Toastify({
                text: '<i class="bi bi-exclamation-triangle-fill fs-5 pe-2"></i>' + message,
                duration: 2000,
                escapeMarkup: false,
            }).showToast();
        }
    });
};