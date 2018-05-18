<?php

namespace App\Exception;

use Exception;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\Form\FormInterface;

class FormValidationException extends Exception {
    /**
     * @var FormInterface
     */
    private $form;

    /**
     * @var array
     */
    private $meta;

    /**
     * FormValidationException constructor.
     * @param FormInterface $form
     * @param null $message
     * @param null $code
     * @param array $meta
     */
    public function __construct(FormInterface $form, $message = null, $code = null, $meta = []) {
        $this->form = $form;
        $this->message = $message;
        $this->meta = $meta;
        $this->code = $code;
    }

    /**
     * @return FormInterface
     */
    public function getForm(): FormInterface {
        return $this->form;
    }

    /**
     * @return array
     */
    public function getMeta(): array {
        return $this->meta;
    }
}
