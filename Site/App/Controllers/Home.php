<?php

class HomeController extends Controller
{
    function Index()
    {
        $this->viewData['topics'] = CustomQuery::Query(
            'SELECT T.ID, T.Url, T.Title, T.TagLine, T.Date, T.ArchivesImage, C.Class
            FROM Topics T
            LEFT JOIN Categories C ON T.CategoryID = C.ID
            WHERE T.Published > 0
            ORDER BY T.Date DESC
            LIMIT 10');
        $this->viewData['news'] = CustomQuery::Query(
            'SELECT N.ID, N.Heading, N.HtmlSummary, N.Image, N.Created, U.ID, U.Name AS UserName, C.Class, S.Name AS SectionName
            FROM News N
            LEFT JOIN Users U ON N.UserID = U.ID
            LEFT JOIN Categories C ON N.CategoryID = C.ID
            LEFT JOIN NewsSections S ON N.SectionID = S.ID
            LIMIT 10'
        );
        $this->viewData['body_class'] = 'game-article';
        return $this->View();
    }

    function Article($url)
    {
        $topic = CustomQuery::Query(
            'SELECT T.ID, T.Title, T.TagLine, C.Name AS CategoryName, T.Url,
            T.Type, T.Date, T.BannerImage, T.HtmlNewsText, T.UseDarkTheme
            FROM Topics T
            LEFT JOIN Categories C ON T.CategoryID = C.ID
            WHERE T.Url = :url',
            array('url' => $url));
        if (count($topic) == 0) return $this->RedirectToAction('Index');
        $topic = $topic[0];

        $pq = CustomQuery::Query('SELECT Url, Title FROM Topics WHERE Published > 0 AND Date < :date ORDER BY Date DESC LIMIT 1', array('date' => $topic->Date));
        $this->viewData['prev'] = count($pq) > 0 ? $pq[0] : null;

        $nq = CustomQuery::Query('SELECT Url, Title FROM Topics WHERE Published > 0 AND Date > :date ORDER BY Date ASC  LIMIT 1', array('date' => $topic->Date));
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

        $this->viewData['body_class'] = 'game-article';
        return $this->View($topic);
    }

    function News()
    {
        $this->viewData['body_class'] = 'game-article';
        return $this->View();
    }

    function Category($id)
    {
        $cat = new Category($id);
        $this->viewData['body_class'] = 'game-article';
        return $this->View($cat);
    }
}

?>
