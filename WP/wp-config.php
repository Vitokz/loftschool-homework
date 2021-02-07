<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wdpress' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'root' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'yByhpL cBTwB5x6HW|6MN%T&P`$Bo/=>giR.?!G9=l]?e_0sB3{g/|LhG_#$G[,v' );
define( 'SECURE_AUTH_KEY',  '<Ne$A]8fAF_gScMx[6f+d6+vJU<rf:`*(5y~sACVcQSb~)a;zHgBi|K.QS$*?^mh' );
define( 'LOGGED_IN_KEY',    'tz%r2Bc*PxUA2}$O]03eq`O$gWx(T&$gSwn}AIR^HdvR[6awdl#}MYJoE570;gGw' );
define( 'NONCE_KEY',        '-j=xYQa3)s6_swg8Uy}r2a=.?WwUITQX,2GPSJL)^.Q$>mak8.z)7OeOR_yA%Qc@' );
define( 'AUTH_SALT',        '17DD`qj%BjI(*6@g8IP~OiI_Dlpx;8:u9+|k^:ZL0L<KMpc8WUq$L e#$`d5O8==' );
define( 'SECURE_AUTH_SALT', '*V%Mue3xlG@0T@nRi5<><Pd*TTmrQh%XT%(d-Coi&Q,-Z7DzsW!<[c`B^*^rxc&F' );
define( 'LOGGED_IN_SALT',   '~/b7GdIu^oy~n>|SeX._R;kY,PeL)^}5eN!~F8WV#d0rPOZ=MeuQOEs9+jM^iJ8t' );
define( 'NONCE_SALT',       'W7~-x@CBPbiF0HR9s?A$aNr@|{1o(dcG`@TIz`MZ#~i!m#]{fVeg(a^yfO[CIs&v' );

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
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
