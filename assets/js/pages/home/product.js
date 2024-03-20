import { showSuccessToast, showErrorToast } from '../../components/toast';

export default class Product {
    addStockBtn = document.querySelectorAll('.add-stock');
    removeStockBtn = document.querySelectorAll('.remove-stock');

    constructor() {
        document.addEventListener('afterSuccessConfirmAction', this.removeElement);

        this.addStockBtn.forEach(element => {
            element.addEventListener('click', this.modifyStock);
        });

        this.removeStockBtn.forEach(element => {
            element.addEventListener('click', this.modifyStock);
        });
    }

    removeElement = (event) => {
        const source = event.detail.sourceElement;

        source.closest('.col').remove();
    }

    modifyStock = (event) => {
        const target = event.currentTarget;
        const path = target.getAttribute('data-path');
        const inStockCounter = target.closest('.card').querySelector('.in-stock');

        fetch(path, {
            method: 'POST',
        }).then(response => {
            return response.json();
        }).then(data => {
            if (data.success) {
                showSuccessToast(data.message);

                inStockCounter.textContent = data.inStock;
            } else {
                showErrorToast(data.message);
            }
        });
    }
}