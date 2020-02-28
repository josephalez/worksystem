<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notifiable;

class OrganizationPerson extends Model
{
    use Notifiable;
    protected $fillable = [
        'id',
        'organization_id',
        'person_id',
        'trash',
    ];

    protected $table = 'organization_person';

    public static function addPerson(Request $request, $person_id){
        $_request = $request->all();
        $organization = DB::table('organizations')->where('id',$_request['organization']);
        if (!$organization) return response()->json('Organization not found',404);
        $person = DB::table('people')->where('id',$person_id);
        if (!$person) return response()->json('Person not found',404);
        return OrganizationPerson::create([
            'organization_id' => $_request['organization'],
            'person_id' => $person_id,
        ]);
    }
}
