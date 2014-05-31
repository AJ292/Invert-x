<?php

function smarty_modifier_bbcode($string, $functions = 'content')
{
    $split_functions = explode(',', $functions);
    
    $presets = array(
        'snipped' => array('esc', 'snip', 'lines', 'b', 'i', 'u', 's', 'auto', 'pre-1', 'pre-2', 'img', 'url', 'wp', 'quote', 'pquote', 'tube', 'font', 'list', 'h', 'clean-1', 'clean-2'),
        'content' => array('esc', 'nosnip', 'lines', 'b', 'i', 'u', 's', 'auto', 'pre-1', 'pre-2', 'img', 'url', 'wp', 'quote', 'pquote', 'tube', 'font', 'list', 'h', 'clean-1', 'clean-2'),
        'comment' => array('esc', 'lines', 'b', 'i', 'u', 's', 'auto', 'url', 'wp', 'font', 'h', 'clean-1', 'clean-2')
    );

    $bbcode_functions = array(
        'snip'   => array('%\[snip\].*%si' => ''),
        'esc'    => array('func' => 'htmlspecialchars'),
        'nosnip' => array('%\[snip\]%si' => ''),
        'pre-1'  => array('func' => 'format_pre1'),
        'lines'  => array('/\r\n/si' => "\n",
                          '/[\r\n]{2,}/si' => "\n\n",
                          '/[\r\n]/si' => "<br>\n"),
        'small'  => array('/<br>/si' => ' '),
        'b'      => array('%\[b\](.*?)\[/b\]%si' => '<span class="bbc-b">\1</span>'),
        'i'      => array('%\[i\](.*?)\[/i\]%si' => '<span class="bbc-i">\1</span>'),
        'u'      => array('%\[u\](.*?)\[/u\]%si' => '<span class="bbc-u">\1</span>'),
        's'      => array('%\[s\](.*?)\[/s\]%si' => '<span class="bbc-s">\1</span>'),
        'auto'   => array('~\b(?<![\][="])(http://(?:www\.)?+[a-zA-Z0-9-#:.?+=&%@!/]*)(?![\][="])\b~si' => '<a class="bbc-auto" href="\1">\1</a>',
                          '~\b(?<![\][="])(?<!http://)(www\.[a-zA-Z0-9-#:.?+=&%@!/]*)(?![\][="])\b~si' => '<a class="bbc-auto" href="\1">\1</a>'),
        'img'    => array('%\[img(?:\.([^]=]+))?(?:=([^]]+))?\](.*?\.(?:png|jpg))\[/img\]%si' => '</p><div class="bbc-img-con \1"><img class="bbc-img" src="\3" alt="User posted image"><span class="bbc-img-cap">\2</span></div><p>',
                          /*'%\[img\](.*?\.(?:png|jpg))\[/img\]%si' => '</p><img class="bbc-img" src="\1" alt="User posted image"><p>',
                          '%\[img\.([^]]+)\](.*?\.(?:png|jpg))\[/img\]%si' => '</p><img class="bbc-img \1" src="\2" alt="User posted image"><p>',*/
                          '%\[simg\](.*?\.(?:png|jpg))\[/simg\]%si' => '<img class="bbc-simg" src="\1" alt="User posted image">',
                          '%\[url=(.*?)\]\[img\](.*?\.(?:png|jpg))\[/img\]\[/url\]%si' => '<a class="bbc-imglink" href="\1"><img class="bbc-imglink" src="\2" alt="User posted image"></a>'),
        'url'    => array('%\[url=(.*?)\](.*?)\[/url\]%si' => '<a class="bbc-url" href="\1">\2</a>',
                          '%\[url\](.*?)\[/url\]%si' => '<a class="bbc-url" href="\1">\1</a>'),
        'wp'     => array('func' => 'format_wikipedia_links'),
        'quote'  => array('%\[quote\](.*?)\[/quote\]%si' => '</p><p class="bbc-quote">\1</p><p>'),
        'pquote' => array('%\[pullquote\](.*?)\[/pullquote\]%si' => '</p><p class="bbc-pullquote">\1</p><p>'),
        'tube'   => array('%\[youtube=([^\]]*)\](.*?)\[/youtube\]%i' => "</p><div class=\"bbc-youtube-embed\"><object style=\"width: 590px; height: 330px;\" type=\"application/x-shockwave-flash\" data=\"http://www.youtube.com/v/\$1?version=3&amp;hl=en_US&amp;rel=0&amp;hd=1\"><param name=\"movie\" value=\"http://www.youtube.com/v/\$1?version=3&amp;hl=en_US&amp;rel=0&amp;hd=1\" /><param name=\"allowFullScreen\" value=\"true\" /></object><span class=\"bbc-youtube-embed-caption\">\$2</span></div><p>"),
        'font'   => array('%\[size=([6-9]|[1-2][0-9]|3[0-6])\](.*?)\[/size\]%si' => '<span class="bbc-size" style="font-size: \1px">\2</span>',
                          '%\[colo(u?)r=(#[0-9a-f]{6}|#[0-9a-f]{3}|[a-z]{3,30})\](.*?)\[/colo\1r\]%si' => '<span class="bbc-colour" style="color: \1px">\2</span>'),
        'list'   => array('%\[list\](.*?)\[/list\]%si' => "</p>\n<ul class=\"bbc-ul\">\\1</ul>\n<p>",
                          '%\[olist\](.*?)\[/olist\]%si' => "</p>\n<ol class=\"bbc-ol\">\\1</ol>\n<p>",
                          '%\[li\](.*?)\[/li\]%si' => '<li class="bbc-li">\1</li>',
                          '/(<[uo]l?[^>]*>)\s*(?:<br>\s*)+/si' => "\\1\n",
                          '%(</li>)\s*(?:<br>\s*)+%si' => "\\1\n"),
        'h'      => array('%\[h=([1-6])\](.*?)\[/h\]%si' => '<h\1 class="bbc-h">\2</h\1>'),
        'clean-1'=> array('%^((?!(?:</?(?:p|h))|(?:[\r\n]+)).*)$%im' => '    \1'),
        'pre-2'  => array('func' => 'format_pre2'),
        'clean-2'=> array('/^(.*)$/si' => '<p>\1</p>',
                          '/(\s*<br>\s*)*<h/si' => "</p>\n\n<h",
                          '%(</h[1-6]>)(\s*<br>\s*)*%si' => "\\1\n<p>",
                          '/<br>[\s]*<br>/si' => "</p>\n<p>",
                          '%<span [^>]*>\s*</span>%si' => "",
                          '%<p([^>]*)>\s*</p>%si' => '',
                          '%<p([^>]*)>\s*%si' => "<p\\1>\n",
                          '%\s*</p>%si' => "\n</p>",
                          '%<(/?)p>\s*<\1p>%si' => '<\1p>',
                          '%</p>\s*(<br>\s*)+<%si' => "</p>\n<",
                          '/>\s*(<br>\s*)+<p([^>]*)>/si' => ">\n<p\\2>")
    );

    $funcs = array();
    foreach ($split_functions as $func) {
        if (array_key_exists($func, $presets)) {
            foreach ($presets[$func] as $ps) {
                $funcs[$ps] = true;
            }
        } else if (array_key_exists($func, $bbcode_functions)) {
            $funcs[$func] = true;
        }
    }
    
    $result = $string;

    foreach ($bbcode_functions as $func => $params) {
        if (isset($funcs[$func]) && $funcs[$func] === true) {
            foreach ($params as $pattern => $replace) {
                if ($pattern == 'func') {
                    $result = call_user_func($replace, $result);
                } else {
                    $result = preg_replace($pattern, $replace, $result);
                }
            }
        }
    }
    
    return $result;
}

