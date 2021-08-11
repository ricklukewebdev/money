<?php

namespace RickLuke\Money\Converters;

abstract class Converter
{
    protected $input;
    protected $output;

    public function __construct($input)
    {
        $this->input = $input;
        $this->output = $this->handle($input);
    }

    public function getInput()
    {
        return $this->input;
    }

    /**
     * This method is designed to be overwritten in the actual converter class.
     *
     * @param mixed $input
     *
     * @return mixed
     */
    public function handle($input)
    {
        return $input;
    }

    public function result()
    {
        return $this->output;
    }

    public static function convert($input)
    {
        $class = get_called_class();

        $converter = new $class($input);
        return $converter->result();
    }
}
