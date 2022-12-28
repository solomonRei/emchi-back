<?php

namespace App\Http\Traits;

use Butschster\Head\Facades\Meta;

/**
 * Trait MetaTags
 * @package App\Http\Traits
 */
trait MetaTags
{

    /**
     * @param $title
     * @param string $description
     * @param array $keywords
     */
    public function setMeta($title, $description = '', $keywords = [])
    {
        Meta::setTitle($title)
            ->setDescription($description)
            ->setKeywords($keywords);
    }
}
