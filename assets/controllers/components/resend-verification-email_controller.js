import { Controller } from '@hotwired/stimulus';
import { useToastify } from '../mixins/use-toastify';

export default class extends Controller {
    static values = {
        url: String
    }

    connect() {
        useToastify(this);
    }

    resendEmail(event) {
        const target = event.currentTarget;

        fetch(this.urlValue).then(response => {
            return response.json();
        }).then(response => {
            target.remove();

            this.showSuccessToast(response.message);
        })
    }
}