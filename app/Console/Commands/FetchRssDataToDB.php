<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Http\Controllers\Rssdata;

class FetchRssDataToDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:rssdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Rss data and store them in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = "https://www.bank.lv/vk/ecb_rss.xml";
        $feeds = simplexml_load_file($url);
        $validateSqlInsert = false;

        $i = 0;
        if (!empty($feeds)) {

            $arrFullInfo = array();
            $answers = array();
            foreach ($feeds->channel->item as $item) {

                $description = $item->description;
                $postDate = $item->pubDate;
                $pubDate = date('Y-m-d', strtotime($postDate));

                if ($i >= 5) break;

                $dataExists = Rssdata::validateDataBeforeInsert($pubDate);

                if (!$dataExists) {
                    $arrDescriptions = explode(" ", $description);

                    for ($x = 0; $x < (sizeof($arrDescriptions) - 1); $x += 2) {
                        $arrFullInfo[] = '_code=' . $arrDescriptions[$x] . '_unit=' . $arrDescriptions[$x + 1] . '_date=' . $pubDate . '_end';
                    }
                    $validateSqlInsert = true;
                }
                $i++;
            }

            if ($validateSqlInsert) {

                foreach ($arrFullInfo as $key => $value) {
                    $countryCode = Rssdata::getValueByRegex('/(?<=_code=)(.*)(?=_unit=)/', $value);
                    $unitVal = Rssdata::getValueByRegex('/(?<=_unit=)(.*)(?=_date=)/', $value);
                    $pubDate = Rssdata::getValueByRegex('/(?<=_date=)(.*)(?=_end)/', $value);

                    $answers[] = [
                        'country_code' => $countryCode,
                        'unit_value' => $unitVal,
                        'pub_date' => $pubDate,
                    ];
                }

                DB::table('tb_rss_details')->insert(
                    $answers
                );

                echo "New " . count($answers) . " records imported successfully";

            } else {
                echo 'The records in the database already exist';
            }


        } else {
            echo "<h2>No item found</h2>";
        }

        $this->info('Word of the Day sent to All Users1w');
    }
}
