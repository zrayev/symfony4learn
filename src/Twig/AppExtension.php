<?php

namespace App\Twig;

use phpDocumentor\Reflection\Types\Integer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('description', array($this, 'getDescription')),
        );
    }

    public function getDescription(string $text)
    {
        $new_text = substr($text, 0, 160);
        $description = trim($new_text);

        return $description . '...';
    }
}
