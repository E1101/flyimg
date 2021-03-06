<?php

namespace Core\Entity;

use Core\Exception\AppException;

class AppParameters
{
    /** @var  array */
    protected $parameters;

    /**
     * AppParameters constructor.
     *
     * @param string $paramFilePath
     *
     * @throws AppException
     */
    public function __construct(string $paramFilePath)
    {
        if (!file_exists($paramFilePath)) {
            throw new AppException('Parameter file not found at : '.$paramFilePath);
        }
        $this->parameters = yaml_parse(file_get_contents($paramFilePath));
    }

    /**
     * Returns a parameter by name.
     *
     * @param string $key     The key
     * @param mixed  $default The default value if the parameter key does not exist
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->parameters) ? $this->parameters[$key] : $default;
    }

    /**
     * Sets a parameter by name.
     *
     * @param string $key   The key
     * @param mixed  $value The value
     */
    public function set($key, $value)
    {
        $this->parameters[$key] = $value;
    }
}
