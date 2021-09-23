<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GeolocationTableSeeder extends Seeder
{
    /**
     * Seed the Geolocations with a default location.
     */
    public function run()
    {
        \App\Models\Geolocation::create(
            [
                'id' => 0,
                'city' => 'North Palm Beach',
                'state' => 'FL',
                'zip_code' => null,
                'geocoding' => '{"results":[{"address_components":[{"long_name":"Palm Beach Gardens","short_name":"Palm Beach Gardens","types":["locality", "political"]},{"long_name":"Palm Beach County","short_name":"Palm Beach County","types":["administrative_area_level_2", "political"]},{"long_name":"Florida","short_name":"FL","types":["administrative_area_level_1", "political"]},{"long_name":"United States","short_name":"US","types":["country", "political"]}],"formatted_address":"Palm Beach Gardens, FL, USA","geometry":{"bounds":{"northeast":{"lat":26.8981313,"lng":-80.0574134},"southwest":{"lat":26.7805845,"lng":-80.26935709999999}},"location":{"lat":26.8396096,"lng":-80.1019144},"location_type":"APPROXIMATE","viewport":{"northeast":{"lat":26.8981313,"lng":-80.0574134},"southwest":{"lat":26.7805845,"lng":-80.26935709999999}}},"place_id":"ChIJpRdHOMzT3ogRYcIlqTI6jGY","types":["locality", "political"]}],"status":"OK"}',
            ]
        );
    }
}
