<?php
namespace Atova\Eshoper\Foundation\Bootstrap;

use Atova\Eshoper\Contract\BootstrapContract;
use Atova\Eshoper\Foundation\Application;
class LoadSession implements BootstrapContract{

    /**
     * Start the session if not already started
     */
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function bootstrap(Application $app) {

        $app->bind("session",$this);
    }

    /**
     * Set a session value
     * 
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * Get a session value
     * 
     * @param string $key
     * @return mixed|null
     */
    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Check if a session key exists
     * 
     * @param string $key
     * @return bool
     */
    public function has($key) {
        return isset($_SESSION[$key]);
    }

    /**
     * Remove a session value
     * 
     * @param string $key
     * @return void
     */
    public function remove($key) {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destroy the session completely
     * 
     * @return void
     */
    public function destroy() {
        session_unset();   // Unset all session variables
        session_destroy(); // Destroy the session
    }

    /**
     * Regenerate session ID (useful for security)
     * 
     * @param bool $deleteOldSession
     * @return void
     */
    public function regenerate($deleteOldSession = false) {
        session_regenerate_id($deleteOldSession);
    }

    /**
     * Get all session data
     * 
     * @return array
     */
    public function all() {
        return $_SESSION;
    }

    /**
     * Flash a session message (set a message to be available for the next request)
     * 
     * @param string $key
     * @param string $message
     * @return void
     */
    public function flash($key, $message) {
        $this->set($key, $message);
    }

    /**
     * Retrieve and delete a flashed session message
     * 
     * @param string $key
     * @return string|null
     */
    public function getFlash($key) {
        $message = $this->get($key);
        $this->remove($key);
        return $message;
    }
}
