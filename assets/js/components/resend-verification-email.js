import { showToast } from './toast';

export default class ResendVerificationEmail {
    constructor() {
        this.initElements();
        this.initListeners();
    }

    initElements() {
        this.btn = document.getElementById('resend-verification-email-btn');
    }

    initListeners() {
        this.btn && this.btn.addEventListener('click', this.resendVerificationEmail);
    }

    resendVerificationEmail = (e) => {
        const target = e.currentTarget;

        fetch(target.getAttribute('data-route')).then(response => {
            return response.json();
        }).then(data => {
            this.btn.remove();

            showToast(data.message);
        });
    }
}