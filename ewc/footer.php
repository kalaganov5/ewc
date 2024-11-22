<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package easy-connect-widget
 */

?>
<section class="contact" id="contact">
  <div class="container contact__container">
    <h2 class="contact__headline headline">
      Если у вас остались вопросы
    </h2>
    <div class="contact__text">
      Отправьте заявку на обратный звонок и наши специалисты свяжутся с вами в ближайшее время
    </div>
    <div class="contact__form">
      <?php
      // Получаем ID контактной формы из настроек
      $contact_form_id = get_option('ewc_theme_general_options')['contact_form_id'] ?? '';

      // Проверяем, активен ли плагин Contact Form 7 и задан ли ID формы
      if (class_exists('WPCF7') && !empty($contact_form_id)) {
        echo do_shortcode("[contact-form-7 id='$contact_form_id']");
      } else {
        // Вывод сообщения об ошибке или просто ничего
        if (!class_exists('WPCF7')) {
          echo '<p>Плагин Contact Form 7 не активен. Пожалуйста, установите и активируйте его.</p>';
        } elseif (empty($contact_form_id)) {
          echo '<p>ID контактной формы не задан. Проверьте настройки.</p>';
        }
      }
      ?>

    </div>
  </div>
</section>
<footer id="footer" class="footer">
  <div class="footer__container container">
    <div class="footer__top">
      <div class="footer__headline">
        <?php _e('Присоеденяйтесь к&nbsp;нам:', 'ewc'); ?>
      </div>
      <ul class="footer__social social">
        <li class="social__item">
          <a href="#">
            <svg width="89" height="89" class="icon icon--telegram">
              <use xlink:href="#icon-telegram"></use>
            </svg>
          </a>
        </li>
        <li class="social__item">
          <a href="#">
            <svg width="89" height="89" class="icon icon--instagram">
              <use xlink:href="#icon-instagram"></use>
            </svg>
          </a>
        </li>
      </ul>
    </div>
    <div class="footer__main">
      <div class="footer__logo logo">
        <a <?php
            if (! is_front_page() || is_home()) : ?> href="<?php
                                                            echo esc_url(home_url('')); ?>" <?php
                                                                                          endif; ?> class="logo__link">
          <svg class="logo__icon" width="110" height="60">
            <use xlink:href="#main-logo"></use>
          </svg>
        </a>
      </div>
      <div class="footer__navigation navigation">
        <?php
        if (has_nav_menu('main-menu')) { // Проверяем наличие меню с указанным местоположением
          $menu_args = array(
            'theme_location' => 'main-menu',
            'container'      => false,
            'items_wrap'     => '<ul class="navigation__list">%3$s</ul>',
          );
          wp_nav_menu($menu_args);
        }
        ?>
      </div>
    </div>
    <div class="footer__bottom">
      &copy;&nbsp;<?php echo date('Y'); ?>. Easy Connect Widget
    </div>
  </div>
</footer>
</div>

<?php wp_footer(); ?>

</body>

</html>