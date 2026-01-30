<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use RemoveEmoji\RemoveEmoji;

class RemoveEmojiTest extends TestCase
{
    private RemoveEmoji $remover;

    protected function setUp(): void
    {
        $this->remover = new RemoveEmoji();
    }

    public function testFromRunes()
    {
        // Go: input := []rune("Hi 哈👾洛👾沃👾德👾１２👾👾３ 👾")
        // Go: expected := []rune("Hi 哈洛沃德１２３ ")
        $input = "Hi 哈👾洛👾沃👾德👾１２👾👾３ 👾";
        $expected = "Hi 哈洛沃德１２３ ";
        $this->assertEquals($expected, $this->remover->remove($input));
    }

    public function testEmoji15Standards()
    {
        $output = $this->remover->remove(TestFixtures::EMOJI_15_DATA);
        $lines = explode("\n", $output);
        foreach ($lines as $i => $line) {
            if (trim($line) === "") continue;
            // Ruby spec expects removal of emoji at start, leaving space
            if (!str_starts_with($line, " ")) {
                 $this->fail("Line $i expected to start with space (emoji removed), got: '$line'");
            }
        }
        $this->assertTrue(true);
    }

    public function testEmoji131Standards()
    {
        $output = $this->remover->remove(TestFixtures::EMOJI_13_1_DATA);
        $lines = explode("\n", $output);
        foreach ($lines as $i => $line) {
            if (trim($line) === "") continue;
            // Ruby spec expects removal of emoji at start, leaving space
            if (!str_starts_with($line, " ")) {
                $this->fail("Line $i expected to start with space (emoji removed), got: '$line'");
            }
        }
        $this->assertTrue(true);
    }

    public function testEmoji13BetaStandards()
    {
        $output = $this->remover->remove(TestFixtures::EMOJI_13_BETA_DATA);
        // Expect emoji removed. Check that it doesn't contain the sample emoji "😀"
        $this->assertStringNotContainsString("😀", $output);
        // Also check that it's just brackets and commas mostly
        // Go test just check specific structure or absence of emojis.
    }

    public function testEmoji11Standards()
    {
        $input = TestFixtures::EMOJI_11_DATA;
        $output = $this->remover->remove($input);
        
        // Go check logic:
        // if out == in { warning } else { check removed }
        // The regex includes these emojis, so we expect them to be removed.
        
        $this->assertNotEquals($input, $output);
        $this->assertStringNotContainsString("🥰", $output);
        
        // Check finding space at start of lines (since format is "🥰 Description")
         $lines = explode("\n", $output);
        foreach ($lines as $i => $line) {
            if (trim($line) === "") continue;
            if (!str_starts_with($line, " ")) {
                 $this->fail("Line $i expected to start with space, got: '$line'");
            }
        }
    }

    public function testSymbolsRemoval()
    {
        $input = str_replace("\n", "", TestFixtures::COMMON_SYMBOLS_DATA);
        $output = $this->remover->remove($input);
        $this->assertEquals("......", $output);
    }

    public function testEmojiFlagsRemoval()
    {
        $input = str_replace("\n", "", TestFixtures::EMOJI_FLAGS_DATA);
        $output = $this->remover->remove($input);
        $this->assertEquals("......", $output);
    }

    public function testAppleEmojiRemoval()
    {
        $input = str_replace("\n", "", TestFixtures::APPLE_EMOJI_DATA);
        $output = $this->remover->remove($input);
        $this->assertEquals("......", $output);
    }

    public function testEmojiVariationSequencesRemoval()
    {
        $input = TestFixtures::VARIATION_SEQUENCES_DATA;
        $output = $this->remover->remove($input);
        $this->assertEquals("..", $output);
    }

    public function testFitzpatrickModifiersRemoval()
    {
        $input = TestFixtures::FITZPATRICK_DATA;
        $output = $this->remover->remove($input);
        $this->assertEquals("..", $output);
    }

    public function testSymbolsPreservation()
    {
        $input = TestFixtures::SYMBOLS_PRESERVATION_DATA;
        $output = $this->remover->remove($input);
        $this->assertEquals($input, $output);
    }
    
    public function testChinesePreservation()
    {
        $input = TestFixtures::CHINESE_DATA;
        $output = $this->remover->remove($input);
        $this->assertEquals($input, $output);
    }

    public function testJapanesePreservation()
    {
        $input = TestFixtures::JAPANESE_DATA;
        $output = $this->remover->remove($input);
        $this->assertEquals($input, $output);
    }

    public function testKoreanPreservation()
    {
        $input = TestFixtures::KOREAN_DATA;
        $output = $this->remover->remove($input);
        $this->assertEquals($input, $output);
    }

    public function testSimplifiedChinesePreservation()
    {
        $input = TestFixtures::SIMPLIFIED_DATA;
        $output = $this->remover->remove($input);
        $this->assertEquals($input, $output);
    }

    public function testBenchmarkPreservation()
    {
        $input = TestFixtures::BENCHMARK_DATA;
        $output = $this->remover->remove($input);
        
        // Go test allowed minor diffs?
        // "if strings.TrimSpace(out) != strings.TrimSpace(tc.input)"
        $this->assertEquals(trim($input), trim($output));
    }
}
