<?php namespace Arcanedev\Color\Laravel;

use Arcanedev\Color\ColorValidator as BaseValidator;
use Arcanedev\Color\Exceptions\ColorException;

/**
 * Class     ColorValidator
 *
 * @package  Arcanedev\Color\Laravel
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorValidator extends BaseValidator
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Function
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Validate the color.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @param  array   $parameters
     *
     * @return bool
     */
    public function validate($attribute, $value, array $parameters)
    {
        $method = 'validate' . ucfirst(strtolower($this->getType($parameters)));

        return method_exists($this, $method)
            ? call_user_func_array([$this, $method], [$value])
            : false;
    }

    /**
     * Get the validation message.
     *
     * @param  string  $message
     * @param  string  $attribute
     * @param  string  $rule
     * @param  array   $parameters
     *
     * @return string
     */
    public function message($message, $attribute, $rule, array $parameters)
    {
        /** @var \Illuminate\Translation\Translator  $translator */
        $translator = app('translator');

        return str_replace(
            [':attribute', ':type'],
            [$attribute, reset($parameters)],
            $translator->has($message)
                ? $translator->trans($message)
                : 'The :attribute field is not a valid :type color.'
        );
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the color type.
     *
     * @param  array  $parameters
     *
     * @return string
     *
     * @throws \Arcanedev\Color\Exceptions\ColorException
     */
    private function getType(array $parameters)
    {
        $type = reset($parameters);

        if ($type === false)
            throw new ColorException('You must specify the color type in your validation rule.');

        return (string) $type;
    }
}
