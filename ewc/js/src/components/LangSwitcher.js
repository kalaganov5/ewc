export class LangSwitcher {
  constructor(langToggleSelector, langDropdownId) {
    this.langToggle = document.querySelector(langToggleSelector);
    this.langDropdown = document.getElementById(langDropdownId);
    this.dropdownVisible = false;

    this.toggleDropdown = this.toggleDropdown.bind(this);
    this.showDropdown = this.showDropdown.bind(this);
    this.hideDropdown = this.hideDropdown.bind(this);
    this.isClickWithout = this.isClickWithout.bind(this);

    this.langToggle.addEventListener('click', this.toggleDropdown);
  }

  toggleDropdown() {
    if (this.dropdownVisible) {
      this.hideDropdown();
    } else {
      this.showDropdown();
    }
  }

  showDropdown() {
    this.langDropdown.classList.add('show');
    this.dropdownVisible = true;
    window.addEventListener('click', this.isClickWithout);

    this.langToggle.classList.add('open');
  }

  hideDropdown() {
    this.langDropdown.classList.remove('show');
    this.dropdownVisible = false;
    this.langToggle.classList.remove('open');
    window.removeEventListener('click', this.isClickWithout);
  }

  isClickWithout(evt) {
    if (this.dropdownVisible && !this.langToggle.contains(evt.target)) {
      this.hideDropdown();
    }
  }
}
