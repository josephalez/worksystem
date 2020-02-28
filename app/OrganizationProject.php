<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notifiable;

class OrganizationProject extends Model
{
    use Notifiable;
    protected $fillable = [
        'id',
        'organization_id',
        'project_id',
        'trash',
    ];
    protected $table = 'organization_project';
    public static function addOrganization(Request $request, $project_id){
        $_request = $request->all();
        $organization = DB::table('organizations')->where('id',$_request['organization']);
        if (!$organization) return response()->json('Organization not found',404);
        $project = DB::table('projects')->where('id',$project_id);
        if (!$project) return response()->json('Project not found',404);
        return OrganizationProject::create([
            'organization_id' => $_request['organization'],
            'project_id' => $project_id,
        ]);
    }
}
