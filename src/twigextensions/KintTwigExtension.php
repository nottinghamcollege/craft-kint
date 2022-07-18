<?php
/**
 * Kint plugin for Craft CMS 3.x
 *
 * Adds Kint, an in-app PHP debugger, to Craft CMS 3.x for use in Twig and PHP.
 *
 * @link      https://mildlygeeky.com
 * @copyright Copyright (c) 2019 Mildly Geeky, Inc.
 */

namespace mildlygeeky\kint\twigextensions;

use Kint\Kint;
use Kint\Parser\MicrotimePlugin;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * @author    Mildly Geeky, Inc.
 * @package   Kint
 * @since     1.0.0
 */
class KintTwigExtension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'Kint';
    }

    /**
     * @inheritdoc
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('microtime', [$this, 'microtime']),
            new TwigFunction('trace', [$this, 'trace']),
        ];
    }

    /**
     * @return void
     */
    public function trace(): void
    {
        Kint::trace();
    }

    /**
     * @param bool $reset
     * @return void
     */
    public function microtime(bool $reset = false): void
    {
        if ($reset) {
            MicrotimePlugin::clean();
        }

        Kint::dump(microtime());
    }
}
