<?php

namespace app\api\controller;

class TreeMapController {
    public function loadChart() {
        $times = '[
            { "team": "Flamengo", "points": 78, "wins": 80, "loses": 5 },
            { "team": "Palmeiras", "points": 61, "wins": 19, "loses": 6 },
            { "team": "Atlético Mineiro", "points": 53, "wins": 18, "loses": 7 },
            { "team": "São Paulo", "points": 50, "wins": 17, "loses": 8 },
            { "team": "Fluminense", "points": 49, "wins": 16, "loses": 9 },
            { "team": "Internacional", "points": 48, "wins": 16, "loses": 10 },
            { "team": "Grêmio", "points": 47, "wins": 15, "loses": 11 },
            { "team": "Santos", "points": 45, "wins": 14, "loses": 12 },
            { "team": "Corinthians", "points": 44, "wins": 13, "loses": 13 },
            { "team": "Vasco", "points": 42, "wins": 12, "loses": 14 }
        ]';

        $data = json_decode($times, true);

        return $data;
    }
}

?>