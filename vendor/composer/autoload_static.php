<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite22320441507956b3b6c659ebbe92ec6
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        'a1105708a18b76903365ca1c4aa61b02' => __DIR__ . '/..' . '/symfony/translation/Resources/functions.php',
        'a4ecaeafb8cfb009ad0e052c90355e98' => __DIR__ . '/..' . '/beberlei/assert/lib/Assert/functions.php',
        'e4e590a9b5afe940db71ee1662c02677' => __DIR__ . '/..' . '/morilog/jalali/src/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Contracts\\Translation\\' => 30,
            'Symfony\\Component\\Translation\\' => 30,
        ),
        'M' => 
        array (
            'Morilog\\Jalali\\' => 15,
        ),
        'C' => 
        array (
            'Carbon\\' => 7,
        ),
        'A' => 
        array (
            'Assert\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Contracts\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation-contracts',
        ),
        'Symfony\\Component\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation',
        ),
        'Morilog\\Jalali\\' => 
        array (
            0 => __DIR__ . '/..' . '/morilog/jalali/src',
        ),
        'Carbon\\' => 
        array (
            0 => __DIR__ . '/..' . '/nesbot/carbon/src/Carbon',
        ),
        'Assert\\' => 
        array (
            0 => __DIR__ . '/..' . '/beberlei/assert/lib/Assert',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite22320441507956b3b6c659ebbe92ec6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite22320441507956b3b6c659ebbe92ec6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite22320441507956b3b6c659ebbe92ec6::$classMap;

        }, null, ClassLoader::class);
    }
}
