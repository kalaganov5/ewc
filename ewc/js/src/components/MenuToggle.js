export class MenuToggle {
  #menuContainerClass = 'navigation';
  #menuButtonClass = 'hamburger__button';
  #menuButton = document.querySelector(`.${this.#menuButtonClass}`);
  #menuContainer = document.querySelector(`.${this.#menuContainerClass}`);
  #isOpen = false;

  constructor () {
    this.#setHandler();
  }

  #setHandler = () => {
    this.#menuButton.addEventListener('click', this.#toggleNavigation);
  };

  #toggleNavigation = (evt) => {
    evt.preventDefault();
    this.#menuButton.classList.toggle(`${this.#menuButtonClass}--open`);
    this.#menuContainer.classList.toggle(`${this.#menuContainerClass}--open`);

    if (this.#isOpen) {
      this.#isOpen = false;
      return;
    }
    this.#isOpen = true;
  };
}
