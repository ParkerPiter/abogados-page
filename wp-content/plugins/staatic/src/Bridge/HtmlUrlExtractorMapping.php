<?php

declare(strict_types=1);

namespace Staatic\WordPress\Bridge;

use Staatic\Crawler\UrlExtractor\Mapping\HtmlUrlExtractorMapping as BaseMapping;

final class HtmlUrlExtractorMapping extends BaseMapping
{
    /**
     * @var mixed[]|null
     */
    private $cachedMapping;

    /**
     * @var mixed[]|null
     */
    private $cachedSrcsetAttributes;

    public function mapping() : array
    {
        if ($this->cachedMapping === null) {
            $this->cachedMapping = parent::mapping();
            $this->cachedMapping['div'] = \array_merge($this->cachedMapping['div'], [
                // Avada theme.
                'data-back',
                'data-back-webp',
            ]);
            $this->cachedMapping['img'] = \array_merge($this->cachedMapping['img'], [
                // WP Fastest Cache
                'data-srcset',
                'data-wpfc-original-srcset',
            ]);
            $this->cachedMapping['amp-img'] = \array_merge($this->cachedMapping['amp-img'], [
                // WP Fastest Cache
                'data-srcset',
                'data-wpfc-original-srcset',
            ]);
            $this->cachedMapping['source'] = \array_merge($this->cachedMapping['source'], [
                // WP Fastest Cache
                'data-srcset',
                'data-wpfc-original-srcset',
            ]);
            $this->cachedMapping['link'] = \array_merge($this->cachedMapping['link'], [
                // Avada theme.
                'imagesrcset',
                'data-pmdelayedstyle',
            ]);
            $this->cachedMapping = \apply_filters('staatic_html_mapping_tags', $this->cachedMapping);
        }

        return $this->cachedMapping;
    }

    public function srcsetAttributes() : array
    {
        if ($this->cachedSrcsetAttributes === null) {
            $this->cachedSrcsetAttributes = \array_merge(parent::srcsetAttributes(), [
                // WP Fastest Cache
                'data-srcset',
                'data-wpfc-original-srcset',
                // Avada theme.
                'imagesrcset',
            ]);
            $this->cachedSrcsetAttributes = \apply_filters(
                'staatic_html_mapping_srcset',
                $this->cachedSrcsetAttributes
            );
        }

        return $this->cachedSrcsetAttributes;
    }
}
