import { showToast } from '../components/toast';

export default class Product {
    constructor() {
        this.initElements();
        this.initListeners();
    }

    initElements() {
        this.btn = document.querySelectorAll('.product-delete-btn');
    }

    initListeners() {
        this.btn.forEach(element => {
            element.addEventListener('click', this.deleteProduct);
        });
    }

    deleteProduct = (e) => {
        const target = e.currentTarget;
        const route = target.getAttribute('data-route');
        const token = target.getAttribute('data-token');

        const data = new FormData();
        data.append('_token', token);

        fetch(route, {
            method: 'POST',
            body: data
        }).then(response => {
            return response.json();
        }).then(data => {
            showToast(data.message);

            target.closest('.col').remove();
        });
    }
}