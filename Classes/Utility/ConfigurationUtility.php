<?php
namespace Keizer\KoningInstagram\Utility;

/**
 * Utility: Configuration
 *
 * @package Keizer\KoningInstagram\Utility
 */
class ConfigurationUtility
{

    /**
     * Check if Instagram configuration is rightly configured
     *
     * @return boolean
     */
    public static function isValid()
    {
        $settings = static::getInstagramSettings();
        return (is_array($settings) && !empty($settings['clientId']) && !empty($settings['clientSecret']));
    }

    /**
     * Get instagram credentials
     *
     * @return array
     */
    public static function getInstagramSettings()
    {
        $configuration = static::getConfiguration();
        return (isset($configuration['instagram']) ? $configuration['instagram'] : $configuration['instagram.']);
    }

    /**
     * Get global configuration
     *
     * @return array
     */
    public static function getConfiguration()
    {
        static $configuration;
        if ($configuration === null) {
            $data = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['koning_instagram'];
            if (!is_array($data)) {
                $configuration = (array) unserialize($data);
            } else {
                $configuration = $data;
            }
        }

        return $configuration;
    }
}