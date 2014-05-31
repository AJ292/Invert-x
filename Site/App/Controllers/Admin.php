<?php
 
class AdminController extends Controller {
    public $authorise = array(
        '*' => true
    );

    function BeforeExecute()
    {
        $banners = array(
            'banner-admin-1.jpg',
            'banner-admin-2.jpg',
            'banner-admin-3.jpg',
            'banner-admin-4.jpg',
            'banner-admin-5.jpg',
            'banner-admin-6.jpg',
            'banner-admin-7.jpg',
            'banner-admin-8.jpg',
            'banner-admin-9.jpg'
        );

        $joke_options = array(
            array('box', 'Your Russian Bride Has Arrived'),
            array('coffee', 'Go And Get Some Coffee'),
            array('drugs', 'Drugs Help Ease The Pain'),
            array('goldmine', 'Host Ads, Make Cash'),
            array('mysterybox', 'Look In The Mystery Box'),
            array('shutdown', 'Shut Down The Internet'),
            array('trappedcat', 'This Cat Is Trapped In a File')
        );

        $this->viewData['no_topic'] = true;
        $this->viewData['banner'] = $banners[mt_rand(0, count($banners) - 1)];
        $this->viewData['joke'] = $joke_options[mt_rand(0, count($joke_options) - 1)];
        $this->viewData['body_class'] = 'game-article';
        Templating::SetPageTitle('Here Be Dragons!');
    }

    function Index()
    {
        return $this->View();
    }

    function CreateTopic($type)
    {
        if ($type != 'Dual' && $type != 'Single') return $this->RedirectToAction('Index');

        $model = Post::Bind('Topic');
        if (Post::IsPostBack()) {

            if ($type == 'Dual') {
                $users = Post::Get('Users', array());
                if (count($users) != 2) Validation::AddError('Users', 'You must select exactly 2 authors.');
            }

            $image = Post::File('BannerImage');
            $image->Validate(true, 0, array(), array('jpg', 'png'));
            $small_image = Post::File('ArchivesImage');
            $small_image->Validate(true, 0, array(), array('jpg', 'png'));

            $model->Type = $type;

            if (Validation::Validate($model)) {

                $image->Save(Vars::$banners_dir . $model->Url . '.' . $image->GetExtension());
                $model->BannerImage = $model->Url . '.' . $image->GetExtension();
                $small_image->Save(Vars::$banners_dir . 'Small-' . $model->Url . '.' . $small_image->GetExtension());
                $model->ArchivesImage = 'Small-' . $model->Url . '.' . $small_image->GetExtension();
                $model->Published = false;

                require_once dirname(__FILE__).'/../Plugins/modifier.bbcode.php';
                $model->HtmlNewsText = smarty_modifier_bbcode($model->NewsText, 'comment');
                $model->HtmlClosingText = smarty_modifier_bbcode($model->ClosingText, 'comment');

                $model->Save();

                $left = new Article();
                $left->TopicID = $model->ID;
                $left->UserID = $type == 'Dual' ? $users[0] : Authentication::GetUserID();
                $left->TagLine = '';
                $left->Content = '';
                $left->HtmlContent = '';
                $left->Shines = 0;
                $left->OrderIndex = -1;
                $left->Ready = false;
                $left->Save();

                if ($type == 'Dual') {
                    $right = new Article();
                    $right->TopicID = $model->ID;
                    $right->UserID = $users[1];
                    $right->TagLine = '';
                    $right->Content = '';
                    $right->HtmlContent = '';
                    $right->Shines = 0;
                    $right->OrderIndex = 1;
                    $right->Ready = false;
                    $right->Save();
                }

                $tags = explode(',', Post::Get('TopicTags', ''));
                foreach ($tags as $tag) {
                    if (strlen(trim($tag)) == 0) continue;
                    $t = new TopicTag();
                    $t->TopicID = $model->ID;
                    $t->Tag = trim($tag);
                    $t->Save();
                }

                return $this->RedirectToAction('EditArticle', 'Admin', $model->ID);
            }
        }
        $this->viewData['Users'] = CustomQuery::Query('SELECT ID, Name FROM Users U');

        $allTags = CustomQuery::Query('SELECT Tag FROM NewsTags UNION SELECT Tag FROM TopicTags ORDER BY Tag');

        $tags = [];
        foreach ($allTags as $tag) $tags[] = $tag->Tag;
        $this->viewData['AllTags'] = implode(',', $tags);

        $this->viewData['TopicTags'] = Post::Get('TopicTags');

        $this->viewData['Type'] = $type;
        $this->viewData['CategoryID'] = Query::Create('Category')->All();

        return $this->View($model);
    }

    function Topics() {
        $this->viewData['drafts'] = CustomQuery::Query('SELECT ID, Title, Type FROM Topics WHERE Published = 0 ORDER BY Date DESC');
        $published = CustomQuery::Query('SELECT ID, Title, Type FROM Topics WHERE Published > 0 ORDER BY Date DESC');
        return $this->View($published);
    }

