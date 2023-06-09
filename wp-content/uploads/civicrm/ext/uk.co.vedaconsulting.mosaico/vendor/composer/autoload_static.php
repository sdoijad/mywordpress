<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite358e00eab491ffb98725c35dadd8bfb
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LastCall\\DownloadsPlugin\\' => 25,
        ),
        'I' => 
        array (
            'Intervention\\Image\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LastCall\\DownloadsPlugin\\' => 
        array (
            0 => __DIR__ . '/..' . '/civicrm/composer-downloads-plugin/src',
        ),
        'Intervention\\Image\\' => 
        array (
            0 => __DIR__ . '/..' . '/intervention/image/src/Intervention/Image',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'TOGoS_GitIgnore_' => 
            array (
                0 => __DIR__ . '/..' . '/togos/gitignore/src/main/php',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite358e00eab491ffb98725c35dadd8bfb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite358e00eab491ffb98725c35dadd8bfb::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInite358e00eab491ffb98725c35dadd8bfb::$prefixesPsr0;
            $loader->classMap = ComposerStaticInite358e00eab491ffb98725c35dadd8bfb::$classMap;

        }, null, ClassLoader::class);
    }
}
