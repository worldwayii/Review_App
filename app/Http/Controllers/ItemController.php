<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\User;
use App\Models\Item;
use App\Models\Vote;
use App\Models\Image;
use App\Models\Review;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
     /**
     * Display the selected Item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showItem($sku)
    {
        $item = Item::where('sku', $sku)->with('images')->with('manufacturer')->first();
        $itemReviews = Review::where('item_id', $item->id)->with('votes')->paginate(5);
        $reviews = Review::where('item_id', $item->id)->orderBy('created_at', 'desc')->get();
        $ratings = Review::where('item_id', $item->id)->orderBy('rating', 'desc')->get();
        $recommends = Review::distinct()->where('item_id', '>', 1)->get();
        return view('item.index', compact('item', 'itemReviews', 'reviews', 'ratings', 'recommends'));
    }

    /**
     * Show the form for creating a new Item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $refinedName = preg_replace('/\s+/', '', $request->item_name);
        $refinedManufacturer = preg_replace('/\s+/', '', $request->manufacturer);

        $validate = \Validator::make($request->all(), array(
            'item_name' => 'required|unique:items,name',
            'price' => 'required',
            'manufacturer' => 'required|unique:manufacturers,name',
            'url' => 'required',
            'path' => 'required|mimes:jpeg,jpg,png',
            'about' => 'required'
        ));
        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        else
        {
            //save to manufacturers table first
            $manufacturer = new Manufacturer();
            $manufacturer->name = $request->manufacturer;
            $manufacturer->sku = $refinedManufacturer.'-m-a'.rand(1,9);
            $manufacturer->save();


            $item = new Item();
            $item->name = $request->item_name;
            $item->sku = $refinedName.rand(1000,6000);
            $item->price = $request->price;
            $item->manufacturer_id = $manufacturer->id;
            $item->about = $request->about;
            $item->url = $request->url;
            $item->save();

            $img = Storage::disk('local')->put('public', $request->path);
            $image = new Image();
            $image->path = $img;
            $image->item_id = $item->id;
            $image->save();

            Session::flash('success', 'You have created a new Item.');
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sku)
    {
        $item = Item::where('sku', $sku)->first();
        return view('item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate = \Validator::make($request->all(), array(
            'item_name' => 'required',
            'price' => 'required',
            'manufacturer' => 'required',
            'url' => 'required',
            'path' => 'mimes:jpeg,jpg,png',
            'about' => 'required'
        ));
        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        else
        {
            
            $item = Item::find($request->item_id);
            $item->name = $request->item_name;
            $item->price = $request->price;
            $item->about = $request->about;
            $item->url = $request->url;
            $item->update();

            if($request->path){
                $image = Image::where('iten_id', $request->item_id)->first();
                $img = Storage::disk('local')->put('public', $request->path);
                $image->item_id = $item->id;
                $image->user_id = Auth::user()->id;
                $image->update();
            }

            Session::flash('success', 'Item has been updated successfully.');
            return redirect('item/'.$item->sku);
        }
    }

    /**
     * Remove the specified Item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sku)
    {
        $item = Item::where('sku',$sku)->delete();

        Session::flash('success', 'You have just deleted an Item.');
        return redirect('/');
    }

    /**
     * Show the form for adding more image to and item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addImage($sku)
    { 
        $item = Item::where('sku', $sku)->with('images')->with('manufacturer')->first();
        return view('item.upload', compact('item'));
    }

    /**
     * Upload new image to a particular Item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeImage(Request $request)
    {
        $validate = \Validator::make($request->all(), array(
            'path' => 'required|mimes:jpeg,jpg,png',
        ));
        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        else
        {
            $img = Storage::disk('local')->put('public', $request->path);
            $image = new Image();
            $image->path = $img;
            $image->item_id = $request->item_id;
            $image->user_id = Auth::user()->id;
            $image->save();

            Session::flash('success', 'Image has been added successfully.');
            return redirect('item/'.$image->item->sku);
        }

    }

     /**
     * Show for for reviewing an Item.
     *
     * @param  varchar  $sku
     * @return \Illuminate\Http\Response
     */
    public function getReview($sku)
    {
        $item = Item::where('sku', $sku)->first();
        return view('item.review', compact('item'));
    }

    /**
     * Store a review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeReview(Request $request)
    {

        $validate = \Validator::make($request->all(), array(
            'comment' => 'required|min:15',
            'rating' => 'required',
        ));
        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        else
        {
             $item = Item::find($request->item_id);
             $userPastReview = Review::where('user_id', $request->user_id)->where('item_id', $request->item_id)->first();
              if(!$userPastReview){
                 $review =  new Review();
                 $review->rating = $request->rating;
                 $review->comment = $request->comment;
                 $review->item_id = $request->item_id;
                 $review->user_id = $request->user_id;
                 $review->save();

                Session::flash('success', 'Your review has been posted.');
                return redirect('item/'.$item->sku);

              }
            Session::flash('fail', 'Your can not review a Item twice');
            return redirect('item/'.$item->sku);
        }
    }

     /**
     * Show the form for editing the specified review.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editReview($id)
    {
        $review = Review::find($id);
        $item = Item::find($review->item_id);
        return view('item.edit-review', compact('review', 'item'));
    }

    /**
     * Update the specified review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateReview(Request $request)
    {

        $validate = \Validator::make($request->all(), array(
            'comment' => 'required|min:15',
            'rating' => 'required',
        ));
        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        else
        {
            $review = Review::find($request->review_id);
            $review->comment = $request->comment;
            $review->rating = $request->rating;
            $review->update();

            Session::flash('success', 'Your previous review has been updated successfully.');
            return redirect('item/'.$review->item->sku);
        }
    }

    /**
     * Remove the specified review.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyReview($id)
    {
        $review = Review::find($id)->delete();

        Session::flash('success', 'You have just deleted your review.');
        return redirect('/');
    }

    /**
     * like the comment in a review.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {
        
        //check if the reviewer has liked this particular comment before
        $checkLike = Vote::where('review_id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->where('vote', 1)->first();
        if(!$checkLike){ 
            // check if the user has disliked this review previously
            $checkDislike = Vote::where('review_id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->where('vote', 0)->first();
                           
            if($checkDislike){
                 $checkDislike->vote = 1;
                 $checkDislike->update();

                 Session::flash('success', 'You have now liked this review.');
                 return back();
            }

            $like = new Vote();
            $like->review_id = $id;
            $like->user_id = Auth::user()->id;
            $like->vote = 1;
            $like->save();

            Session::flash('success', 'You just liked a review.');
            return back();
        }
            Session::flash('fail', 'You have already liked the comment.');
            return back();
    }

     /**
     * dislike the comment in a  review.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dislike($id)
    {
        //check if the reviewer has disliked this particular comment before
         $checkDislike = Vote::where('review_id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->where('vote', 0)->first();
          if(!$checkDislike){ 
            // check if the user has disliked this review previously
            $checkLike = Vote::where('review_id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->where('vote', 1)->first();
                           
            if($checkLike){
                 $checkLike->vote = 0;
                 $checkLike->update();

                 Session::flash('success', 'You have now disliked this review.');
                 return back();
            }

        $like = new Vote();
        $like->review_id = $id;
        $like->user_id = Auth::user()->id;
        $like->vote = 0;
        $like->save();

        Session::flash('success', 'You just disliked a review.');
        return back();
        }
         Session::flash('fail', 'You have already disliked the comment.');
         return back();
    }


    /**
     * follow a reviewer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function follow($id)
    {
        $user = User::find($id);
 
        if(Auth::user()->id == $id){
            Session::flash('fail', 'You can\'t follow yourself.');
            return back();
        }
        //also check if the $id has been followed before
        $followedUser = Follower::where('follower_id', Auth::user()->id)
                                    ->where('followee_id', $id)->first();

            $follower = New Follower();
            $follower->follower_id = Auth::user()->id;
            $follower->followee_id = $id;
            $follower->save();

            Session::flash('success', 'You just followed '.$user->full_name);
            return redirect('followers');
    }

    /**
     * unfollow a reviewer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unfollow($id)
    {
        // the follower_id has been passed, so we just delete the record
        $follower = Follower::find($id)->delete();

        Session::flash('success', 'You just unfollwed a user');
        return redirect('followers');
    }

    /**
     * Show the user followed by an authenticated user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFollowers()
    {
        $followers = Follower::where('follower_id', Auth::user()->id)->get();
        $recommends = Review::distinct()->where('item_id', '>', 1)->get();
        return view('item.user.followers', compact('followers', 'recommends'));
    }

    /**
     * Show reviewed made by a chosen user in auth user's friend list.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserReviews($id)
    {
        $reviews = Review::where('user_id', $id)->get();
        return view('item.user.reviews', compact('reviews'));
    }

    /**
     * Show users followed by this particular user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserFriends($id)
    {
        $followers = Follower::where('follower_id', $id)->get();
        return view('item.user.friends', compact('followers'));
    }
}
