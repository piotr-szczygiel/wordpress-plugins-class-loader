<?php
namespace YourSamplePlugin\Src\Services\Vendor;

/**
 * ClassLoader library for WordPress plugins. It requires namespaces implemented in your plugin.
 * Please read README.md to get more info about the usage.
 *
 * Class ClassLoader
 * @package YourSamplePlugin\Src\Services\Vendor
 * @version 1.0
 * @link https://github.com/piotr-szczygiel/wordpress-plugins-class-loader
 */
class ClassLoader
{
    /**
     * @var string
     */
    private $pluginPath;

    /**
     * First part of the namespace. This part will be removed while loading the classes.
     * Usually it's not the directory name, so that's why it needs to be omitted.
     * @var string
     */
    private $namespacePrefix;

    /**
     * @param string $pluginPath
     * @param string $namespacePrefix
     */
    public function __construct($pluginPath, $namespacePrefix)
    {
        $this->pluginPath = $pluginPath;
        $this->namespacePrefix = $namespacePrefix;
    }

    /**
     * Method enabled the loader
     * @returns $this
     */
    public function register()
    {
        spl_autoload_register( array( $this, 'startAutoload' ) );

        return $this;
    }

    /**
     * Function loads automatically all the classes that are called from inside the template
     * @param $className
     */
    public function startAutoload( $className )
    {
        $classPath = str_replace($this->namespacePrefix.'\\', '', $className);
        $classPath = str_replace('\\', '/', $classPath);
        $fullPath = $this->pluginPath . $classPath . '.php';

        if ( file_exists( $fullPath ) ) {

            require_once( $fullPath );
        }
    }
}