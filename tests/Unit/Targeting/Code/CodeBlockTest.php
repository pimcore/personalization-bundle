<?php

declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace Pimcore\Bundle\PersonalizationBundle\Tests\Unit\Targeting\Code;


use Codeception\Test\Unit;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Code\CodeBlock;

class CodeBlockTest extends Unit
{
    private array $defaultParts = [
        'foo;',
        'bar?',
        'bazinga!' . "\n" . '!!!',
    ];

    private string $defaultResult = <<<'EOL'
foo;
bar?
bazinga!
!!!
EOL;

    public function testToString(): void
    {
        $block = new CodeBlock($this->defaultParts);

        $this->assertSame($this->defaultResult, $block->asString());
        $this->assertSame($this->defaultResult, (string)$block);
        $this->assertSame($this->defaultResult, $block->__toString());
    }

    public function testSetParts(): void
    {
        $block = new CodeBlock();

        $this->assertEmpty($block->getParts());

        $block->setParts($this->defaultParts);

        $this->assertSame($this->defaultParts, $block->getParts());
        $this->assertSame($this->defaultResult, $block->asString());
    }

    public function testAppend(): void
    {
        $block = new CodeBlock($this->defaultParts);

        $block->append('foofoo');

        $expected = $this->defaultResult . "\nfoofoo";

        $this->assertSame($expected, $block->asString());

        $block->append(['123', '456']);

        $expected = $expected. "\n123\n456";

        $this->assertSame($expected, $block->asString());
    }

    public function testPrepend(): void
    {
        $block = new CodeBlock($this->defaultParts);

        $block->prepend('barbar');

        $expected = "barbar\n" . $this->defaultResult;

        $this->assertSame($expected, $block->asString());

        $block->prepend(['654', '321']);

        $expected = "654\n321\n" . $expected;

        $this->assertSame($expected, $block->asString());
    }
}
