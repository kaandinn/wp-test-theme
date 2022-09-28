<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wp' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'wp' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'secret' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'mysql' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '&NZ-gE|tBFCk?j-YY~j2tiH d+<Gmoj-YsUKxLC-=cunH;|v#R*SvUl:Jk*Rq]`Y' );
define( 'SECURE_AUTH_KEY',  '&TUZW;1YM6w8Zq=6!5FiCRlPZqOEGDO|TNFeEyve?-TymE(jca+R$K5s{a.Y(UfG' );
define( 'LOGGED_IN_KEY',    'O{BY*n]CnudyGh6NqX:Ub@xziHZV#rFNO{:xYiCMa5wvl]>5}o!vqV 8FJNJ|%>C' );
define( 'NONCE_KEY',        'vb/<X/>7|1c 94_OYpTC%cEv:!,]z:C2<*Fl7~<xP}F;%(`l#t.rI)kWm/KjY|L$' );
define( 'AUTH_SALT',        'B9Q$tr:`Ml2Hwr0q8D<p(R#.S|G{5FdFBE 7&x8k])@nc OpO:yw2i.ti(iP6]!m' );
define( 'SECURE_AUTH_SALT', '7/3HLuz(,iA]@lJ|fh1KhX+9nv0-Bt<3P]PU|z:2!W;(MtEp>e7mhUHn 1f_t5!x' );
define( 'LOGGED_IN_SALT',   'I4}N0k-axf-8^R6)h^xd)f(_k368,5Zv$:Ov/y uH2M#]*)UxF6q5,p wS8XhkJ<' );
define( 'NONCE_SALT',       'pMm/)H=7C*=T8f*}rFNu?{$10ScNZzv]?12rhGA^qq&vvLdOwWD1|4R@yQ(GFn>5' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';