<?php

namespace yyxx9988\mlconverter;

class Converter
{
    private $html;

    private $htmlTags = [
        'a' => 'view',
        'p' => 'view',
        'h1' => 'view',
        'h2' => 'view',
        'h3' => 'view',
        'h4' => 'view',
        'h5' => 'view',
        'h6' => 'view',
        'ul' => 'view',
        'ol' => 'view',
        'li' => 'view',
        'div' => 'view',
        'nav' => 'view',
        'pre' => 'view',
        'code' => 'view',
        'menu' => 'view',
        'aside' => 'view',
        'header' => 'view',
        'footer' => 'view',
        'legend' => 'view',
        'section' => 'view',
        'article' => 'view',
        'caption' => 'view',
        'details' => 'view',
        'summary' => 'view',
        'menuitem' => 'view',
        'blockquote' => 'view',

        'i' => 'text',
        'b' => 'text',
        's' => 'text',
        'u' => 'text',
        'big' => 'text',
        'del' => 'text',
        'sub' => 'text',
        'sup' => 'text',
        'ins' => 'text',
        'font' => 'text',
        'mark' => 'text',
        'time' => 'text',
        'span' => 'text',
        'center' => 'text',
        'strong' => 'text',
        'strike' => 'text',
    ];

    public function setHtml($str)
    {
        $this->html = $str;

        return $this;
    }

    public function addHtmlTags($from, $to)
    {
        $from = strtolower($from);
        $to = strtolower($to);

        if (!isset($this->htmlTags[$from])) {
            $this->htmlTags[$from] = $to;
        }

        return $this;
    }

    public function setHtmlTags($from, $to)
    {
        $from = strtolower($from);
        $to = strtolower($to);

        if (isset($this->htmlTags[$from])) {
            $this->htmlTags[$from] = $to;
        }

        return $this;
    }

    public function removeHtmlTags($from)
    {
        $from = strtolower($from);

        unset($this->htmlTags[$from]);

        return $this;
    }

    public function convert()
    {
        $result = $this->html;

        $result = preg_replace_callback('/<img\s+([^>]*?)>/i', function ($matches) {
            $doc = new \DOMDocument();
            $doc->loadHTML($matches[0]);
            $dom = simplexml_import_dom($doc);
            $nodes = $dom->xpath('//img');

            foreach ($nodes as $v) {
                $v = (array) $v;
                if (isset($v['@attributes']['src'])) {
                    $extAttrs = '';
                    foreach ($v['@attributes'] as $kk => $vv) {
                        $extAttrs .= $kk . '="' . $vv . '" ';
                    }
                    return '<image '. trim($extAttrs, ' ') .'></image>';
                }
            }
            return '';
        }, $result);

        foreach ($this->htmlTags as $k => $v) {
            $result = preg_replace('/<'.$k.'\s+([^>]*?)>(.*?)\<\/'.$k.'>/is', '<'.$v.' $1 data-htmltag="'.$k.'">$2</'.$v.'>', $result);
        }

        return $result;
    }
}
