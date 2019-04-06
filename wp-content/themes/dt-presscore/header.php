<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="wf-container wf-clearfix">
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ancient-ie old-ie no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ancient-ie old-ie no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="old-ie no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php if ( dt_retina_on() ) { dt_core_detect_retina_script(); } ?>
	<title><?php echo presscore_blog_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php
	echo dt_get_favicon( of_get_option('general-favicon', '') );

	// tracking code
	if ( ! is_preview() ) {
		echo of_get_option('general-tracking_code', '');
	}
	?>	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page"<?php if ( 'boxed' == of_get_option('general-layout', 'wide') ) echo ' class="boxed"'; ?>>
	
<?php /* Top Bar */ ?>
<?php if ( of_get_option('top_bar-show', 1) ) : ?>
<div id="wfm-top-bar">
	<div class="wf-wrap">
	<div class="wf-table wf-mobile-collapsed" style="padding: 5px 0 !important;">
	<div class="wf-td">
		<img src="<?php echo esc_url( home_url( '/' ) ); ?>/wp-content/uploads/2016/07/logo_unb_neg.png" class="wfm-logo-unb" height="32" height="32">
		<a rel="alternate" href="#">
			<span style="font-size: 12pt; color: #ffffff; font-family: arial,helvetica,sans-serif; padding-left: 15px; top: -3px; position: relative;">Museu Virtual de Ciência e Tecnologia</span>
		</a>
	</div><!-- .wfm-td -->
	<div class="wf-td pull-right">
		<?php
// 			if ( defined('ICL_SITEPRESS_VERSION') ):
// 			   presscore_language_selector_flags();
// 			endif;
		?>
		<!-- GTranslate: http://gtranslate.net/ -->
<a href="#" onclick="doGTranslate('pt|pt');return false;" title="Portuguese" class="gflag nturl" style="background-position:-300px -200px;">
	<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/plugins/gtranslate/blank.png" height="16" width="16" alt="Portuguese" />
</a>
<a href="#" onclick="doGTranslate('pt|en');return false;" title="English" class="gflag nturl" style="background-position:-0px -0px;">
	<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/plugins/gtranslate/blank.png" height="16" width="16" alt="English" />
</a>
<a href="#" onclick="doGTranslate('pt|fr');return false;" title="French" class="gflag nturl" style="background-position:-200px -100px;">
	<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/plugins/gtranslate/blank.png" height="16" width="16" alt="French" />
</a>
<a href="#" onclick="doGTranslate('pt|de');return false;" title="German" class="gflag nturl" style="background-position:-300px -100px;">
	<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/plugins/gtranslate/blank.png" height="16" width="16" alt="German" />
</a>
<a href="#" onclick="doGTranslate('pt|es');return false;" title="Spanish" class="gflag nturl" style="background-position:-600px -200px;">
	<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/plugins/gtranslate/blank.png" height="16" width="16" alt="Spanish" />
</a>
<style type="text/css">
<!--
#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}
body {top:0 !important;}
#google_translate_element2 {display:none!important;}
a.gflag {
    font-size: 11px !important;
    margin-right: 3px;
}
-->
</style>

	<div id="google_translate_element2"></div>
	<script type="text/javascript">
	function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'pt',autoDisplay: false}, 'google_translate_element2');}
	</script><script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
	
	
	<script type="text/javascript">
	/* <![CDATA[ */
	function GTranslateFireEvent(element,event){try{if(document.createEventObject){var evt=document.createEventObject();element.fireEvent('on'+event,evt)}else{var evt=document.createEvent('HTMLEvents');evt.initEvent(event,true,true);element.dispatchEvent(evt)}}catch(e){}}function doGTranslate(lang_pair){if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];var teCombo;var sel=document.getElementsByTagName('select');for(var i=0;i<sel.length;i++)if(sel[i].className=='goog-te-combo')teCombo=sel[i];if(document.getElementById('google_translate_element2')==null||document.getElementById('google_translate_element2').innerHTML.length==0||teCombo.length==0||teCombo.innerHTML.length==0){setTimeout(function(){doGTranslate(lang_pair)},500)}else{teCombo.value=lang;GTranslateFireEvent(teCombo,'change');GTranslateFireEvent(teCombo,'change')}}
	/* ]]> */
	</script>
	</div><!-- .wfm-td -->
	</div><!-- .wfm-table -->
	</div><!-- .wfm-wrap -->
	</div>
