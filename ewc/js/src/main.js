import { LangSwitcher } from './components/LangSwitcher';
import { SliderPresentation } from './components/SliderPresentation';
import { WidgetQuiz } from './components/WidgetQuiz';
import { Accordion } from './components/Accordion';
import { MenuToggle } from './components/MenuToggle';

document.addEventListener('DOMContentLoaded', function () {
  new LangSwitcher('[data-ui-toggle="lang-dropdown"]', 'lang-dropdown');
  new SliderPresentation().init();
  new WidgetQuiz().init();
  new Accordion('.accordion');
  new MenuToggle();
});