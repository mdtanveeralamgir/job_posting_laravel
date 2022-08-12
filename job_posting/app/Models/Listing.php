<?php

namespace App\Models;

class Listing {
    
    public static function all()
    {
        return 
        [
            [
                'id' => 1,
                'title' => 'Post one',
                'des' => 'description of post one'
            ],
            [
                'id' => 2,
                'title' => 'Post two',
                'des' => 'description of post two'
            ]
            
            ];
    }

    public static function find($id)
    {
        $listings = self::all();
        $foundListing = null;

        foreach($listings as $listing)
        {
            if($listing['id'] === (int)$id)
                $foundListing = $listing;
        }

        return array($foundListing);
    }
}