<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
      'ip', 'article_id', 'clicks'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
