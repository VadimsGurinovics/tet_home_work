<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


class Rssdata extends Controller
{
    public static function validateDataBeforeInsert($pubDateToCheck)
    {
        return DB::table('tb_rss_details')->where('pub_date', '=', $pubDateToCheck)->exists();
    }

    public static function getValueByRegex($regex = null, $string = null)
    {
        preg_match($regex, $string, $match);
        return $match[0];
    }

    public function index()
    {
        $data = DB::table('tb_rss_details')->paginate(15);
        $title = $this->getTitle();
        return view('rssData', ['data' => $data, 'title' => $title]);
    }


    public function getTitle()
    {
        $url = "https://www.bank.lv/vk/ecb_rss.xml";
        $feeds = simplexml_load_file($url);
        $site = $feeds->channel->title;
        return $site;
    }
}
