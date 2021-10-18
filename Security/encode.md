# Encoding

- https://www.youtube.com/playlist?list=PL0M0zPgJ3HSesuPIObeUVQNbKqlw5U2Vr
- https://slideplayer.com/slide/5994513/

## Types

https://en.wikipedia.org/wiki/List_of_cryptographers

### Morse

![](/Illustrations/Security/morse.PNG)

### Baudot

Extra code for:

11111 (shift down) and 11011 (shift up)

### BCD & ASCII

![](/Illustrations/Security/encodings.PNG)

### Unicode

- Very good: https://www.youtube.com/playlist?list=PLhQN_EIoIKBRA0yVTsWDoJzEKZwJY0p3l
- https://www.smashingmagazine.com/2012/06/all-about-unicode-utf8-character-sets/

#### The UTF-8 Header

Difference between `<?php header("Content-Type: text/html; charset=utf-8"); ?>` and `<meta charset="utf-8">`

The HTTP Content-Type header should always be set, it's the primary source for the browser to figure out what kind of document it's dealing with. 

Only if this header is missing will the browser try to find an HTML meta tag which gives it the same information as a fallback.

It makes sense to set both flags though, since you may save the HTML document to disk, in which case the HTTP header will be gone for anyone needing it later.

You can find the exact rules for how a browser determines the document's charset here: 
http://www.w3.org/TR/html5/syntax.html#determining-the-character-encoding

## Prefix code

no codeword is a prefix of any other; ASCII is a prefix code.

Kraft's theorem checks whether prefix codes can be made out of a collection of codes with specified lengths.

---

# Encodings commonly used in web development

https://html.spec.whatwg.org/multipage/parsing.html#determining-the-character-encoding

## HTML Entity

- https://www.freeformatter.com/html-entities.html
- https://www.w3schools.com/charsets/ref_html_entities_a.asp
- https://www.toptal.com/designers/htmlarrows/
- https://en.wikipedia.org/wiki/Numeric_character_reference
- https://www.w3schools.com/cssref/css_entities.asp
- https://www.rapidtables.com/code/text/unicode-characters.html

| Character | Unicode | HTML Hex Reference | HTML Decimal Reference | HTML Named Reference | Escape Sequence | Hex | Desc |
| --- | --- | --- | --- | --- | --- | --- | --- |
| < | U+0003C | &#x3c; | &#60; | &lt; | \u003c | \003C | less than | 

- https://copyglyphs.com/
- https://www.compart.com/fr/unicode/html
- https://www.fileformat.info/info/unicode/block/index.htm
- https://www.toptal.com/designers/htmlarrows/
- https://www.webdesignerexpress.com/blog/css-glyphs-and-html-special-characters.html

## URL Encode

`<` becomes %3C

## ASCII control char

| Escape Sequence | Hex | Desc | Abbrev. | Caret Notation | 
|  --- |  --- |  --- |  --- |  --- | 
| \n | 0A | newline | LF | ^J | 

## Unicode and other encodings

### Unicode

Unicode has attempted, with some controversy, to unify the character sets in a process known as Han unification.

Unicode Transformation Format (UTF) encoding, & Universal Character Set (UCS) encoding are the 2 implementations (mapping-methods) of Unicode.

- https://en.wikipedia.org/wiki/List_of_Unicode_characters
- https://en.wikipedia.org/wiki/Plane_%28Unicode%29#Basic_Multilingual_Plane
- https://stackoverflow.com/questions/2223882/whats-the-difference-between-utf-8-and-utf-8-without-bom
- http://www.java2s.com/Tutorial/Java/0120__Development/ConvertfromUTF8toUnicode.htm

#### FontAwesome in UTF-16

##### In UTF-8

https://github.com/atabegruslan/Others/blob/master/Illustrations/Security/encode/utf8_fa/

##### In UTF-16

https://github.com/atabegruslan/Others/blob/master/Illustrations/Security/encode/utf16_fa/

```
javac Converter.java
java Converter
```

