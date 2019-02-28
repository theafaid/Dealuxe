<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * Determine if the profile for a user is completed or not
     * @return bool
     */
    public function isCompleted(){
        foreach($this->getTableColumns() as $column){
            if($this[$column] == null) return false;
        }

        return true;
    }

    /**
     * Get table columns
     * @return array
     */
    public function getTableColumns() {
        return $this->getConnection()
            ->getSchemaBuilder()
            ->getColumnListing($this->getTable());
    }
}
