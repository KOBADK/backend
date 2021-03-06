<?php
/**
 * @file
 * Custom Exception for methods not supported yet.
 */

namespace Koba\MainBundle\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class NotImplementedException
 * @package Koba\MainBundle\Exceptions
 */
class NotImplementedException extends HttpException
{
    /**
     * Constructor.
     *
     * @param string|null $message The internal exception message
     * @param null|\Exception $previous The previous exception
     * @param int $code The internal exception code
     */
    public function __construct(
        $message = null,
        \Exception $previous = null,
        $code = 0
    ) {
        parent::__construct(501, 'Not implemented.', $previous, array(), $code);
    }
}
