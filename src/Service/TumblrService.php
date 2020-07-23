<?php

namespace App\Service;

class TumblrService
{
    public function getImage(): array
    {
        $imageArray = [];

        $request = 'https://mrsample666.tumblr.com/api/read/json';

        $ci = curl_init($request);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
        $input = curl_exec($ci);
        // Tumblr JSON doesn't come in standard form, some str replace needed
        $input = str_replace('var tumblr_api_read = ','',$input);
        $input = str_replace(';','',$input);
        // parameter 'true' is necessary for output as PHP array
        $value = json_decode($input, true);
        $content =  $value['posts'];
        // the number of items you want to display
        $item = count($content) - 1;
        // Tumblr provides various photo size, this case will choose the 75x75 square one
        $type = 'photo-url-250';

        for ($i=0;$i<=$item;$i++) {
            if ($content[$i]['type'] == 'photo') {
                array_push($imageArray, [
                    'data-html' => '<a href="' . $content[$i]['url'] . '" target="_blank" ><img src="' . $content[$i][$type] . '"/></a>',
                    'date' => $content[$i]['date']
                ]);
            }
        }

        return $imageArray;
    }
}
