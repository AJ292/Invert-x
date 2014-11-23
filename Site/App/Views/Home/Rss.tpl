<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
   <channel>
      <title><![CDATA[invert-x]]></title>
      <link>http://invert-x.com/</link>
        <image>
            <url>http://www.invert-x.com/favicon.png</url>
            <title>invert-x</title>
            <link>http://invert-x.com</link>
            <width>144</width>
            <height>144</height>
            <description>invert-x is a weekly look at topics of interest, be it gaming, technology or anything in between. There is no viewpoint: just the pure thoughts and opinions of the writers.</description>
        </image>
      <description>The non-competitive, duel to the death for two blogs</description>
      <language>en-au</language>
      <pubDate>{$date|date_format:"%a, %d %b %Y %T %Z"}</pubDate>
      <generator>Phoenix MVC v0.3, http://logic-and-trick.com/Projects/Phoenix</generator>
      <atom:link href="http://invert-x.com/Home/Rss" rel="self" type="application/rss+xml" />
      {foreach $model as $obj}
      <item>
         <title><![CDATA[{$obj->Heading}]]></title>
         <link>http://invert-x.com/{$obj->Url}</link>
         <description>
             {if $obj->Type == 'News'}
                 {$obj->HtmlSummary|escape}
                 {$obj->HtmlContent|escape}
             {elseif $obj->Type == 'Topic'}
                 {foreach $articles[$obj->ID] as $art}
                     &lt;h2&gt;{$art->UserName} &lt;/h2&gt;
                     &lt;h3&gt;{$art->TagLine}&lt;/h3&gt;
                     {$art->HtmlContent|escape}
                 {/foreach}
             {/if}
         </description>
         <pubDate>{$obj->Created|date_format:"%a, %d %b %Y %T %Z"}</pubDate>
         <guid>http://invert-x.com/{$obj->Url}</guid>
         <comments>http://invert-x.com/{$obj->Url}</comments>
      </item>
      {/foreach}
   </channel>
</rss>