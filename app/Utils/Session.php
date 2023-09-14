<?php

declare(strict_types=1);

namespace App\Utils;

class Session
{
    /**
     * Constructor. Starts a session if not already started.
     */
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Regenerates the session ID for improved security.
     */
    public function regenerate(): void
    {
        session_regenerate_id();
    }

    /**
     * Destroys the session, including the session data and session ID.
     */
    public function destroy(): void
    {
        session_regenerate_id(); // Regenerate ID for security
        session_destroy();       // Destroy the session
    }

    /**
     * Clears (unsets) all session data.
     */
    public function clear(): void
    {
        session_unset();
    }

    /**
     * Sets a session value for a given key.
     *
     * @param string $key   The key under which to store the value.
     * @param mixed  $value The value to store in the session.
     */
    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Retrieves a session value by its key.
     *
     * @param string $key          The key of the value to retrieve.
     * @param mixed  $defaultValue The default value to return if the key does not exist.
     *
     * @return mixed The session value or the default value if the key does not exist.
     */
    public function get(string $key = null, mixed $defaultValue = null): mixed
    {
        if ($key === null) {
            return $_SESSION; // Return all session data if no key is specified
        }

        return isset($_SESSION[$key]) ? $_SESSION[$key] : $defaultValue;
    }

    /**
     * Checks if a session key exists.
     *
     * @param string $key The key to check.
     *
     * @return bool True if the key exists, false otherwise.
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Removes a session value by its key.
     *
     * @param string $key The key of the value to remove.
     */
    public function remove(string $key): void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}
