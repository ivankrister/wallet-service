<?php


namespace DotcodeIo\Wallet\Models;



class WalletModel
{
    protected $model;

    public function __construct()
    {
        // Get the model class from the configuration
        $modelClass = config('wallet.wallet_model');
        $this->model = new $modelClass;
    }

    /**
     * Dynamically handle calls to the model methods.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        // Forward method calls to the model instance
        return $this->model->$method(...$parameters);
    }

    /**
     * Dynamically handle static method calls to the model methods.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        // Forward static method calls to the model class
        $modelClass = config('wallet.wallet_model');
        return (new $modelClass)->$method(...$parameters);
    }

    /**
     * Handle dynamic property access to the model instance.
     *
     * @param  string  $name
     * @return mixed
     */
    public function __get($name)
    {
        // Access the property on the model instance
        return $this->model->$name;
    }

    /**
     * Handle dynamic property setting on the model instance.
     *
     * @param  string  $name
     * @param  mixed   $value
     */
    public function __set($name, $value)
    {
        // Set the property on the model instance
        $this->model->$name = $value;
    }

    /**
     * Check if a property is set on the model instance.
     *
     * @param  string  $name
     * @return bool
     */
    public function __isset($name)
    {
        // Check if the property is set on the model instance
        return isset($this->model->$name);
    }

    /**
     * Unset a property on the model instance.
     *
     * @param  string  $name
     */
    public function __unset($name)
    {
        // Unset the property on the model instance
        unset($this->model->$name);
    }
}
