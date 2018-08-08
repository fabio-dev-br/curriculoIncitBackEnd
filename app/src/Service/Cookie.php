<?php

namespace IntecPhp\Service;


final class Cookie
{
    private $cookieName;
    private $timeout;
    private $cookieValue;

    public function __construct(string $cookieName, int $timeout)
    {
        $this->cookieName = $cookieName;
        $this->timeout = $timeout;
        $this->cookieValue = null;
    }

    public function set(string $cookieValue)
    {
        if (setcookie($this->cookieName, $cookieValue, time() + $this->timeout, '/')) {
            $this->cookieValue = $cookieValue;
            return $cookieValue;
        }
    }

    public function remove()
    {
        $this->cookieValue = null;
        return setcookie($this->cookieName, '', -1, '/');
    }

    public function get()
    {
        return $this->cookieValue = $this->cookieValue ?? filter_input(INPUT_COOKIE, $this->cookieName);
    }

    public function getName()
    {
        return $this->cookieName;
    }
}