    function EditArticle($id) {
        $topic = new Topic($id);
        $this->viewData['articles'] = $topic->Find('Article');
        $this->viewData['UserID'] = CustomQuery::Query('SELECT ID, Name FROM Users U');
        return $this->View($topic, 'EditArticle' . $topic->Type);
    }

    function EditArticle_Post($id)
    {
        $topic = new Topic($id);
        $article = new Article(Post::Get('ID'));
        if ($article->ID === null || ($topic->Published == 0 && $article->UserID != Authentication::GetUserID())) {
            return $this->RedirectToAction('EditArticle', 'Admin', $topic->ID);
        }
        $article = Post::Bind($article);
        if (Validation::Validate($article)) {
            require_once dirname(__FILE__).'/../Plugins/modifier.bbcode.php';
            $article->HtmlContent = smarty_modifier_bbcode($article->Content);
            $article->Save();
            if (Post::Get('Switch', false)) {
                Database::NonQuery('UPDATE Articles SET OrderIndex = OrderIndex * -1 WHERE TopicID = :id', array('id' => $id));
            }
            return $this->RedirectToAction('EditArticle', 'Admin', $id);
        }
        $this->viewData['articles'] = $topic->Find('Article');
        $this->viewData['UserID'] = CustomQuery::Query('SELECT ID, Name FROM Users U');
        return $this->View($topic, 'EditArticle' . $topic->Type);
    }

    function EditTopic($id)
    {
        $topic = new Topic($id);
        $this->viewData['origtitle'] = $topic->Title;
        $model = Post::Bind($topic);
        if (Post::IsPostBack()) {
            $image = Post::File('BannerImage');
            $image->Validate(false, 0, array(), array('jpg', 'png'));
            $small_image = Post::File('ArchivesImage');
            $small_image->Validate(false, 0, array(), array('jpg', 'png'));
            if (Validation::Validate($model)) {
                // Save
                $new_image = Vars::$banners_dir . $model->Url . '.' . $image->GetExtension();
                $old_image = Vars::$banners_dir . $model->BannerImage;
                if ($image->Save($new_image) !== null) {
                    $model->BannerImage = $model->Url . '.' . $image->GetExtension();
                    if (file_exists($old_image) && $old_image != $new_image) {
                        unlink($old_image);
                    }
                }
                $new_image = Vars::$banners_dir . 'Small-' . $model->Url . '.' . $small_image->GetExtension();
                $old_image = Vars::$banners_dir . $model->ArchivesImage;
                if ($small_image->Save($new_image)) {
                    $model->ArchivesImage = 'Small-' . $model->Url . '.' . $small_image->GetExtension();
                    if (file_exists($old_image) && $old_image != $new_image) {
                        unlink($old_image);
                    }
                }

                require_once dirname(__FILE__).'/../Plugins/modifier.bbcode.php';
                $model->HtmlNewsText = smarty_modifier_bbcode($model->NewsText, 'comment');
                $model->HtmlClosingText = smarty_modifier_bbcode($model->ClosingText, 'comment');
                $model->Save();

                $tags = explode(',', Post::Get('TopicTags', ''));
                Database::NonQuery("DELETE FROM TopicTags WHERE TopicID = :id", array('id' => $model->ID));
                foreach ($tags as $tag) {
                    if (strlen(trim($tag)) == 0) continue;
                    $t = new TopicTag();
                    $t->TopicID = $model->ID;
                    $t->Tag = trim($tag);
                    $t->Save();
                }

                return $this->RedirectToAction('EditArticle', 'Admin', $model->ID);
            }
        }

        $allTags = CustomQuery::Query('SELECT Tag FROM NewsTags UNION SELECT Tag FROM TopicTags ORDER BY Tag');
        $newsTags = CustomQuery::Query('SELECT Distinct Tag FROM TopicTags WHERE TopicID = :id ORDER BY Tag', array('id' => $id));

        $tags = [];
        foreach ($allTags as $tag) $tags[] = $tag->Tag;
        $this->viewData['AllTags'] = implode(',', $tags);

        $tags = [];
        foreach ($newsTags as $tag) $tags[] = $tag->Tag;
        $this->viewData['TopicTags'] = implode(',', $tags);

        $this->viewData['Type'] = $model->Type;
        $this->viewData['CategoryID'] = Query::Create('Category')->All();

        return $this->View($model);
    }

    function PreviewArticle($id)
    {
        $article = new Article($id);
        $topic = $article->Get('Topic');
        if ($article->ID === null || ($topic->Published == 0 && $article->UserID != Authentication::GetUserID())) {
            return $this->RedirectToAction('EditArticle', 'Admin', $topic->ID);
        }
        $this->viewData['side'] = $article->OrderIndex > 0 ? 'right' : 'left';
        $this->viewData['banner'] = '/Banners/' . $topic->BannerImage;
        $this->viewData['topic'] = $topic;
        $this->viewData['use_alt'] = !!$topic->UseDarkTheme;
        Templating::SetPageTitle('Here Be Dragons!');
        return $this->View($article);
    }