https://stackoverflow.com/questions/55985946/how-can-i-use-font-awesome-icons-in-a-utf-16-encoded-html-page

#### CJKs in UTF-8, UTF-16

- UTF-8: Variable-width encoding, backwards compatible with ASCII. ASCII characters (U+0000 to U+007F) take 1 byte, code points U+0080 to U+07FF take 2 bytes, code points U+0800 to U+FFFF take 3 bytes, code points U+10000 to U+10FFFF take 4 bytes. Good for English text, not so good for Asian text.

- UTF-16: Variable-width encoding. Code points U+0000 to U+FFFF take 2 bytes, code points U+10000 to U+10FFFF take 4 bytes. Bad for English text, good for Asian text.

- UTF-32: Fixed-width encoding. All code points take four bytes. An enormous memory hog, but fast to operate on. Rarely used.

- UTF-16 will remains at 2 bytes

- While UTF-8 will just go double for Asian stuff

### CJK character encodings include

- Big5 (Complex Chinese)
- EUC-JP
- EUC-KR
- GB18030 (mandated standard in the People's Republic of China)
- GB2312 (subset and predecessor of GB18030)
- ISO 2022-JP
- KS C 5861
- Shift-JIS
- Unicode encodings (The CJK character sets take up the bulk of the assigned Unicode code space)

#### Simplified Chinese

```html
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
```

eg: &#20844; represents a chinese character.

UTF: 2 bytes, 16 bits, 2^16 variations, can accomodate all chinese characters even via brute-force way.

Use this website to convert chinese characters into unicode: http://www.pinyin.info/tools/converter/chars2uninumbers.html

https://en.m.wikipedia.org/wiki/Chinese_character_encoding

### Practical applications

#### Google Fonts

- https://answers.themler.io/articles/9064/how-to-use-google-fonts-locally
- https://stackoverflow.com/questions/2237540/how-do-i-load-external-fonts-into-an-html-document

#### Load multi-lingual fonts for `barryvdh/laravel-dompdf`

- https://github.com/barryvdh/laravel-dompdf/issues/290#issuecomment-265673491

1. Put font file and `load_font.php` anywhere in the Laravel project.
2. Run something like: 
    ```
    gzip -d fonts/simsun.ttf.gz
    php load_font.php simsun ./fonts/simsun.ttf
    ```
3. In template:
    ```html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style>    
            #the_contents {
                font-family: "simsun";
    ```

## Content Type vs Data Type (AJAX)

Content Type is what you send to server

Data type is what you expect to get back

https://stackoverflow.com/questions/14322984/differences-between-contenttype-and-datatype-in-jquery-ajax-function

### MIME (Content Type)

- https://www.stubbornjava.com/posts/what-is-a-content-type
- https://stackoverflow.com/questions/23714383/what-are-all-the-possible-values-for-http-content-type-header
- https://javarevisited.blogspot.com/2017/06/difference-between-applicationx-www-form-urlencoded-vs-multipart-form-data.html?m=1
- https://en.wikipedia.org/wiki/MIME
  - https://en.wikipedia.org/wiki/Media_type

## Multibyte text handling in PHP

- https://www.php.net/manual/en/book.mbstring.php
- https://compiledconcepts.com/software-engineering/what-are-multibyte-strings-in-php/
- https://hotexamples.com/examples/-/-/mb_encode/php-mb_encode-function-examples.html
- https://www.w3schools.com/Php/func_xml_utf8_encode.asp

# Encodings commonly used in web development (DB)

- https://www.toptal.com/php/a-utf-8-primer-for-php-and-mysql
- https://stackoverflow.com/questions/3682409/reading-utf-8-content-from-mysql-table
- https://stackoverflow.com/questions/30074492/what-is-the-difference-between-utf8mb4-and-utf8-charsets-in-mysql

## Rid diacritics: 

ES6: `dirty.normalize("NFD").replace(/[\u0300-\u036f]/g, "")`

PHP: `$clean = iconv('UTF-8', 'US-ASCII//TRANSLIT', $dirty);`

- Clean diacritics: https://stackoverflow.com/questions/3635511/remove-diacritics-from-a-string
- Clean diacritics: https://coderwall.com/p/a6koxq/how-to-remove-diacritics-in-sql-server
- Diacritics insensitive search: https://dba.stackexchange.com/questions/190969/ignore-accents-in-where

## Case insensitive search by BINARY

- https://www.w3schools.com/Sql/func_mysql_binary.asp
- https://stackoverflow.com/questions/18853452/sql-select-like-insensitive-casing

---

# Modulation

## Self timing

NRZ, NRZI will mess up if there is a long constant state.

Manchester code wont.

## Filters vs Tuners

Filters attenuate certain frequencies,

Tuners extract one modulated signal.

## Example

How can a 56 kb/s modem possibly achieve its maximum data rate
on a 3000 Hz analog phone line with a S/N of 35 dB? (Did
Shannon make a mistake?)

Answer: Modern telephone systems use 64 kb/s digital signalling
on their long‐distance connections, and the downlink on a V.90
modem is able to interpret these digital signals when it receives
data from your ISP. Your downlink is a channel with an 8 kBd
signalling rate and 8 bits/symbol; the bandwidth of this channel is
4 kHz, not the 3 kHz of an analog voice connection. The uplink on
a V.90 modem uses the 3 kHz analog voice channel, transmitting
data at 33.6 kb/s if your phone line isn't noisy, and transmitting at
a lower bitrate if you have a noisy line.
V.92 modems can upload at 56 kb/s, but as far as I know, no NZ
ISP provides a V.92 dialup service.

## Encode a digital signal as an analog signal

- FSK
- ASK
- PSK
- QAM : amplitude and phase

## Encode a analog signal as an digital signal

- PAM (signals may seem digital, but they have analog amplitudes)
- PCM

# Compression

## Example

Here is an example. In the (obsolescent) PAL broadcast standard
for New Zealand television, the bandwidth is approximately 7 MHz.
The SNR is roughly 20 dB, depending greatly on the location,
design, and orientation of your antenna.
If we sample a PAL signal at the Nyquist rate of twice its
bandwidth (14 MBd), and if we use the trivial digital encoding of 8
bits/sample for three channels (Red, Green, and Blue), then we
will have a data rate of 3 Â∙ 8 Â∙ 14 = 336 Mb/s, or 42 MB/s.
If we record all of these bytes for two hours (= 2 Â∙ 60 Â∙ 60 = 7200
seconds), we will have 302400 MB, or 302.4 GB. A digital video
disk (DVD‐5) can hold about 4.7 GB ...

A trivial form of data compression, for any analog signal, is to cut
its bandwidth â€“ we can use a low‐pass filter to limit its
high‐frequency information. Analog PAL broadcasting, and VHS
tapes, use this technique to compress the chrominance (colour)
information in studio‐quality TV recordings. The broadcast chroma
is only about 2 MHz at 20 dB.
We could digitally sample the chroma signal (using PCM) at a rate
of 4 log2(1 + 1020/2) = 27 Mb/s Ëœ 3 MB/s. The luminance signalis about 9 MB/s, for a total of 12 MB/s.
This is more than a 3:1 compression of our naive 42 MB/s
encoding. However we need to get a 40:1 compression, down to
about 1 MB/s, in order to record 90 minutes of video on a DVD.

## Huffmann code

based on the frequency of usage.

Run‐length encoding : by looking for long runs of 0 or 1.

Relative encoding or differential encoding.

## Lempel‐Ziv 

This compression method looks ahead in the input, finding the longest previously‐transmitted string which is a prefix of
the input. 

It transmits a reference to that previous string, thereby avoiding sending the same string more than once.

Examples:

1. UNIX compress command
2. gzip on UNIX
3. V.42bis compression standard for modems
4. GIF (Graphics Interchange Format)

## JPG
1. the discrete cosine transform (DCT)
2. quantisation
3. encoding phase

## GIF (Graphics Interchange Format) 

Compresses by: 

1. Reducing the number of colours to 256
2. Trying to cover the range of colours in an image as closely as possible.

It replaces each 24‐bit pixel value with an 8‐bit index to a table entry containing the colour that matches the original most closely. 

In the end, a variation of the Lempel‐Ziv encoding is applied to the resulting bit values.

GIF files are lossy if the number of colours exceeds 256 and lossless otherwise.

## MPEG

The Moving Picture Experts Group (MPEG) is a working group of ISO/IEC charged with the development of video and audio encoding standards.

The video codecs from MPEG use the discrete cosine transform techniques of the JPEG image compressor, and they also take advantage of redundancy between successive frames of video for inter‐frame compression. 

Differences between successive frames can be encoded very compactly, when the motion‐prediction techniques are successful.

Note: 

MPEG holds patents, and charges license fees. 

In June 2002, China formed a working group to develop an alternative set of audio and video codecs. 

The group was successful, see http://www.avs.org.cn, however the H.263 (MPEG‐2) and H.264 (MPEG‐4 Part 10) codecs are still commonly used in China.

MPEG has standardised the following compression formats and ancillary standards:

- MPEG‐1: video and audio compression standard; it includes the popular Layer 3 (MP3) audio compression format
- MPEG‐2: transport, video and audio standards for broadcast‐quality television
- MPEG‐4: expands MPEG‐1 to support video/audio object, 3D content, low bit‐rate encoding and support for Digital Rights Management.

### MP3

MPEG‐1 Audio Layer 3, better known as MP3, is a popular digital audio encoding, lossy compression format, and algorithm.

MP3 is based on the psycho‐acoustic model, auditory mask, and filter bank.

Psycho‐acoustics is the study of the human auditory system to learn what we can hear and what sounds we can distinguish. 

In general we can hear sounds in the 20 Hz to 20 kHz range, but sounds with close frequencies (for example, 2000 Hz and 2001 Hz) cannot be distinguished.

The auditory mask is the following phenomenon: if a sound with a certain frequency is strong, then we may be unable to hear a weaker sound with a similar frequency.

The filter bank is a collection of filters, each of which creates a stream representing signal components of a specified ranges. 

There is one filter for each of the many frequency ranges. 

Together they decompose the signal into sub‐bands.

The MP3 Compression:

![](/Illustrations/Security/mp3.PNG)

The MPEG standards define audio and video codecs, as well as file formats.

### MP4

The MP4 file format (MPEG‐4 Part 14) is based on Apple QuickTime container format. 

The file header indicates what codecs are used for video and audio, and it also gives values for important paramaters such as the video frame rate, horizontal and
vertical resolution (i.e. number of pixels per line, and number of lines per frame), and colourspace.

The video codecs defined in MPEG‐4 are all extensions of JPEG (or closely‐related DCT‐based techniques). 

Each video frame can be individually JPEG‐encoded, however usually each JPEG‐encoded frame (an frame) is followed by a few frames which have been encoded, much more compactly, using codewords which refer to8x8 image blocks in the preceding (or following) I‐frame.

These video compressors are especially successful in video with stationary backgrounds, but are not as effective in scenes with a lot of differently‐moving objects, such as the leaves on a tree, on a windy day. When compression ratios are high for video with high‐frequency information, JPEG‐like artifacts become apparent

e.g. sharp edges are sometimes rendered at very low resolution (as 8x8 blocks).

# Error detection

Appending redundant bits.

- single error
  - parity bit
    - 2D parity bit

![](/Illustrations/Security/parity_bit.PNG)
  
- burst error
  - 2D parity bits
  - checksums
  - CRC

# Error correction

single error:

Forward error correction ‐ 2^r => n + r + 1 , n is number of data bits, r is number of redundant bits.

Hamming code detects and corrects all single‐bit errors in data units of any length.

Hamming distance: by how many bits does 2 strings differ.

burst error:

Hamming code used in 2D to correct burst errors,

BCH codes, eg reed‐solomon code.

Hamming code used in 2D to correct burst errors:

![](/Illustrations/Security/multi_bit_error_correction.PNG)
