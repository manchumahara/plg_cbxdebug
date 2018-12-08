<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.CBXDebug
 *
 * @copyright   Copyright (C) 2018 Codeboxr.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

/**
 * CBXDebug plugin.
 *
 * @since  1.0.0
 */
class PlgSystemCBXDebug extends JPlugin
{
	/**
	 * Constructor.
	 *
	 * @param   object  &$subject  The object to observe.
	 * @param   array   $config    An optional associative array of configuration settings.
	 *
	 * @since   1.5
	 */
	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);

	}

	/**
	 * Add the CSS for debug.
	 * We can't do this in the constructor because stuff breaks.
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	public function onAfterInitialise(){
		$this->init_log();
	}//end method onAfterInitialise

    /**
     * Init error log
     *
     * This method is almost copied from wordpress :)
     *
     * @since version
     * @throws Exception
     */
	public function init_log(){

		$WP_DEBUG = intval($this->params->get('enable_debug', 0));
		$WP_DEBUG_DISPLAY = intval($this->params->get('display_error', 0));
		$WP_DEBUG_LOG = intval($this->params->get('log_error', 0));

		$app    = JFactory::getApplication();


		$file   = $app->get('log_path') . '/debug.log';

		if ( $WP_DEBUG ) {
			error_reporting( E_ALL );

			if ( $WP_DEBUG_DISPLAY )
				ini_set( 'display_errors', 1 );
			elseif ( null !== $WP_DEBUG_DISPLAY )
				ini_set( 'display_errors', 0 );

			if ( $WP_DEBUG_LOG ) {
				ini_set( 'log_errors', 1 );
				//ini_set( 'error_log', WP_CONTENT_DIR . '/debug.log' );
				ini_set( 'error_log', $file );
			}
		} else {
			error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
		}
	}//end method init_log

}//end class PlgSystemCBXDebug
