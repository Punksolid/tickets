<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TweetsProcessorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example_processor()
    {
       // read file from storage
       $file = storage_path('app/tweets.json');

        $file = \File::get($file);
//        print content of file
        // is file empty?
        if (empty($file)) {
            echo "File is empty";
        } else {


            $data = [
                ['Symbol', 'Company', 'Price'],
                ['GOOG', 'Google Inc.', '800'],
                ['AAPL', 'Apple Inc.', '500'],
                ['AMZN', 'Amazon.com Inc.', '250'],
                ['YHOO', 'Yahoo! Inc.', '250'],
                ['FB', 'Facebook, Inc.', '30'],
            ];



// close the file
            $tweets = json_decode($file, true);
            $file = fopen(storage_path('app/tweets_result.csv'), 'w');
            fputcsv($file, ['prompt', 'completion']);

            foreach ($tweets as $tweet) {
                $full_text_tweet = $tweet['tweet']['full_text'];
                // convert double quotes to single quotes
                $full_text_tweet = str_replace('"', "'", $full_text_tweet);
                $full_text_tweet = str_replace('\n', "", $full_text_tweet);
                $full_text_tweet = str_replace('\r', "", $full_text_tweet);
                $full_text_tweet = preg_replace( "/\r|\n/", "", $full_text_tweet );
                $full_text_tweet = preg_replace('/\#\w+/', '', $full_text_tweet);
                // split tweet in two parts separated by '?'
                // check if the tweet contains '?'
                if (strpos($full_text_tweet, '?') !== false) {
                    $tweet_parts = explode('?', $full_text_tweet);
                    $prompt = $tweet_parts[0];
                    $completion = $tweet_parts[1];
                } else {

                    $words = explode(' ', $full_text_tweet);
                    $count = count($words);
                    $half = ceil($count / 2);
                    $prompt = implode(' ', array_slice($words, 0, $half));
                    $completion = implode(' ', array_slice($words, $half));
                }

                $line = sprintf('{"prompt":"%s####", "completion":"%s###"}', $prompt, $completion);
                dump($line);
                file_put_contents(storage_path('app/tweets_result_old.jsonl'), $line. "\n" , FILE_APPEND);
                fputcsv($file, [ $prompt."###" , $completion."###"]);
            }
            fclose($file);

        }

//        $this->assertTrue(is_string($file));
//        $tweets = json_decode($file, true);
//

//       $this->assertTrue(true);
    }
}
