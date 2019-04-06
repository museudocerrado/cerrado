<?php
/**
 * Gallery 1 class.
 *
 */
class PRESSCORE_Inc_Classes_Gallery1 {

	var $attachments = array();
	var $options = array();
	var $default_options = array(
		'links_custom' = '',
	);

	/**
	 * Constructor.
	 *
	 */
	__construct( $data = array() ) {

		// init
		if ( !empty($data['attachments']) ) {
			$this->attachments = $data['attachments'];
		}

		if ( !empty($data['options']) ) {
			$this->options = wp_parse_args( $data['options'], $this->default_options );
		}

	}

}
