# 4. Usage

## Table of contents

0. [Home](0-Home.md)
1. [Installation and Setup](1-Installation-and-Setup.md)
2. [Usage](2-Usage.md)
   1. [Getting started](#1-getting-started)
   2. [Converter](#2-converter)
   3. [Validation](#3-validation)
   4. [Laravel](#4-laravel)
  
## 1. Getting started

First lets create a color instance:

```php
use Arcanedev\Color\Color;

$color = new Color;

$color->red();   // returns 0
$color->green(); // returns 0
$color->blue();  // returns 0
```

As you can see, the default color is **black** if you instantiate the object without arguments.

If you want to specify a specific color, you need to pass the `red`, `green` & `blue` as arguments (RGB).

Each color must have an `integer` value between **0** & **255** (DUH!). 

```php
use Arcanedev\Color\Color;

$color = new Color(255, 255, 255); // This is white by the way

$color->red();   // returns 255 
$color->green(); // returns 255
$color->blue();  // returns 255
```

You can set the colors after the object creation.

```php
use Arcanedev\Color\Color;

$color = new Color;

$color->setRed(186);
$color->setGreen(218);
$color->setBlue(85);

// You can chain these methods like this:

$color->setRed(186)->setGreen(218)->setBlue(85);
      
// Or like this:
$color->setRgb(186, 218, 85);
```

The fourth argument is the `alpha` (AKA `opacity`) and the type is `float` or `integer` between **0** and **1**.

```php
use Arcanedev\Color\Color;

$color = new Color(186, 218, 85, 0.5); // 0.5 == 50%
```

> **Note:** The default is **1** if you left the fourth argument empty.

You can set the `alpha` property after the initiation of the object:

```php
use Arcanedev\Color\Color;

$color = new Color(186, 218, 85);

$color->setAlpha(0.5);
```

You can also set all the properties (RGBA) like this:

```php
use Arcanedev\Color\Color;

$color = new Color;

$color->setRgb(186, 218, 85)->setAlpha(0.5);

// OR

$color->setRgba(186, 218, 85, 0.5);
```

And if you want to get the `alpha` value:

```php
use Arcanedev\Color\Color;

$color = new Color(186, 218, 85, 0.5);

$color->alpha(); // returns 0.5
```

#### Now, i will show you the cool stuff

Image you have a label (like a bootstrap's label) with a custom background. 

You can detect if the background is `bright` or `dark` to inverse the font color.

```php
use Arcanedev\Color\Color;

$color = new Color;

if ($color->isBright()) {
    // Use a dark color for fonts
}
else {
    // Use a bright color for fonts
}
```

##### OR

```php
use Arcanedev\Color\Color;

$color = new Color;

if ($color->isDark()) {
    // Use a bright color for fonts    
}
else {
    // Use a dark color for fonts
}
```

And if you want to control the `contrast` to switch between `bright` and `dark` colors.

> **Note:** the default contrast value is **150** and this is my personal choice.

You can specify your own contrast by doing this:

```php
$color->isBright(170);
// OR
$color->isDark(170);
```

> **Question:** How i can `make` a color object with a **HEX** value ?  

#### EASY:

```php
use Arcanedev\Color\Color;

$color = Color::make('#BADA55');
```

And if you want to convert your color object to **HEX**:

```php
use Arcanedev\Color\Color;

$color = new Color;

$color->toHex(); // return '#000000'
```

If you want the **HEX** color to be **lower case** instead of **upper case**, you pass a `boolean` as an argument:

```php
use Arcanedev\Color\Color;

$color = new Color(176, 11, 30); // NSFW

$color->toHex(false); // return '#b00b1e'
```

You can also echo out directly the color object to get the **HEX** value:

```php
use Arcanedev\Color\Color;

echo new Color(255, 0, 0);  // '#FF0000' 
```

## 2. Converter

> Coming soon&hellip;

## 3. Validation

> Coming soon&hellip;

## 4. Laravel

> Coming soon&hellip;
