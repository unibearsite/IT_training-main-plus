<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Customer;
use App\Models\Lesson;
use App\Models\Course;

class rankingController extends Controller
{
  public function __invoke( Request $request )
  {
    $cstPosts = DB::table( 'customers as cst' )
                     ->select( 'cst.name', 'lsn.title', 'lsn.lesson_id' )
                     ->join( 'lessons as lsn', function( $join ) {
                $join->on( 'cst.lesson_id', 'lsn.lesson_id' )
                     ->where( 'cst.lesson_id', '!=', '19' );
                })
                ->orderBy( 'lesson_id', 'DESC' )->limit( 10 )->get();

    return view( 'ranking', compact( 'cstPosts' ));
  }
}
