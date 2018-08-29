<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\user_review;
 
class RestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function list()
    {
        try {
            $menu = DB::table('user_review')->get();
            $res['success'] = true;
            $res['data'] = $menu;
            $res['count'] = $menu->count();
            return response($res, 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            $res['success'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 500);
        }
    }
    
    public function save(Request $request)
    {
        try {
            $order_id = $request->input('order_id');
            $product_id = $request->input('product_id');
            $user_id = $request->input('user_id');
            $rating = $request->input('rating');
			$review = $request->input('review');
            $save = user_review::create([
                'order_id'=> $order_id,
                'product_id'=> $product_id,
                'user_id'=> $user_id,
                'rating'=> $rating,
				'review'=> $review
            ]);
            $res['success'] = true;
            return response($res, 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            $res['success'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 500);
        }
    }
    public function update(Request $req)
    {
        try {
            $review = user_review::find($req->input("id"));
            if ($review) {
                $review->order_id = $req->input("order_id");
                $review->product_id = $req->input("product_id");
                $review->user_id = $req->input("user_id");
                $review->rating = $req->input("rating");
				$review->review = $req->input("review");
                $review->save();
                $res['success'] = true;
                return response($res, 200);
            } else {
                $res['success'] = false;
                $res['message'] = 'Review not found';
                return response($res, 200);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            $res['success'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 500);
        }
    }
    public function delete(Request $req)
    {
      try {
          $review = user_review::find($req->input("id"));
          if ($review) {
              $review->delete();
              $res['success'] = true;
              return response($res, 200);
          } else {
              $res['success'] = false;
              $res['message'] = 'Review not found';
              return response($res, 200);
          }
      } catch (\Illuminate\Database\QueryException $ex) {
          $res['success'] = false;
          $res['message'] = $ex->getMessage();
          return response($res, 500);
      }
    }
}