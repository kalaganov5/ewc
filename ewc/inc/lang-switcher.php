<?php

/**
 * https://polylang.pro/doc/function-reference/#pll_the_languages
 * polylang output fn
 */

function lang_switcher($class_list_name)
{
    if (function_exists('pll_the_languages')) {
        $translations = pll_the_languages(array('raw' => 1));

        $lang_name = [
            'en' => 'EN',
            'de' => 'DE',
            'es' => 'ES',
            'fr' => 'FR',
            'ru' => 'RU',
        ]
?>
        <button class="language-switcher__button" type="button" data-ui-toggle="lang-dropdown">
            <?php
            echo $lang_name[pll_current_language()] ?>
            <svg width="9" height="5">
                <use xlink:href="#icon-chevron"></use>
            </svg>
        </button>
        <ul class="language-switcher <?php
                                        echo $class_list_name ?>" id="lang-dropdown">
            <?php
            foreach ($translations as &$translation) : ?>

                <?php
                if (! $translation['current_lang']) : ?>
                    <li class="language-switcher__item">

                        <a href="<?php
                                    echo $translation['url'] ?>" class="language-switcher__link" lang="<?php
                                                                                                        echo $translation['locale'] ?>">
                            <?php
                            echo $lang_name[$translation['slug']] ?> <span class="screen-reader-text"><?php
                                                                                                        echo $translation['name'] ?></span>
                        </a>
                    </li>
                <?php
                endif; ?>
            <?php
            endforeach; ?>
        </ul>
<?php
    }
}
