<?php

class HomeController extends Controller
{
    function Index()
    {
        $this->viewData['topics'] = CustomQuery::Query(
            'SELECT T.ID, T.Url, T.Title, T.TagLine, T.Date, T.ArchivesImage, T.BannerImage, C.Class
            FROM Topics T
            LEFT JOIN Categories C ON T.CategoryID = C.ID
            WHERE T.Published > 0
            ORDER BY T.Date DESC, ID DESC
            LIMIT 10');
        $this->viewData['activities'] = CustomQuery::Query(
            "SELECT *
            FROM (
                SELECT 'News' AS Type, N.ID, N.Heading, N.HtmlSummary, N.Image, N.Created, U.ID AS UserID, U.Name AS UserName, C.Class, S.Name AS SectionName
                FROM News N
                LEFT JOIN Users U ON N.UserID = U.ID
                LEFT JOIN Categories C ON N.CategoryID = C.ID
                LEFT JOIN NewsSections S ON N.SectionID = S.ID
                UNION
                SELECT 'Topic' AS Type, T.ID, T.Title, T.Url, T.ArchivesImage, T.Date, 0, '', C.Class, ''
                FROM Topics T
                LEFT JOIN Categories C ON T.CategoryID = C.ID
                WHERE T.Published > 0
            ) A
            ORDER BY Created DESC, ID DESC
            LIMIT 15"
        );
        $this->viewData['body_class'] = 'home';
        Templating::SetPageTitle('');
        return $this->View();
    }

    function Article($url)
    {
        $topic = CustomQuery::Query(
            'SELECT T.ID, T.Title, T.TagLine, C.Class AS Class, T.Url,
            T.Type, T.Date, T.BannerImage, T.HtmlNewsText, T.HtmlClosingText, T.UseDarkTheme
            FROM Topics T
            LEFT JOIN Categories C ON T.CategoryID = C.ID
            WHERE T.Url = :url',
            array('url' => $url));
        if (count($topic) == 0) return $this->RedirectToAction('Index');
        $topic = $topic[0];

        $pq = CustomQuery::Query('SELECT Url, Title FROM Topics WHERE Published > 0 AND (Date, ID) < (:date, :id) ORDER BY Date DESC, ID DESC LIMIT 1', array('date' => $topic->Date, 'id' => $topic->ID));
        $this->viewData['prev'] = count($pq) > 0 ? $pq[0] : null;

        $nq = CustomQuery::Query('SELECT Url, Title FROM Topics WHERE Published > 0 AND (Date, ID) > (:date, :id) ORDER BY Date ASC, ID ASC LIMIT 1', array('date' => $topic->Date, 'id' => $topic->ID));
        $this->viewData['next'] = count($nq) > 0 ? $nq[0] : null;

        Templating::SetPageTitle($topic->Title);
        $this->viewData['articles'] = CustomQuery::Query(
            'SELECT A.ID, A.TopicID, A.UserID, U.Name AS UserName, U.AvatarImage,
            A.TagLine, A.HtmlContent, A.OrderIndex
            FROM Articles A
            LEFT JOIN Users U ON A.UserID = U.ID
            WHERE A.TopicID = :id
            ORDER BY A.OrderIndex',
            array('id' => $topic->ID));

        $this->viewData['tags'] = Query::Create('TopicTag')
                ->Where('TopicID', '=', $topic->ID)
                ->All();
        $this->viewData['body_class'] = $topic->Class . ' ' . ($topic->Type == 'Dual' ? 'dual-article' : 'feature-article');
        return $this->View($topic);
    }

    function News($id)
    {
        $news = CustomQuery::Query(
            'SELECT N.ID, N.Heading, N.Image, N.HtmlContent, N.Created, U.Name AS UserName, U.AvatarImage, C.Class, S.Name AS SectionName
            FROM News N
            LEFT JOIN Users U ON N.UserID = U.ID
            LEFT JOIN Categories C ON N.CategoryID = C.ID
            LEFT JOIN NewsSections S ON N.SectionID = S.ID
            WHERE N.ID = :id',
            array('id' => $id));

        if (count($news) == 0) return $this->RedirectToAction('Index');
        $news = $news[0];

        $this->viewData['tags'] = Query::Create('NewsTag')
                ->Where('NewsID', '=', $id)
                ->All();
        $this->viewData['body_class'] = $news->Class . ' ' . 'news';
        Templating::SetPageTitle($news->Heading);
        return $this->View($news);
    }

    function Category($id)
    {
        $cat = new Category($id);
        $topics = CustomQuery::Query(
                    'SELECT T.ID, T.Url, T.Title, T.TagLine, T.Date, T.ArchivesImage, T.BannerImage, C.Class
                    FROM Topics T
                    LEFT JOIN Categories C ON T.CategoryID = C.ID
                    WHERE T.Published > 0
                    AND CategoryID = :id
                    ORDER BY T.Date DESC, ID DESC',
                    array('id' => $id));

        $this->viewData['latest'] = $topics[0];
        $this->viewData['recent'] = array_slice($topics, 1, 10);
        $rem = array_slice($topics, 10);
        $len = ceil(count($rem) / 3);
        $this->viewData['remaining'] = array(
            array_slice($rem, 0, $len),
            array_slice($rem, $len, $len),
            array_slice($rem, $len * 2)
        );
        $this->viewData['body_class'] = $cat->Class . ' archive';
        Templating::SetPageTitle($cat->Name);
        return $this->View($cat);
    }

    function Tag($tag, $page = 1)
    {
        if (!is_numeric($page)) $page = 1;
        $offset = ($page-1)*10;
        $tags = CustomQuery::Query(
                "SELECT *
                FROM (
                    SELECT DISTINCT 'News' AS Type, N.ID, N.Heading, '' AS Url, N.HtmlSummary, N.Image, N.Created, U.ID AS UserID, U.Name AS UserName, C.Class, S.Name AS SectionName
                    FROM NewsTags NT
                    LEFT JOIN News N ON NT.NewsID = N.ID
                    LEFT JOIN Users U ON N.UserID = U.ID
                    LEFT JOIN Categories C ON N.CategoryID = C.ID
                    LEFT JOIN NewsSections S ON N.SectionID = S.ID
                    WHERE NT.Tag = :tag
                    UNION
                    SELECT DISTINCT 'Topic' AS Type, T.ID, T.Title, T.Url, T.TagLine, T.ArchivesImage, T.Date, 0, '', C.Class, ''
                    FROM TopicTags TT
                    LEFT JOIN Topics T ON TT.TopicID = T.ID
                    LEFT JOIN Categories C ON T.CategoryID = C.ID
                    WHERE T.Published > 0
                    AND TT.Tag = :tag
                ) A
                ORDER BY Created DESC, ID DESC
                LIMIT $offset,10",
                array('tag' => $tag));
        $this->viewData['tag'] = $tag;
        $this->viewData['body_class'] = 'games tagged';
        Templating::SetPageTitle($tag);
        return $this->View($tags);
    }

    function About()
    {
        $this->viewData['body_class'] = 'games basic-page';
        return $this->View();
    }

    function Rss()
    {
        header('Content-Type: text/xml; charset=UTF-8');
        $feed = CustomQuery::Query(
                "SELECT *
                FROM (
                    SELECT 'News' AS Type, N.ID, N.Heading, N.HtmlSummary, N.HtmlContent, CONCAT('Home/News/', N.ID) AS Url, N.Image, N.Created, U.ID AS UserID, U.Name AS UserName
                    FROM News N
                    LEFT JOIN Users U ON N.UserID = U.ID
                    LEFT JOIN Categories C ON N.CategoryID = C.ID
                    LEFT JOIN NewsSections S ON N.SectionID = S.ID
                    UNION
                    SELECT 'Topic' AS Type, T.ID, T.Title, '', '', T.Url, T.ArchivesImage, T.Date, 0, ''
                    FROM Topics T
                    LEFT JOIN Categories C ON T.CategoryID = C.ID
                    WHERE T.Published > 0
                ) A
                ORDER BY Created DESC, ID DESC
                LIMIT 50"
            );
        $ids = [];
        foreach ($feed as $f) if ($f->Type == 'Topic') $ids[] = $f->ID;
        $ids = implode(',', $ids);
        $articles = [];
        $aq = CustomQuery::Query(
            "SELECT A.TopicID, A.TagLine, A.HtmlContent, U.ID AS UserID, U.Name AS UserName
            FROM Articles A
            LEFT JOIN Users U ON A.UserID = U.ID
            WHERE A.TopicID IN ($ids)
            ORDER BY A.OrderIndex");
        foreach ($aq as $a) {
            $tid = $a->TopicID;
            if (!array_key_exists($tid, $articles)) $articles[$tid] = array();
            $articles[$tid][] = $a;
        }
        $this->viewData['date'] = $feed[0]->Created;
        $this->viewData['articles'] = $articles;
        return $this->Render($feed);
    }
}
