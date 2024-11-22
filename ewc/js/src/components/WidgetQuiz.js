// core version + navigation, pagination modules:
import Swiper from "swiper";
// import Swiper and modules styles
import "swiper/scss";

// init Swiper:
export class WidgetQuiz {
  #slider = null;
  #form = null;
  //TODO Прокинуть чтобы объект заполнялся
  #widgetObject = {
    social: null,
    user: null,
    "text-cta": null,
    "text-offer": null,
  };

  // const
  #generatorFormClass = "generator__body";

  init = () => {
    this.#slider = new Swiper(".quiz__wrap", {
      allowTouchMove: false,
      spaceBetween: 40,
      slidesPerView: 1,
      autoHeight: true,
    });
    this.#formRadioHandler();
  };

  #formRadioHandler = () => {
    this.#form = document.querySelector(`.${this.#generatorFormClass}`);
    const radios = this.#form.querySelectorAll('input[type="radio"]');
    const nextButtons = this.#form.querySelectorAll(".next-slide-button");
    const userAccount = this.#form.querySelector('#quiz-social-account');

    console.log(radios);

    for (let i = 0, max = radios.length; i < max; i++) {
      radios[i].addEventListener('change', () => {
        if (radios[i].name === "quiz-social") {
          const socialName = radios[i].value;
          this.#widgetObject.social = socialName;
        }

        if (radios[i].name === "quiz-message") {
          //TODO const socialMessage = radios[i].value;
          // Добавляем в
          //TODO this.#widgetObject["text-cta"] = '';
          //TODO this.#widgetObject["text-offer"] = '';
        }

        setTimeout(() => {
          this.#slider.slideNext();
        }, 500);
      });
      radios[i].onclick = () => {
        
      };
    }

    nextButtons.forEach((element) => {
      element.addEventListener("click", (evt) => {
        evt.preventDefault();
        console.log(userAccount.value.length)
        if (userAccount.value.length > 3) {
          this.#widgetObject.user = userAccount.value;
          this.#slider.slideNext();
        } else {
          userAccount.classList.add('quiz__input--invalid');
          this.#addInputHandler(userAccount);
        }
      });
    });



  };

  #addInputHandler = (input) => {
    input.addEventListener('change', (evt) => {
      if (input.value.length > 3) {
        input.classList.remove('quiz__input--invalid');
      }
    })
  }
}
