<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 11/12/14
 * Time: 7:10 PM
 */
class RssFeedsController extends BaseController {

    /**
     * RssFeed Model
     * @var rssFeed
     */
    protected $rssFeed;

    /**
     * Inject the models.
     * @param RssFeed $rssFeed
     */
    public function __construct(RssFeed $rssFeed)
    {
        parent::__construct();
        $this->rssFeed = $rssFeed;
    }

    /**
     * Users settings page
     *
     * @return View
     */
    public function getIndex()
    {
        // Show the page
        $title = 'Our RSS Feeds';
        $myFeeds = $this->rssFeed;
        /*Blade::setContentTags('<%', '%>'); // for variables and all things Blade
        Blade::setEscapedContentTags('<%%', '%%>'); // for escaped data*/

        return View::make('site/rssfeeds', compact('myFeeds', 'title'));
    }


    /**
     * Users settings page
     *
     * @return View
     */
    public function getData()
    {
        // Show the page
        echo json_encode( DB::table('rssfeeds')->lists('url') );
        exit;
        return View::make('site/rssfeeds', compact('myFeeds', 'title'));
    }



}
