export class Accordion {
    constructor(selector) {
        this.items = document.querySelectorAll(`${selector} button`);

        if (!this.items.length) {
            console.warn(`No elements found for selector: ${selector}`);
            return;
        }

        this.addEventListeners();
    }

    toggleAccordion(target) {
        const itemToggle = target.getAttribute('aria-expanded');

        // Закрываем все элементы
        this.items.forEach(item => item.setAttribute('aria-expanded', 'false'));

        // Открываем текущий элемент, если он был закрыт
        if (itemToggle === 'false') {
            target.setAttribute('aria-expanded', 'true');
        }
    }

    addEventListeners() {
        if (this.items.length) {
            console.log(`Found ${this.items.length} items:`, this.items);
            this.items.forEach(item => {
                item.addEventListener('click', (event) => this.toggleAccordion(event.target));
            });
        } else {
            console.warn('No accordion items to add event listeners.');
        }
    }
}
