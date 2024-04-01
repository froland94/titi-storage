import { Controller } from '@hotwired/stimulus';
import { useToastify } from './mixins/use-toastify';

export default class extends Controller {
    static targets = [
        'stockCounter',
        'product'
    ];

    connect() {
        useToastify(this);
    }

    modifyProductStock({params: {url}}) {
        fetch(url, {
            method: 'POST'
        }).then(response => {
            return response.json();
        }).then(response => {
            if (response.success) {
                this.showSuccessToast(response.message);

                this.stockCounterTarget.textContent = response.inStock;
            } else {
                this.showErrorToast(response.message);
            }
        });
    }

    deleteProduct({params: {url, token}}) {
        const data = new FormData();
        data.append('_token', token);

        fetch(url, {
            method: 'POST',
            body: data
        }).then(response => {
            return response.json();
        }).then(response => {
            this.showSuccessToast(response.message);

            this.productTarget.remove();
        });
    }
}