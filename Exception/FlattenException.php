<?php

namespace JavierEguiluz\Bundle\EasyAdminBundle\Exception;

use JavierEguiluz\Bundle\EasyAdminBundle\Exception\BaseException;
use Symfony\Component\Debug\Exception\FlattenException as BaseFlattenException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class FlattenException extends BaseFlattenException
{
    /** @var string */
    private $templatePath;

    /** @var array */
    private $parameters;

    public static function create(\Exception $exception, $statusCode = null, array $headers = array())
    {
        if (!$exception instanceof BaseException) {
            throw new \RuntimeException(sprintf(
                'You should only try to create an instance of "%s" with a "JavierEguiluz\Bundle\EasyAdminBundle\Exception\BaseException" instance, or subclass. "%s" given.',
                __CLASS__,
                get_class($exception)
            ));
        }

        /** @var FlattenException $e */
        $e = parent::create($exception, $statusCode, $headers);
        $e->setStatusCode($exception->getHttpStatusCode());
        $e->setTemplatePath($exception->getTemplatePath());
        $e->setParameters($exception->getParameters());

        return $e;
    }

    /**
     * @return string
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }

    /**
     * @param string $templatePath
     */
    public function setTemplatePath($templatePath)
    {
        $this->templatePath = $templatePath;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }
}
