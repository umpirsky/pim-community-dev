<?php

namespace Akeneo\Bundle\BatchBundle\Item;

/**
 * Exception throw during step execution when an item is invalid
 *
 * @author    Gildas Quemener <gildas@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/MIT MIT
 */
class InvalidItemException extends \Exception
{
    /** @var array */
    protected $item;

    /** @var array */
    protected $messageParameters;

    /**
     * Constructor
     *
     * @param string     $message
     * @param array      $item
     * @param array      $messageParameters
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct(
        $message,
        array $item,
        array $messageParameters = array(),
        $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->item              = $item;
        $this->messageParameters = $messageParameters;
    }

    /**
     * Get message parameters
     *
     * @return array
     */
    public function getMessageParameters()
    {
        return $this->messageParameters;
    }

    /**
     * Get the invalid item
     *
     * @return array
     */
    public function getItem()
    {
        return $this->item;
    }
}