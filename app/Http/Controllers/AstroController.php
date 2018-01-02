<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AstroController extends Controller
{
    //
    public function swiss(Request $request) {

        $year = $request->input('year');
        $month = $request->input('month');
        $day = $request->input('day');
        $hour = $request->input('hour');
        $minute = $request->input('minute');
        $second = $request->input('second');
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $path = '/share/microcosm/swiss_2.05.01/src_release';
        $output = [];
        $return = 0;
logger($year);
logger($month);
logger($day);
logger($hour);
logger($minute);
logger($second);
logger($lat);
logger($lng);
        exec($path . '/swetest2 '. '-y' . $year . ' -m' . $month . ' -d' . $day . ' -h' . $hour. ' -i' . $minute . ' -s' . $second . ' -a' . $lat . ' -o' . $lng, $output, $return);

        $planets = [];
        foreach ($output as $value) {
            $params = explode(',', $value);
            if ($params[0] == 'planet') {
                $planets[$params[1]] = $params[2];
            }
        }

        $houses = [];
        foreach ($output as $value) {
            $params = explode(',', $value);
            if ($params[0] == 'house') {
                $houses[$params[1]] = $params[2];
            }
        }
      
        return [
            'return' => $return,
            'planets' => $planets,
            'houses' => $houses,
        ];
    }
}
