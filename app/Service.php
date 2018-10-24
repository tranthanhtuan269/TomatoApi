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
        'parent_id',
        'index',
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
