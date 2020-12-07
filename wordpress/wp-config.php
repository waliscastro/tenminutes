<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wordpress' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'q.C!<k3K/spdPSB7UJ9JJt]L }v(]`Sy8Lqd&#b]u[DiB1t<486aN5~U(KC}r/w1' );
define( 'SECURE_AUTH_KEY',  'oEAT$C@*so8s]3_9B+K!0!.9+CIZ~{F{iCKWVm(6cX.cpIQIUW0%jBNHiJ3|2%Q:' );
define( 'LOGGED_IN_KEY',    'V1@47o%yu-= ELzivHwp3P$M6{cys0$|QcXgsC[Qt9G<`>>8D<LyJN+.(=fbo#wo' );
define( 'NONCE_KEY',        'pBeC`*04YQ=Y;QetK/p_#)h>F2oLBp?Z~r2EVZ*;A&YMKp4F@|jR uIIWf~5L;pD' );
define( 'AUTH_SALT',        'fFev^hUjPWa9%olYQ8%nR?F&,#~JsHR_kOGg3&b-8vGM1`JMi6]g){jK>(C.m^[}' );
define( 'SECURE_AUTH_SALT', '>56#*Wu[(4@Zfdm+7ySJ#2{weA>`%3F5K[xdJ%OcL8pa>MR!#}5GtVPU^9]?(J:t' );
define( 'LOGGED_IN_SALT',   'Ehmx&yP>K/im4:X>wp U5oC=/]T#l* ,MYh3,g(FeS22e`-Z$n=wH1hg&gOIZ%/2' );
define( 'NONCE_SALT',       'KE{f1{_A#GD,7* .AGN:snfbR+-Ce z~;aK(74^@O%ZOFhMmL|Jp6jEVoN!]):fg' );


/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
