<?php
define('DB_NAME', 'u259071589_novo');
define('DB_USER', 'u259071589_novo');
define('DB_PASSWORD', 'bAto7KJJcQtH');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('AUTH_KEY',         '4-5p-)7-x]|}=S.b[-:pg1CxweFV7X}&Ku sIpTNd/kW23Yn.6KIj 2mE|:U8#VI');
define('SECURE_AUTH_KEY',  '~>H;1V!+0R8t3BY9lp8:<`jys,}f|LaE-{5,9LIcThxwRQe8 VH-`4)IFCikC5Vg');
define('LOGGED_IN_KEY',    't.BPtnqj&v=aG-*1htyr{#e36Tf_qd-l:<Wdxjuy?<w(%p<nm_60_92#{W~[gF0d');
define('NONCE_KEY',        ':&x+b9)fS?jG67oxs3G)U+|{#i@|;G6K<e1mjhoiNre7`XSwD]w(tu*#m`(|rMW+');
define('AUTH_SALT',        'fE)+=SCeXMO.6->#+G4{5~z{ig[Bo5rx_Iil0k=|(o)&^6,42>M*$1cxBH|v%3rW');
define('SECURE_AUTH_SALT', 'CfM:&!t+.K0Y3us|R5JYJg[ejzC:1^|(^r&PaL8Ab~du%DUYgjeY3;a98,tb8vPP');
define('LOGGED_IN_SALT',   '&s>{ qUc(p-8W4m0UaP/Y@>6PV||q^-YbP9IoU+52W.V5p)xiOM_oa(DmdkzVr*8');
define('NONCE_SALT',       '~{WL<![W-GMu/$32!Vo#DR/S5c]4]#l#[o,4*fFXJ=<j6EK$nO-@HH%.8+sn`bjP');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
