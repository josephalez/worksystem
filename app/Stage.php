<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class Stage extends Model
{
    //
    public static function create(Request $request){
        $_request = $request->all();
        return Stage::create([
            'name' => $_request['name'],
            'percentage' => $_request['percentage'],
            'percentage_max' => $_request['percentage_max'],
            'phase' => $_request['phase'],
            'sback' => (isset($_request['sback'])) ? $_request['sback'] : null,
            'snext' => (isset($_request['snext'])) ? $_request['snext'] : null,
            'sparalel' => (isset($_request['sparalel'])) ? $_request['sparalel'] : null,
            'description' => (isset($_request['description'])) ? $_request['description'] : null,
            'optional' => (isset($_request['optional'])) ? $_request['optional'] : false,
            'bidirectional' => (isset($_request['bidirectional'])) ? $_request['bidirectional'] : false,
        ]);
    }

    
}
