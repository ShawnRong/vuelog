<?php

namespace App;

use App\Services\Markdowner;
use App\Services\Mention;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'commentable_id', 'commentable_type', 'content'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function setContentAttribute($value)
    {
        $content = (new Mention)->parse($value);

        $data = [
            'raw' => $content,
            'html' => (new Markdowner)->convertMarkdownToHtml($content)
        ];

        $this->attributes['content'] = json_encode($data);
    }
}
