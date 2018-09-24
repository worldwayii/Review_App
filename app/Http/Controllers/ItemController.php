<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Item;
use App\Models\Image;
use App\Models\Review;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    
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
     * Display the selected Item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showItem($sku)
    {
        $item = Item::where('sku', $sku)->with('images')->with('manufacturer')->first();
        $reviews = Review::where('item_id', $item->id)->orderBy('created_at', 'desc')->get();
        $ratings = Review::where('item_id', $item->id)->orderBy('rating', 'desc')->get();
        return view('item.index', compact('item', 'reviews', 'ratings'));
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
                $image->uploader_id = Auth::user()->id;
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
}
