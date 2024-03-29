import { showSuccessToast } from './toast';

export default class ResendVerificationEmail {
    btn = document.getElementById('resend-verification-email-btn');

    constructor() {
        this.btn && this.btn.addEventListener('click', this.resendVerificationEmail);
    }

    resendVerificationEmail = (e) => {
        const target = e.currentTarget;

        fetch(target.getAttribute('data-path')).then(response => {
            return response.json();
        }).then(data => {
            this.btn.remove();

            showSuccessToast(data.message);
        });
    }
}