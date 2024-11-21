// core version + navigation, pagination modules:
import Swiper from "swiper";
import { Navigation } from "swiper/modules";
// import Swiper and modules styles
import "swiper/scss";
import "swiper/scss/navigation";

// init Swiper:
export class SliderPresentation {
    init = () => {
        new Swiper(".presentation__slider", {
            modules: [Navigation],
            slidesPerView: 3,
            spaceBetween: 20,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    };
}
