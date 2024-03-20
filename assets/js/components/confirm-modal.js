import { showSuccessToast } from './toast';
import { Modal } from 'bootstrap';

let sourceElement= '';

export default class ConfirmModal {
    confirmBtn = document.querySelectorAll('.trigger-confirm-modal-btn');
    modal = document.getElementById('confirm-modal');
    modalConfirmBtn = document.getElementById('confirm-btn');

    shouldRun() {
        return this.confirmBtn && this.modal && this.modalConfirmBtn;
    }

    constructor() {
        if (this.shouldRun()) {
            this.confirmBtn.forEach(element => {
                element.addEventListener('click', this.onModalShow);
            });

            this.modal.addEventListener('hide.bs.modal', this.onModalHide);

            this.modalConfirmBtn.addEventListener('click', this.postAction);
        }
    }

    onModalShow = (event) => {
        const target = event.currentTarget;
        const path = target.getAttribute('data-path');
        const token = target.getAttribute('data-token');

        this.modalConfirmBtn.setAttribute('data-path', path);
        this.modalConfirmBtn.setAttribute('data-token', token);

        sourceElement = target;
    }

    onModalHide = () => {
        this.modalConfirmBtn.removeAttribute('data-path');
        this.modalConfirmBtn.removeAttribute('data-token');
    }

    postAction = (event) => {
        const target = event.currentTarget;
        const path = target.getAttribute('data-path');
        const token = target.getAttribute('data-token');

        const data = new FormData();
        data.append('_token', token);

        fetch(path, {
            method: 'POST',
            body: data
        }).then(response => {
            return response.json();
        }).then(data => {
            if (data.message) {
                showSuccessToast(data.message);
            }

            this.fireSuccessEvent();
            this.hideModal();
        });
    }

    hideModal() {
        Modal.getOrCreateInstance(this.modal).hide();
    }

    fireSuccessEvent() {
        document.dispatchEvent(new CustomEvent('afterSuccessConfirmAction', {
            detail: {
                sourceElement: sourceElement,
            }
        }));
    }
}