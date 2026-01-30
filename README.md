PHP Remove Emoji
=================================================

This is a PHP library developed for "removing" Unicode Emoji icons, you can use this library to remove annoying Emoji symbols.

![emoji](https://i.imgur.com/4mow6Pf.png)

- [for Ruby](https://github.com/guanting112/remove_emoji)
- [for Golang](https://github.com/guanting112/go-remove-emoji)

Installation
--------

```bash
# Install via Composer
composer require guanting112/php-remove-emoji
```

Usage
--------

```php
require 'vendor/autoload.php';

use RemoveEmoji\RemoveEmoji;

$original_string = "😊😍😌🤕👿👹🍏🍐🍑🍒🍓🍔🍕🍖🍗👌☝🏼🥝🥦🌶🌽🍎";

$remover = new RemoveEmoji();
echo $remover->remove($original_string);
```

```php
require 'vendor/autoload.php';

use RemoveEmoji\RemoveEmoji;

# ==========
#   Input
# ==========
$original_string = <<<STRING
abcdefghijklmnopqrstuvwxyz....0123456789
不極，物片類書車裡！十今果半接國先雄
ニッポン」「ニホン」両方使用される中
🌝🌞🌟🌠🌡🌤🌥🌦🌧🌨🌩🌪
🌫🌬🌰🌱🌲🌳🌴🌵🌶🌷🌸🌹🌺🌻🌼🌽🌾🌿🍀🍁🍂🍃🍄🍅🍆🍇🍈
🍉🍊🍋🍌🍍🍎🍏🍐🍑🍒🍓🍔🍕🍖🍗
🕜🕝🕞🕟🕠🕡🕢🕣🕤🕥🕦🕧🕯🕰🕳🕴🕵🕶🕷🕸🕹🖇🖊
🖋🖌🖍🖐🖕🖖🖥🖨🖱🗲🖼🗂🗃🗄🗑🗒🗓🗜🗝🗞🗡🗣🗨🗯🗳🗺🗻
🗼🗽🗾🗿😀😁😂😃😄😅😆😇😈😉😊😋😌😍😎😏😐😑😒😓😔😕😖
😗😘😙😚😛😜😝😞😟😠😡😢😣😤😥😦😧😨😩😪😫😬😭😮😯😰😱
😲😳😴😵😶😷😸😹😺😻😼😽😾😿🙀🙁🙂🙅🙆🙇🙈🙉🙊🙋🙌🙍🙎
🙏🚀🚁🚂🚃🚄🚅🚆🚇🚈🚉🚊
には文중국, 일본, 베트남 등 한자 문화권에 속하는 아시아 여러 국가에서는 
한국어的差异外，通常认为还存在词汇上的差异。例如繁体中文里多用的“原
لمنطقة الشرق الأوسط هيلي: التحرك ضد إيران سيبدأ من مجلس الأمن
STRING;

# ==========
#   Output
# ==========
$remover = new RemoveEmoji();
echo $remover->remove($original_string);

# Result:
# abcdefghijklmnopqrstuvwxyz....0123456789
# 不極，物片類書車裡！十今果半接國先雄
# ニッポン」「ニホン」両方使用される中
# 
# 
# 
# 
# 
# 
# 
# 
# には文중국, 일본, 베트남 등 한자 문화권에 속하는 아시아 여러 국가에서는
# 한국어的差异外，通常认为还存在词汇上的差异。例如繁体中文里多用的“原
# لمنطقة الشرق الأوسط هيلي: التحرك ضد إيران سيبدأ من مجلس الأمن
```
