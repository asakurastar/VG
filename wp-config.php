<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', '');

/** Usuário do banco de dados MySQL */
define('DB_USER', '');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', '');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'eZ||,Q}&FQ+q[e3V,[--Xgnm@`4cC~ZW8;&;xPsntRAtB+<ZYZ]eMb;QpoX@Q9g=');
define('SECURE_AUTH_KEY',  'grFA#4-|H#Ed-o-|m&LS+iuX|AW1gbSZg0YHPSE#kw>mzM6^r{SS1v1-9i!m.1tJ');
define('LOGGED_IN_KEY',    '7dLO-0szf`V+|LRAmdNsY1JITagRxP4ld`F0`jC_8c+c$+Gz=%S;82P$/7|F:{<8');
define('NONCE_KEY',        'GxJ2kj,vEDhD}T=m+f!G+|=} sB/L12+W]~M4|Zc.lB[}Q.-1g.?h@+|HNs_Ntye');
define('AUTH_SALT',        '5-eX}qJ-SaaS-v,kEbjD0!7!B{L.V^tl]1cNE%j3>AEyWsy%k/BV[Ze+=4 tH=^O');
define('SECURE_AUTH_SALT', '?Bz&A.6iS.<#1+${c(|L8b,l;C#}mZ||m3D_Z>%lH4i5.7:,1S98NP<LZ)`en/FI');
define('LOGGED_IN_SALT',   '[M+@U-CfIC@so.L8YC-F8@&:yQF,BtVC=iKj|os6SJnR_PAp1RJYH!QQ_F!}WME$');
define('NONCE_SALT',       '|yt~U5k%ZD.0 ++~op7TkHt~wu#1!d|+oE8MunONwgZjOt}nuY!jAtJHICV6F+-2');

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
define('WP_DEBUG', true);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
