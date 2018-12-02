<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('description', [$this, 'getDescriptionFilter']),
            new TwigFilter('usort_published', [$this, 'usortByPublishedFilter']),
        ];
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function getDescriptionFilter(string $text)
    {
        $new_text = substr($text, 0, 160);
        $description = trim($new_text);

        return $description . '...';
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function usortByPublishedFilter($item)
    {
        usort($item, function ($item1, $item2) {
            if ($item1['published_at'] === $item2['published_at']) {
                return 0;
            }

            return $item1['published_at'] < $item2['published_at'] ? -1 : 1;
        });

        return $item;
    }
}