<?php endif; ?>

<?php
$config = Presscore_Config::get_instance();
$logo_align = of_get_option( 'header-layout', 'left' );
$header_classes = array( 'logo-' . $logo_align );

// header overlapping handle
if ( in_array( $config->get('header_title'), array('fancy', 'slideshow') ) && 'overlap' == $config->get('header_background') ) {
	$header_classes[] = 'overlap';
}
?><!-- left, center, classical, classic-centered -->
	<!-- !Header -->
	<header id="header" class="<?php echo esc_attr(implode(' ', $header_classes )); ?>" role="banner"><!-- class="overlap"; class="logo-left", class="logo-center", class="logo-classic" -->
		<div class="wf-wrap">
			<div class="wf-table">

<?php if ( 'center' == $logo_align ) : ?>
				<div class="wf-td">
<?php endif; ?>
				
				<!-- !- Branding -->
				<div id="branding"<?php if ( 'center' != $logo_align ) echo ' class="wf-td"'; ?>>
					<?php $logo = presscore_get_logo_image( presscore_get_header_logos_meta() ); ?>
					<?php if ( $logo ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $logo; ?></a>
					<?php endif; ?>
					<div id="site-title" class="assistive-text"><?php bloginfo( 'name' ); ?></div>
					<div id="site-description" class="assistive-text"><?php bloginfo( 'description' ); ?></div>
				</div>
				
<?php if ( 'classic' == $logo_align ) : ?>
			<?php $info = of_get_option('header-contentarea', false);
			if ( $info ) : ?>
				<div class="wf-td assistive-info" role="complementary"><?php echo $info; ?></div>
			<?php endif; ?>
			</div>
		</div>
		<div class="navigation-holder">
			<div>
<?php elseif ( 'classic-centered' == $logo_align ) : ?>
		</div>
	</div>
	<div class="navigation-holder">
		<div>
<?php endif; ?>

				<!-- !- Navigation -->	
				<nav id="navigation"<?php if ( 'left' == $logo_align ) echo ' class="wf-td"'; elseif ( in_array( $logo_align, array('classic', 'classic-centered') ) ) echo ' class="wf-wrap"'; ?>>
					<?php
					dt_menu( array(
						'menu_wraper' 		=> '<ul id="main-nav" class="fancy-rollovers wf-mobile-hidden">%MENU_ITEMS%' . "\n" . '</ul>',
						'menu_items'		=>  "\n" . '<li class="%ITEM_CLASS%"><a href="%ITEM_HREF%">%ITEM_TITLE%</a>%SUBMENU%</li> ',
						'submenu' 			=> '<ul class="sub-nav">%ITEM%</ul>',
						'parent_clicable'	=> of_get_option( 'header-submenu_parent_clickable', true ),
						'params'			=> array( 'act_class' => 'act' ),
					) );
					?>

					<a href="#show-menu" rel="nofollow" id="mobile-menu">
						<span class="menu-open"><?php _e( 'MENU', LANGUAGE_ZONE ); ?></span>
						<span class="menu-close"><?php _e( 'CLOSE', LANGUAGE_ZONE ); ?></span>
						<span class="menu-back"><?php _e( 'back', LANGUAGE_ZONE ); ?></span>
						<span class="wf-phone-visible">&nbsp;</span>
					</a>

				</nav>
<?php if ( 'center' == $logo_align ) : ?>
			</div>
<?php endif; ?>

			</div><!-- .wf-table -->
		</div><!-- .wf-wrap -->
	</header><!-- #masthead -->
	
	<?php do_action( 'presscore_before_main_container' ); ?>

	<div id="main" <?php presscore_main_container_classes(); ?>><!-- class="sidebar-none", class="sidebar-left", class="sidebar-right" -->

<?php if ( presscore_is_content_visible() ): ?>
		
		<div class="wf-wrap">
			<div class="wf-container-main">

<?php endif; ?>