<?php
/**
 * This file is part of ninja-mutex.
 *
 * (C) Kamil Dziedzic <arvenil@klecza.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NinjaMutex\Mock;

use Memcached;

/**
 * Mock memcached to mimic mutex functionality
 *
 * @author Kamil Dziedzic <arvenil@klecza.pl>
 */
class MockMemcached extends Memcached
{
    /**
     * @var string[]
     */
    protected static $data = array();

    public function __construct()
    {
    }

    public function add($key, $value)
    {
        if (false === $this->get($key)) {
            self::$data[$key] = (string)$value;
            return true;
        }

        return false;
    }

    public function get($key)
    {
        if (!isset(self::$data[$key])) {
            return false;
        }

        return (string)self::$data[$key];
    }

    public function delete($key)
    {
        unset(self::$data[$key]);
        return true;
    }
}
