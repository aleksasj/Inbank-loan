<?php

namespace App\Src;

use Exception;
use Illuminate\Support\Arr;

class Rv
{
    const GLOBAL_MESSAGE_NAMING = 'global_error';

    public $success = true;
    public $data = [];
    public $messages = [];

    public function __construct($success = true, $messages = [])
    {
        $this->success = $success;
        $this->messages = $messages;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): Rv
    {
        $this->success = $success;
        return $this;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function addMessage(string $message): Rv
    {
        $this->messages[] = $message;
        return $this;
    }

    public function addExceptionMessage(Exception $e): Rv
    {
        if ($e instanceof Exception) {
            $this->setSuccess(false);
        }
        $this->messages[self::GLOBAL_MESSAGE_NAMING][] = $e->getMessage();
        return $this;
    }

    public function setMessages(array $messages): Rv
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * @return $this|mixed
     */
    public function __call($method, $args)
    {
        $key = strtolower(substr($method, 3, 1)) . substr($method, 4);
        $value = isset($args[0]) ? (count($args) == 1 ? $args[0] : $args) : null;
        if (!method_exists($this, $method)) {
            switch (substr($method, 0, 3)) {
                case 'get':
                    return Arr::get($this->data, $key, null);
                case 'set':
                    $this->data[$key] = $value;
                    return $this;
            }
        }
    }
}
