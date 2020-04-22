<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //filter using one field

    //Raw Query
    /**
     * todo:Select * from actor where last_name='Berry' and last_name='Karl'
     */

//    $actors=DB::table('actor')->where('last_name','=','Berry')
//       ->get();

    //filter by many fields
//    $actors=DB::table('actor')->where('last_name','=','Berry')
//        ->where('first_name','=','Karl')
//        ->get();

    //OR
//    $actors=DB::table('actor')->where([
//        ['last_name','=','Berry'],
//        ['first_name','=','Karl']
//    ])->get();

    //Most professional method
//    $actors=DB::table('actor')->where(function($query) {
//        $query->where([
//            ['last_name','=','Berry'],
//            ['first_name','=','Karl']
//        ]);
//    })->get();

    //Raw Query
    /**
     * todo:Select last_name, count(*) As actor_count
     *      from actor
     *      group by last_name
     *      having actor_count > 2
     *      order by actor_count desc
     */

//    $actors_count=DB::table('actor')
//        ->select(['last_name',DB::raw('count(*) As actor_count')])
//        ->groupBy('last_name')
//        ->having('actor_count','>','2')
//        ->orderBy('actor_count','desc')
//        ->get();

    //Raw Query
    /**
     * TODO:select country_id, country
     *      from country
     *      where country in ('Afghanistan','Bangladesh','china')
     *      order by country_id DESC
     */
//    $countries=DB::table('country')
//        ->select(['country_id','country'])
//        ->whereIn('country',['Afghanistan','Bangladesh','china'])
//        ->orderBy('country_id','DESC')
//        ->get();

    //Raw Query
    /**
     * todo:select film_id, title, special_features, replacement_cost from film
     *      where replacement_cost between 19.99 and 20.99
     *      order by film_id
     *      limit 10
     */
//    $films=DB::table('film')
//        ->select(['film_id','title','special_features','replacement_cost'])
//        ->whereBetween('replacement_cost',[19.99,20.99])
//        ->orderBy('film_id')
//        //skip first 3
//        ->skip(3)
//        ->limit(10)
//        ->get();

//    $films=DB::table('film')
//        ->select(['film_id','title','special_features','replacement_cost'])
//        ->where('title','=','African Egg')
//        ->orWhere('title','=','Agent Truman')
//        ->get();

    //Raw Query
    /**
     * Todo:select s.staff_id,s.first_name,s.last_name,s.email,
     *      addr.address,addr.district,addr.postal_code,
     *      c.city,count,country
     *      from staff as s
     *      left join address as addr
     *      on s.address_id=addr.address_id
     *      left join city as c
     *      on addr.city_id=c.city_id
     *      left join country as count
     *      on c.country_id=count.country_id
     *      order by staff_id
     */

//    $staffWithAddresses=DB::table('staff as s')
//        ->select([
//            's.staff_id','s.first_name','s.last_name','s.email',
//            'addr.address','addr.district','addr.postal_code',
//            'c.city','count.country'])
//        ->leftJoin('address as addr', 's.address_id','=','addr.address_id')
//        //result is left join again with city
//        ->leftJoin('city as c','addr.city_id','=','c.city_id')
//        //result is left join again with country
//        ->leftJoin('country as count','c.country_id','=','count.country_id')
//        ->orderBy('staff_id')
//        ->get();

    //Raw Query
    /**
     * Todo:select film_id, title
     *      from film
     *      where title like 'K%' or title like 'Q%'
     *      and language_id in (
     *          select language_id from 'language' from language
     *          where name='English'
     *      )
     *      order by title
     */

    $EnglishFilms=DB::table('film')
        ->select('film_id','title')
        ->where('title','like','K%')
        ->orWhere('title','like','Q%')
        ->whereIn('language_id',function ($query){
            $query->select('language_id')->from('language')
                ->where('name','English');
        })->orderBy('title')
        ->get();

    return $EnglishFilms;
});
