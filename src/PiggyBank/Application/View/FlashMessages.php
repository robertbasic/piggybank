<?php

declare(strict_types=1);

namespace PiggyBank\Application\View;

use Zend\View\Helper\AbstractHelper;

class FlashMessages extends AbstractHelper
{
    private $classMap = [
        'error' => 'danger',
        'success' => 'success',
    ];

    public function __invoke() : string
    {
        $flashMessages = $this->getFlashMessages();

        if (empty ($flashMessages)) {
            return '';
        }

        $html = '';

        foreach ($flashMessages as $messageType => $messages) {
            $message = $this->combineMessages($messages);
            $html .= '<div class="alert alert-' . $this->classMap[$messageType] . '">' . $message . '</div>';
        }

        return $html;
    }

    private function getFlashMessages() : array
    {
        $content = $this->getView()->viewModel()->getCurrent()->getChildrenByCaptureTo('content');

        if (!is_array($content)) {
            return [];
        }

        $variables = array_shift($content);

        if (!isset($variables->messages)) {
            return [];
        }

        return $variables->messages;
    }

    private function combineMessages($messages) : string
    {
        if (count($messages) == 1) {
            return array_shift($messages);
        }

        return implode('<br>', $messages);
    }
}
