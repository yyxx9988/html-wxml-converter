<?php

namespace yyxx9988\mlconverter;

class Converter
{
    private $html;

    private $htmlTags = [
        'div' => 'view',
        'section' => 'view',
        'ul' => 'view',
        'li' => 'view',
        'p' => 'view',

        'span' => 'text',
        'i' => 'text',
        'b' => 'text',
        'strong' => 'text',
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
            $result = preg_replace('/<'.$k.'\s+([^>]*?)>(.*?)\<\/'.$k.'>/is', '<'.$v.' $1>$2</'.$v.'>', $result);
        }

        return $result;
    }
}
