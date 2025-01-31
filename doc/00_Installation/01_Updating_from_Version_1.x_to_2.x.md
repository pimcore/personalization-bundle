# Updating from Version 1.x to 2.x

The library geoip2/geoip2 was updated from version 2.x to 3.x.

The data stored under the PROVIDER_KEY 'geoip' has changed to a new structure.

Old data structure:
```php
[
            'city' => [
                'confidence' => 76,
                'geoname_id' => 9876,
            ],
            'continent' => [
                'code' => 'NA',
                'geoname_id' => 42,
            ],
            'country' => [
                'confidence' => 99,
                'geoname_id' => 1,
                'iso_code' => 'US',
            ],
            'location' => [
                'average_income' => 24626,
                'accuracy_radius' => 1500,
                'latitude' => 44.98,
                'longitude' => 93.2636,
                'metro_code' => 765,
                'population_density' => 1341,
                'postal_code' => '55401',
                'postal_confidence' => 33,
                'time_zone' => 'America/Chicago',
            ],
            'maxmind' => [
                'queries_remaining' => 22,
            ],
            'registered_country' => [
                'geoname_id' => 2,
                'iso_code' => 'CA',
            ],
            'represented_country' => [
                'geoname_id' => 3,
                'iso_code' => 'GB',
            ],
            'subdivisions' => [
                [
                    'confidence' => 88,
                    'geoname_id' => 574635,
                    'iso_code' => 'MN',
                ],
            ],
            'traits' => [
                'autonomous_system_number' => 1234,
                'autonomous_system_organization' => 'AS Organization',
                'domain' => 'example.com',
                'ip_address' => '1.2.3.4',
                'is_anonymous' => true,
                'is_anonymous_vpn' => true,
                'is_hosting_provider' => true,
                'is_public_proxy' => true,
                'is_residential_proxy' => true,
                'is_satellite_provider' => true,
                'is_tor_exit_node' => true,
                'isp' => 'Comcast',
                'mobile_country_code' => '310',
                'mobile_network_code' => '004',
                'organization' => 'Blorg',
                'static_ip_score' => 1.3,
                'user_count' => 2,
                'user_type' => 'college',
            ],
        ];
```
New data structure:
```php
[
            'city' => [
                'confidence' => 76,
                'geoname_id' => 9876,
            ],
            'continent' => [
                'code' => 'NA',
                'geoname_id' => 42,
            ],
            'country' => [
                'confidence' => 99,
                'geoname_id' => 1,
                'iso_code' => 'US',
            ],
            'location' => [
                'average_income' => 24626,
                'accuracy_radius' => 1500,
                'latitude' => 44.98,
                'longitude' => 93.2636,
                'metro_code' => 765,
                'population_density' => 1341,
                'time_zone' => 'America/Chicago',
            ],
            'maxmind' => [
                'queries_remaining' => 22,
            ],
            'postal' => [
                'code' => '55401',
                'confidence' => 33,
            ],
            'registered_country' => [
                'geoname_id' => 2,
                'iso_code' => 'CA',
            ],
            'represented_country' => [
                'geoname_id' => 3,
                'iso_code' => 'GB',
                'type' => 'military',
            ],
            'subdivisions' => [
                [
                    'confidence' => 88,
                    'geoname_id' => 574635,
                    'iso_code' => 'MN',
                ],
            ],
            'traits' => [
                'autonomous_system_number' => 1234,
                'autonomous_system_organization' => 'AS Organization',
                'connection_type' => 'Cable/DSL',
                'domain' => 'example.com',
                'ip_address' => '1.2.3.4',
                'is_anonymous' => true,
                'is_anonymous_vpn' => true,
                'is_anycast' => true,
                'is_hosting_provider' => true,
                'is_legitimate_proxy' => true,
                'is_public_proxy' => true,
                'is_residential_proxy' => true,
                'is_tor_exit_node' => true,
                'isp' => 'Comcast',
                'mobile_country_code' => '310',
                'mobile_network_code' => '004',
                'network' => '1.2.3.0/24',
                'organization' => 'Blorg',
                'static_ip_score' => 1.3,
                'user_count' => 2,
                'user_type' => 'college',
            ],
        ];
```