function compute_pre1_replacement($groups) {
    return "</p>\n".$groups[1].base64_encode($groups[2]).$groups[3]."\n<p>";
}

function compute_pre2_replacement($groups) {
    return '<pre class="'.trim($groups[1].' bbc-pre').'">'.base64_decode($groups[2]).'</pre>';
}

function format_pre1($text)
{
    return preg_replace_callback('%(\[pre[^]]*\])(.*?)(\[/pre\])%si', 'compute_pre1_replacement', $text);
}

function format_pre2($text)
{
    return preg_replace_callback('%\[pre(?:=([^]]+))?\](.*?)\[/pre\]%si', 'compute_pre2_replacement', $text);
}

function compute_wikipedia_link_replacement($groups) {
    $split = explode('|', $groups[1]);
    $url = trim($groups[1]);
    $text = trim($groups[1]);
    if (count($split) > 1)
    {
        $url = trim($split[0]);
        $text = trim($split[1]);
    }
    else
    {
        $text = preg_replace('/\s+\([^)]*\)$/i', '', $text);
    }
    $url = str_ireplace(' ', '_', $url);
    return '<a href="http://en.wikipedia.org/wiki/'.$url.'">'.$text.'</a>';
}

function format_wikipedia_links($text)
{
    return preg_replace_callback('/\[\[([^]]*)\]\]/i', 'compute_wikipedia_link_replacement', $text);
}

?>
