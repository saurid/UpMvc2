<?php
/**
 * /UpMvc/Autoloader.php
 * 
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Automatisk laddning av klasser för att inte behöva använda include/require.
 *
 * Loadern förutsätter att namespaces används, men det går att lägga till
 * flera namespaces. Detta innebär att du kan lägga till paket som följer PSR-0
 * standarden genom att lägga till namespaces i loadern. Koden är inte unik för
 * Up MVC, utan är hämtad från förslagen standard här:
 * {@link https://github.com/php-fig/fig-standards/blob/master/proposed/psr-4-autoloader/psr-4-autoloader.md}
 * 
 * Startas i index.php (namespace UpMvc) med:
 * <code>$autoloader = new Autoloader();
 * $autoloader->addNamespace('UpMvc', __DIR__ . '/vendor/UpMvc');
 * $autoloader->register();</code>
 * 
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2013.12.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Autoloader
{
    /** @type array Lagrar namespace tillsammans med sökväg. */
    protected $prefixes = array();

    /** Registrera autoloader. */
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * Lägg till namespaceprefix och sökvägen till den.
     *
     * @param string $prefix   Namespaceprefix.
     * @param string $base_dir Sökväg till filerna.
     * @param bool   $prepend  Om true, läggs sökvägen på toppen istället för
     * botten, vilket gör att den söks genom först, istället för sist.
     */
    public function addNamespace($prefix, $base_dir, $prepend = false)
    {
        $prefix = trim($prefix, '\\') . '\\';

        $base_dir = rtrim($base_dir, '/') . DIRECTORY_SEPARATOR;
        $base_dir = rtrim($base_dir, DIRECTORY_SEPARATOR) . '/';

        if (isset($this->prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = array();
        }

        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $base_dir);
        } else {
            array_push($this->prefixes[$prefix], $base_dir);
        }
    }

    /**
     * Ladda in klassen från filsystemet.
     *
     * @param string $class Klassnamn.
     * 
     * @return mixed Filnamn, eller false om filen inte kan laddas.
     */
    public function loadClass($class)
    {
        // Aktuellt namespaceprefix
        $prefix = $class;

        // Letar igen om namespace från slutet för att hitta ett mappat filnamn
        while (false !== $pos = strrpos($prefix, '\\')) {

            $prefix         = substr($class, 0, $pos + 1);
            $relative_class = substr($class, $pos + 1);

            // Försök ladda in mappad fil
            $mapped_file = $this->loadMappedFile($prefix, $relative_class);
            if ($mapped_file) {
                return $mapped_file;
            }

            $prefix = rtrim($prefix, '\\');   
        }

        // Ingen mappad fil hittades
        return false;
    }

    /**
     * Ladda in en mappad fil för valt namespaceprefix.
     * 
     * @param string $prefix         Namespaceprefix.
     * @param string $relative_class Relativt klassnamn.
     * 
     * @return mixed Boolean Filnamn, eller false om filen inte kan laddas.
     */
    protected function loadMappedFile($prefix, $relative_class)
    {
        // Leta igenom sökvägar efter namespaceprefix
        if (isset($this->prefixes[$prefix]) === false) {
            return false;
        }

        // Loopa igenom sökvägar och efta efter namespaceprefix
        foreach ($this->prefixes[$prefix] as $base_dir) {

            // Byt ut namespaceprefix mot sökväg, namespaceseparator till
            // mappseparator och lägg till .php.
            $file = $base_dir
                  . str_replace('\\', DIRECTORY_SEPARATOR, $relative_class)
                  . '.php';
            $file = $base_dir
                  . str_replace('\\', '/', $relative_class)
                  . '.php';

            // Hämta fil från filsystemet
            if ($this->requireFile($file)) {
                return $file;
            }
        }

        // Filen hittades inte
        return false;
    }

    /**
     * Om en fil finns, hämta den från filsystemet.
     * 
     * @param string $file Filen som ska inkluderas.
     * 
     * @return bool True om filen finns, annars false.
     */
    protected function requireFile($file)
    {
        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    }
}
