<?php

/*
 * Создание страницы настроек темы
 */
function ewc_settings_page()
{
    add_theme_page(
        __('Настройки темы', 'ewc'),
        __('Настройки темы', 'ewc'),
        'manage_options',
        'ewc-theme-settings',
        'ewc_settings_callback'
    );
}

add_action('admin_menu', 'ewc_settings_page');

/*
 * Callback-функция для отображения настроек темы
 */
function ewc_settings_callback()
{
    // Проверяем, была ли форма отправлена
    if (isset($_POST['submit'])) {
        // Выводим сообщение об успешном сохранении настроек
        echo '<div class="notice notice-success"><p>';
        esc_html_e('Настройки успешно сохранены.', 'ewc');
        echo '</p></div>';

        // Сохраняем данные
        ewc_save_settings();
    }
?>
    <div class="wrap">
        <h1><?php
            esc_html_e('Настройки темы', 'ewc'); ?></h1>
        <form method="post" action="">
            <?php
            settings_fields('ewc_theme_settings');
            do_settings_sections('ewc-theme-settings');
            submit_button(__('Сохранить настройки', 'ewc'), 'primary', 'submit', true);
            ?>
        </form>
    </div>
<?php
}

/*
 * Регистрация настроек темы
 */
function ewc_settings_register()
{
    // Регистрация секции настроек
    add_settings_section(
        'ewc_theme_general_settings',
        __('Общие настройки', 'ewc'),
        'ewc_theme_general_settings_callback',
        'ewc-theme-settings'
    );

    add_settings_section(
        'ewc_theme_contact_settings',
        __('Контакты', 'ewc'),
        'ewc_theme_contact_settings_callback',
        'ewc-theme-settings'
    );

    // Регистрация секции настроек социальных сетей
    add_settings_section(
        'ewc_theme_social_settings',
        __('Социальные сети', 'ewc'),
        'ewc_theme_social_settings_callback',
        'ewc-theme-settings'
    );

    // Регистрация полей настроек контакты
    $fields_contact = [
        [
            'id'          => 'contact_form_id',
            'label'       => __('Форма связаться', 'ewc'),
            'callback'    => 'ewc_text_field_callback',
            'section'     => 'ewc_theme_general_settings',
            'description' => __('ID контактной формы CF7 для связи', 'ewc'),
        ]
    ];

    foreach ($fields_contact as $field) {
        add_settings_field(
            'ewc_theme_' . $field['id'],
            $field['label'],
            'ewc_text_field_callback',
            'ewc-theme-settings',
            $field['section'],
            $field
        );
    }

    // Регистрация полей настроек социальных сетей
    $fields_social = [
        [
            'id'          => 'vk_url',
            'label'       => __('Ссылка VK', 'ewc'),
            'callback'    => 'ewc_text_field_callback',
            'section'     => 'ewc_theme_social_settings',
            'description' => __('Введите ссылку на VK', 'ewc'),
        ],
    ];

    foreach ($fields_social as $field) {
        add_settings_field(
            'ewc_theme_' . $field['id'],
            $field['label'],
            'ewc_text_field_callback',
            'ewc-theme-settings',
            $field['section'],
            $field
        );
    }

    // Регистрация группы настроек
    register_setting(
        'ewc_theme_settings',
        'ewc_theme_general_options',
        'ewc_sanitize_general_options'
    );
    register_setting('ewc_theme_settings', 'ewc_theme_social_options', 'ewc_sanitize_social_options');
}

add_action('admin_init', 'ewc_settings_register');

/*
 * Callback-функция для отображения секции настроек
 */
function ewc_theme_general_settings_callback()
{
    esc_html_e('Настройки общих опций темы', 'ewc');
}

/*
 * Callback-функция для отображения секции настроек контактов
 */
function ewc_theme_contact_settings_callback()
{
    esc_html_e('Настройки контактных данных', 'ewc');
}

/*
 * Callback-функция для отображения текстового поля
 */
function ewc_text_field_callback($args)
{
    $options = get_option('ewc_theme_general_options');
    $value   = isset($options[$args['id']]) ? $options[$args['id']] : '';

    printf(
        '<input type="text" name="ewc_theme_general_options[%1$s]" value="%2$s">',
        esc_attr($args['id']),
        esc_attr($value)
    );

    printf(
        '<p class="description">%s</p>',
        esc_html($args['description'])
    );
}


/*
 * Функция обратного вызова для очистки и проверки введенных значений общих настроек
 */
function ewc_sanitize_general_options($input)
{
    $sanitized_input = [];

    foreach ($input as $key => $value) {
        $sanitized_input[$key] = sanitize_text_field($value);
    }

    return $sanitized_input;
}

/*
 * Callback-функция для отображения секции настроек социальных сетей
 */
function ewc_theme_social_settings_callback()
{
    esc_html_e('Добавьте ссылки на социальные сети (включая https://):', 'ewc');
}

/*
 * Функция обратного вызова для очистки и проверки введенных значений социальных сетей
 */
function ewc_sanitize_social_options($input)
{
    $sanitized_input = [];

    foreach ($input as $key => $value) {
        $sanitized_input[$key] = esc_url_raw($value);
    }

    return $sanitized_input;
}

/*
 * Сохранение данных
 */
function ewc_save_settings()
{
    if (isset($_POST['ewc_theme_general_options'])) {
        $general_options = $_POST['ewc_theme_general_options'];
        update_option('ewc_theme_general_options', $general_options);
    }

    if (isset($_POST['ewc_theme_social_options'])) {
        $social_options = $_POST['ewc_theme_social_options'];
        update_option('ewc_theme_social_options', $social_options);
    }
}
