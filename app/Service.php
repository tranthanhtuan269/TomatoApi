<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icon',
        'name',
        'name_en',
        'name_ja',
        'name_ko',
        'parent_id',
        'index',
        'partner_id',
        'active'
    ];
    
    public function packages(){
        return $this->hasMany('App\Package');
    }

    public function parent(){
        return $this->belongsTo('App\Service', 'parent_id');
    }
    
    public function services(){
        return $this->hasMany('App\Service', 'parent_id')->where('active', 1)->orderBy('index', 'asc');
    }

    /**
     * The roles that belong to the user.
     */
    public function partner()
    {
        return $this->belongsToMany('App\Partner', 'partner_service', 'partner_id', 'service_id');
    }

    public static function getServiceParent($serviceID){
        $service = Service::find($serviceID);
        if(isset($service)){
            if($service->parent_id != 0){
                return Service::getServiceParent($service->parent_id);
            }else{
                return $service;
            }
        }
    }
}
