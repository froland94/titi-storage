export default class Product {
    constructor() {
        document.addEventListener('afterSuccessConfirmAction', this.removeElement);
    }

    removeElement = (event) => {
        const source = event.detail.sourceElement;

        source.closest('.col').remove();
    }
}