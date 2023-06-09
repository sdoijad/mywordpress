<?php

/**
 * @package Duplicator\Installer
 */

namespace Duplicator\Installer\Bootstrap;

use Duplicator\Libs\Shell\Shell;
use Exception;
use ZipArchive;

class BootstrapUtils
{
    /**
     * Check if php.ini value is changeable
     *
     * @param string $setting php setting
     *
     * @return bool
     */
    public static function isIniValChangeable($setting)
    {
        static $ini_all;
        if (!isset($ini_all)) {
            $ini_all = false;
            // Sometimes `ini_get_all()` is disabled via the `disable_functions` option for "security purposes".
            if (function_exists('ini_get_all')) {
                $ini_all = ini_get_all();
            }
        }
        if (isset($ini_all[$setting]['access']) && ( INI_ALL === ( $ini_all[$setting]['access'] & 7 ) || INI_USER === ( $ini_all[$setting]['access'] & 7 ) )) {
            return true;
        }
        if (!is_array($ini_all)) {
            return true;
        }
        return false;
    }

    /**
     * Check php version
     *
     * @param string $minPhpVer PHP minimum version required

     * @return void
     */
    public static function phpVersionCheck($minPhpVer)
    {
        if (version_compare(PHP_VERSION, $minPhpVer, '>=')) {
            return true;
        }

        $match = null;
        if (preg_match("#^\d+(\.\d+)*#", PHP_VERSION, $match)) {
            $phpVersion = $match[0];
        } else {
            $phpVersion = PHP_VERSION;
        }
        ?><!DOCTYPE html>
            <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <meta name="robots" content="noindex,nofollow">
                    <title>Duplicator Professional - issue</title>
                </head>
                <body>
                    <div>
                        <h1>DUPLICATOR PRO ISSUE: PHP <?php echo $minPhpVer; ?> REQUIRED</h1>
                        <p>
                            This server is running PHP: <b><?php echo $phpVersion; ?></b>. <i>A minimum of <b>PHP 
                        <?php echo $minPhpVer; ?></b> is required</i>.<br><br>
                            <b>Contact your hosting provider or server administrator and let them know you would like to upgrade your PHP version.</b>
                        </p>
                    </div>
                </body>
            </html>
            <?php
            die();
    }

    /**
     * Get libzip version
     *
     * @return string
     */
    public static function getLibzipVersion()
    {
        static $zlibVersion =  null;

        if (is_null($zlibVersion)) {
            ob_start();
            if (function_exists('phpinfo')) {
                phpinfo(INFO_MODULES);
            }
            $info = ob_get_clean();

            if (preg_match('/<td\s.*?>\s*(libzip.*\sver.+?)\s*<\/td>\s*<td\s.*?>\s*(.+?)\s*<\/td>/i', $info, $matches) !== 1) {
                $zlibVersion = "0";
            } else {
                $zlibVersion = $matches[2];
            }
        }

        return $zlibVersion;
    }

    /**
     * Check if zip archive is encrypted
     *
     * @param string $path        zip archive path
     * @param string $fileToCheck fil path to check (must be a existing file in archive)
     *
     * @return bool
     */
    public static function isZipArchiveEncrypted($path, $fileToCheck)
    {
        $zip = new ZipArchive();

        if (($zipOpenRes = $zip->open($path)) !== true) {
            $message = "[ERROR] Couldn't open archive archive file with ZipArchive CODE[" . $zipOpenRes . "]";
            throw new Exception($message);
        }

        if (($stats = $zip->statName($fileToCheck, ZipArchive::FL_NODIR))  == false) {
            throw new Exception('Formatting archive error, cannot find file ' . $fileToCheck);
        }

        if (isset($stats['encryption_method'])) {
            // Before PHP 7.2 encryption_method don't exsts
            $isEncrypt = ($stats['encryption_method'] > 0);
        } else {
            $isEncrypt = ($zip->getFromIndex($stats['index']) === false);
        }

        $zip->close();
        return $isEncrypt;
    }