    function PublishTopic($id)
    {
        $topic = new Topic($id);
        $articles = $topic->Find('Article');
        if ($topic->Type == 'Dual') {
            $this->viewData['can_publish'] = count($articles) == 2 && $articles[0]->Ready && $articles[1]->Ready;
        } else if ($topic->Type == 'Single') {
            $this->viewData['can_publish'] = count($articles) == 1;
        } else {
            $this->viewData['can_publish'] = false;
        }
        if (Post::IsPostBack() && $this->viewData['can_publish']) {
            $topic->Published = true;
            $topic->Save();
            return $this->RedirectToRoute($topic->Url);
        }
        return $this->View($topic);
    }

    function CreateNews()
    {
        $model = Post::Bind('News');
        if (Post::IsPostBack()) {
            $image = Post::File('Image');
            $image->Validate(true, 0, array(), array('jpg', 'png'));
            $model->Image = '<placeholder>';
            if (Validation::Validate($model)) {
                require_once dirname(__FILE__).'/../Plugins/modifier.bbcode.php';
                $model->HtmlSummary = smarty_modifier_bbcode($model->Summary);
                $model->HtmlContent = smarty_modifier_bbcode($model->Content);
                $model->UserID = Authentication::GetUserID();
                $model->Save();
                $image->Save(Vars::$news_dir . 'news-' . $model->ID . '.' . $image->GetExtension());
                $model->Image = 'news-' . $model->ID . '.' . $image->GetExtension();
                $model->Save();

                $tags = explode(',', Post::Get('NewsTags', ''));
                foreach ($tags as $tag) {
                    if (strlen(trim($tag)) == 0) continue;
                    $t = new NewsTag();
                    $t->NewsID = $model->ID;
                    $t->Tag = trim($tag);
                    $t->Save();
                }

                return $this->RedirectToAction('News', 'Home', $model->ID);
            }
        }

        $allTags = CustomQuery::Query('SELECT Tag FROM NewsTags UNION SELECT Tag FROM TopicTags ORDER BY Tag');

        $tags = [];
        foreach ($allTags as $tag) $tags[] = $tag->Tag;
        $this->viewData['AllTags'] = implode(',', $tags);

        $this->viewData['NewsTags'] = Post::Get('NewsTags');

        $this->viewData['CategoryID'] = Query::Create('Category')->All();

        return $this->View($model);
    }

    function News()
    {
        $newses = Query::Create('News')
                ->OrderBy('Created', 'DESC')
                ->All();
        return $this->View($newses);
    }

    function EditNews($id)
    {
        $news = new News($id);
        $this->viewData['origheading'] = $news->Heading;
        $model = Post::Bind($news);
        if (Post::IsPostBack()) {
            $image = Post::File('Image');
            $image->Validate(false, 0, array(), array('jpg', 'png'));
            if (Validation::Validate($model)) {
                require_once dirname(__FILE__).'/../Plugins/modifier.bbcode.php';
                $model->HtmlSummary = smarty_modifier_bbcode($model->Summary);
                $model->HtmlContent = smarty_modifier_bbcode($model->Content);

                $new_image = Vars::$news_dir . 'news-' . $model->ID . '.' . $image->GetExtension();
                $old_image = Vars::$news_dir . $model->Image;
                if ($image->Save($new_image) !== null) {
                    $model->Image = 'news-' . $model->ID . '.' . $image->GetExtension();
                    if (file_exists($old_image) && $old_image != $new_image) {
                        unlink($old_image);
                    }
                }
                $model->Save();

                $tags = explode(',', Post::Get('NewsTags', ''));
                Database::NonQuery("DELETE FROM NewsTags WHERE NewsID = :id", array('id' => $model->ID));
                foreach ($tags as $tag) {
                    if (strlen(trim($tag)) == 0) continue;
                    $t = new NewsTag();
                    $t->NewsID = $model->ID;
                    $t->Tag = trim($tag);
                    $t->Save();
                }

                return $this->RedirectToAction('News', 'Home', $model->ID);
            }
        }

        $allTags = CustomQuery::Query('SELECT Tag FROM NewsTags UNION SELECT Tag FROM TopicTags ORDER BY Tag');
        $newsTags = CustomQuery::Query('SELECT Distinct Tag FROM NewsTags WHERE NewsID = :id ORDER BY Tag', array('id' => $id));

        $tags = [];
        foreach ($allTags as $tag) $tags[] = $tag->Tag;
        $this->viewData['AllTags'] = implode(',', $tags);

        $tags = [];
        foreach ($newsTags as $tag) $tags[] = $tag->Tag;
        $this->viewData['NewsTags'] = implode(',', $tags);

        $this->viewData['CategoryID'] = Query::Create('Category')->All();

        return $this->View($model);
    }

    function DeleteNews($id) {
        $news = new News($id);
        if (Post::IsPostBack()) {
            $news->Delete();
            Database::NonQuery("DELETE FROM NewsTags WHERE NewsID = :id", array('id' => $news->ID));
            return $this->RedirectToAction('News', 'Admin');
        }
        return $this->View($news);
    }
}
