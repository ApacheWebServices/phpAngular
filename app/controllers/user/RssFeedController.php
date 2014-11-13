<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 11/12/14
 * Time: 7:10 PM
 */
class RssFeedController extends BaseController {

    /**
     * User Model
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
        $title = 'My RSS Feeds';
        $myFeeds = $this->rssFeed;
        return View::make('site/user/rssfeed/index', compact('myFeeds', 'title'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // Title
        $title = 'Create new RSS Feed';

        // Show the page
        return View::make('site/user/rssfeed/create_edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $user = Auth::user();

        $this->rssFeed->title = Input::get( 'title' );
        $this->rssFeed->url = Input::get( 'url' );
        $this->rssFeed->user_id = $user->id;

        $this->rssFeed->save();

        if ( $this->rssFeed->id )
        {
            // Redirect to the rssfeed index
            return Redirect::to('rssfeed/' . $this->rssFeed->id . '/edit')->with('success', 'New RSS Feed is saved successfully');
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $this->rssFeed->errors()->all();

            return Redirect::to('rssfeed/create')
                ->with( 'error', $error );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $rssfeed
     * @return Response
     */
    public function getEdit( $rssfeed )
    {
        if ( $rssfeed->id )
        {
            // Title
            $title = "Edit RSS Feed";

            return View::make('site/user/rssfeed/create_edit', compact('rssfeed', 'title' ));
        }
        else
        {
            return Redirect::to('rssfeed/index')->with('error', Lang::get('admin/users/messages.does_not_exist'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param $comment
     * @return Response
     */
    public function postEdit($rssfeed)
    {
        // Declare the rules for the form validation
        $rules = array(
            'title' => 'required|min:3',
            'url' => 'required|min:10',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the comment post data
            $rssfeed->title = Input::get('title');
            $rssfeed->url = Input::get('url');

            // Was the comment post updated?
            if($rssfeed->save())
            {
                // Redirect to the new comment post page
                return Redirect::to('rssfeed/' . $rssfeed->id . '/edit')->with('success', 'The RSS Feed is saved');
            }

            // Redirect to the comments post management page
            return Redirect::to('rssfeed/' . $rssfeed->id . '/edit')->with('error', 'Error occured while saving the RSS feed');
        }

        // Form validation failed
        return Redirect::to('rssfeed/' . $rssfeed->id . '/edit')->withInput()->withErrors($validator);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $rssfeed
     * @return Response
     */
    public function getDelete($rssfeed)
    {
        // Title
        $title = "Delete RSS Feed";

        // Show the page
        return View::make('site/user/rssfeed/delete', compact('rssfeed', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $rssfeed
     * @return Response
     */
    public function postDelete($rssfeed)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $rssfeed->id;
            $rssfeed->delete();

            // Was the comment post deleted?
            $rssfeed = RssFeed::find($id);
            if(empty($rssfeed))
            {
                // Redirect to the comment posts management page
                return Redirect::to('rssfeed/index')->with('success', 'The RSS Feed is deleted successfully');
            }
        }
        // There was a problem deleting the comment post
        return Redirect::to('rssfeed/index')->with('error', 'Error occurred while deleting the RSS Feed');
    }


    /**
     * Show a list of all the comments formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $user = Auth::user();

        return Datatables::of( RssFeed::select(array('id', 'title', 'url', 'user_id'))  )

            ->edit_column('id', '<a href="{{{ URL::to(\'rssfeed/\'. $id .\'/edit\') }}}" class="iframe cboxElement">{{{ $id }}}</a>')

            ->edit_column('title', '<a href="{{{ URL::to(\'rssfeed/\'. $id .\'/edit\') }}}" class="iframe cboxElement">{{{ Str::limit($title, 40, \'...\') }}}</a>')

            ->edit_column('url', '<a href="{{{ URL::to(\'rssfeed/\'. $id .\'/edit\') }}}" class="iframe cboxElement">{{{ $url }}}</a>')

            ->add_column('actions', '<a href="{{{ URL::to(\'rssfeed/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-default btn-xs">{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'rssfeed/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

            ->remove_column('user_id')

            ->make();
    }

}