    /**
     * Get current url
     *
     * @param bool $queryString       If true the query string will also be returned.
     * @param bool $requestUri        if true check request uri
     * @param int  $getParentDirLevel if 0 get current script name or parent folder, if 1 parent folder if 2 parent of parent folder ...
     *
     * @return string
     */
    public static function getCurrentUrl($queryString = true, $requestUri = false, $getParentDirLevel = 0)
    {
        // *** HOST
        if (isset($_SERVER['HTTP_X_ORIGINAL_HOST'])) {
            $host = $_SERVER['HTTP_X_ORIGINAL_HOST'];
        } else {
            $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']; //WAS SERVER_NAME and caused problems on some boxes
        }

        // *** PROTOCOL
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            $_SERVER ['HTTPS'] = 'on';
        }
        if (isset($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'https') {
            $_SERVER ['HTTPS'] = 'on';
        }
        if (isset($_SERVER['HTTP_CF_VISITOR'])) {
            $visitor = json_decode($_SERVER['HTTP_CF_VISITOR']);
            if (is_object($visitor) && property_exists($visitor, 'scheme') && $visitor->scheme == 'https') {
                $_SERVER ['HTTPS'] = 'on';
            }
        }
        $protocol = 'http' . ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) === 'on') ? 's' : '');

        if ($requestUri) {
            $serverUrlSelf = preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']);
        } else {
            // *** SCRIPT NAME
            $serverUrlSelf = $_SERVER['SCRIPT_NAME'];
            for ($i = 0; $i < $getParentDirLevel; $i++) {
                $serverUrlSelf = preg_match('/^[\\\\\/]?$/', dirname($serverUrlSelf)) ? '' : dirname($serverUrlSelf);
            }
        }

        // *** QUERY STRING
        $query = ($queryString && isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0 ) ? '?' . $_SERVER['QUERY_STRING'] : '';

        return $protocol . '://' . $host . $serverUrlSelf . $query;
    }

    /**
     * this function make a chmod only if the are different from perms input and if chmod function is enabled
     *
     * this function handles the variable MODE in a way similar to the chmod of lunux
     * So the MODE variable can be
     * 1) an octal number (0755)
     * 2) a string that defines an octal number ("644")
     * 3) a string with the following format [ugoa]*([-+=]([rwx]*)+
     *
     * examples
     * u+rw         add read and write at the user
     * u+rw,uo-wx   add read and write ad the user and remove wx at groupd and other
     * a=rw         is equal at 666
     * u=rwx,go-rwx is equal at 700
     *
     * @param string     $file file path
     * @param int|string $mode mode
     *
     * @return boolean
     */
    public static function chmod($file, $mode)
    {
        if (!file_exists($file)) {
            return false;
        }

        $octalMode = 0;

        if (is_int($mode)) {
            $octalMode = $mode;
        } elseif (is_string($mode)) {
            $mode = trim($mode);
            if (preg_match('/([0-7]{1,3})/', $mode)) {
                $octalMode = intval(('0' . $mode), 8);
            } elseif (preg_match_all('/(a|[ugo]{1,3})([-=+])([rwx]{1,3})/', $mode, $gMatch, PREG_SET_ORDER)) {
                if (!function_exists('fileperms')) {
                    return false;
                }

                // start by file permission
                $octalMode = (fileperms($file) & 0777);

                foreach ($gMatch as $matches) {
                    // [ugo] or a = ugo
                    $group = $matches[1];
                    if ($group === 'a') {
                        $group = 'ugo';
                    }
                    // can be + - =
                    $action = $matches[2];
                    // [rwx]
                    $gPerms = $matches[3];

                    // reset octal group perms
                    $octalGroupMode = 0;

                    // Init sub perms
                    $subPerm  = 0;
                    $subPerm += strpos($gPerms, 'x') !== false ? 1 : 0; // mask 001
                    $subPerm += strpos($gPerms, 'w') !== false ? 2 : 0; // mask 010
                    $subPerm += strpos($gPerms, 'r') !== false ? 4 : 0; // mask 100

                    $ugoLen = strlen($group);

                    if ($action === '=') {
                        // generate octal group permsissions and ugo mask invert
                        $ugoMaskInvert = 0777;
                        for ($i = 0; $i < $ugoLen; $i++) {
                            switch ($group[$i]) {
                                case 'u':
                                    $octalGroupMode = $octalGroupMode | $subPerm << 6; // mask xxx000000
                                    $ugoMaskInvert  = $ugoMaskInvert & 077;
                                    break;
                                case 'g':
                                    $octalGroupMode = $octalGroupMode | $subPerm << 3; // mask 000xxx000
                                    $ugoMaskInvert  = $ugoMaskInvert & 0707;
                                    break;
                                case 'o':
                                    $octalGroupMode = $octalGroupMode | $subPerm; // mask 000000xxx
                                    $ugoMaskInvert  = $ugoMaskInvert & 0770;
                                    break;
                            }
                        }
                        // apply = action
                        $octalMode = $octalMode & ($ugoMaskInvert | $octalGroupMode);
                    } else {
                        // generate octal group permsissions
                        for ($i = 0; $i < $ugoLen; $i++) {
                            switch ($group[$i]) {
                                case 'u':
                                    $octalGroupMode = $octalGroupMode | $subPerm << 6; // mask xxx000000
                                    break;
                                case 'g':
                                    $octalGroupMode = $octalGroupMode | $subPerm << 3; // mask 000xxx000
                                    break;
                                case 'o':
                                    $octalGroupMode = $octalGroupMode | $subPerm; // mask 000000xxx
                                    break;
                            }
                        }
                        // apply + or - action
                        switch ($action) {
                            case '+':
                                $octalMode = $octalMode | $octalGroupMode;
                                break;
                            case '-':
                                $octalMode = $octalMode & ~$octalGroupMode;
                                break;
                        }
                    }
                }
            }
        }

        // if input permissions are equal at file permissions return true without performing chmod
        if (function_exists('fileperms') && $octalMode === (fileperms($file) & 0777)) {
            return true;
        }

        if (!function_exists('chmod')) {
            return false;
        }

        return @chmod($file, $octalMode);
    }

    /**
     * this function creates a folder if it does not exist and performs a chmod.
     * it is different from the normal mkdir function to which an umask is applied to the input permissions.
     *
     * this function handles the variable MODE in a way similar to the chmod of lunux
     * So the MODE variable can be
     * 1) an octal number (0755)
     * 2) a string that defines an octal number ("644")
     * 3) a string with the following format [ugoa]*([-+=]([rwx]*)+
     *
     * @param string     $path      folder path
     * @param int|string $mode      mode permissions
     * @param bool       $recursive Allows the creation of nested directories specified in the pathname. Default to false.
     * @param resource   $context   not used for windows bug
     *
     * @return boolean bool TRUE on success or FALSE on failure.
     *
     * @todo check recursive true and multiple chmod
     */
    public static function mkdir($path, $mode = 0777, $recursive = false, $context = null)
    {
        if (strlen($path) > PHP_MAXPATHLEN) {
            throw new Exception('Skipping a file that exceeds allowed max path length [' . PHP_MAXPATHLEN . ']. File: ' . $path);
        }

        if (!file_exists($path)) {
            if (!function_exists('mkdir')) {
                return false;
            }
            if (!@mkdir($path, 0777, $recursive)) {
                return false;
            }
        }

        return self::chmod($path, $mode);
    }

    /**
     * Checks to see if a string starts with specific characters
     *
     * @param string $haystack haystack
     * @param string $needle   needle
     *
     * @return bool
     */
    public static function startsWith($haystack, $needle)
    {
        return $needle === "" || strrpos($haystack, $needle, - strlen($haystack)) !== false;
    }

    /**
     * Checks to see if the server supports issuing commands to shell_exex
     *
     * @return bool     Returns true shell_exec can be ran on this server
     */
    public static function hasShellExec()
    {
        if (!Shell::test()) {
            return false;
        }
        return true;
    }

    /**
     * Gets the possible system commands for unzip on Linux
     *
     * @return bool|string Returns unzip file path that can execute the unzip command of false if don't exists
     */
    public static function getUnzipFilePath()
    {
        static $filepath = null;

        if ($filepath === null) {
            if (!self::hasShellExec()) {
                $filepath = false;
            } elseif (Shell::runCommand('hash unzip 2>&1', Shell::AVAILABLE_COMMANDS) !== false) {
                $filepath = 'unzip';
            } else {
                $filepath       = false;
                $possible_paths = array(
                    '/usr/bin/unzip',
                    '/opt/local/bin/unzip',
                    '/bin/unzip',
                    '/usr/local/bin/unzip',
                    '/usr/sfw/bin/unzip',
                    '/usr/xdg4/bin/unzip',
                    '/opt/bin/unzip',
                    // RSR TODO put back in when we support shellexec on windows,
                );

                foreach ($possible_paths as $path) {
                    if (file_exists($path)) {
                        $filepath = $path;
                        break;
                    }
                }
            }
        }

        return $filepath;
    }

    /**
     * Display human readable byte sizes such as 150MB
     *
     * @param int $size The size in bytes
     *
     * @return string A readable byte size format such as 100MB
     */
    public static function readableByteSize($size)
    {
        try {
            $units = array('B', 'KB', 'MB', 'GB', 'TB');
            for ($i = 0; $size >= 1024 && $i < 4; $i++) {
                $size /= 1024;
            }
            return round($size, 2) . $units[$i];
        } catch (Exception $e) {
            return "n/a";
        }
    }

        /**
     * Safely remove a directory and recursively files and directory upto multiple sublevels
     *
     * @param string $path The full path to the directory to remove
     *
     * @return bool Returns true if all content was removed
     */
    public static function rrmdir($path)
    {
        if (is_dir($path)) {
            if (($dh = opendir($path)) === false) {
                return false;
            }
            while (($object = readdir($dh)) !== false) {
                if ($object == "." || $object == "..") {
                    continue;
                }
                if (!self::rrmdir($path . "/" . $object)) {
                    closedir($dh);
                    return false;
                }
            }
            closedir($dh);
            return @rmdir($path);
        } else {
            if (is_writable($path)) {
                return @unlink($path);
            } else {
                return false;
            }
        }
    }

    /**
     *  Makes path safe for any OS for PHP
     *
     *  Paths should ALWAYS READ be "/"
     *      uni:  /home/path/file.txt
     *      win:  D:/home/path/file.txt
     *
     *  @param string $path TThe path to make safe
     *
     *  @return string The original $path with a with all slashes facing '/'.
     */
    public static function setSafePath($path)
    {
        return str_replace("\\", "/", $path);
    }

        /**
     * remove all non stamp chars from string and newline
     * trim string
     *
     * @param string $string input string
     *
     * @return string
     */
    public static function sanitizeNSCharsNewline($string)
    {
        return preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F\r\n]/u', '', (string) $string);
    }

    /**
     * Get HASH to check
     *
     * @return string
     */
    public static function getBridgeHash()
    {
        $key  = 'qLtOw7WpuK';
        $key .= (defined('DB_NAME') ? DB_NAME : '');
        $key .= (defined('DB_USER') ? DB_USER : '');
        $key .= (defined('DB_PASSWORD') ? DB_PASSWORD : '');
        $key .= (defined('DB_HOST') ? DB_HOST : '');
        $key .= '89aEO7NVO0';
        return md5($key);
    }
}