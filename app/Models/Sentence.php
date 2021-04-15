<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sentence extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['sentence', 'means', 'spelling', 'image', 'vocabulary_id'];

    /**
     * @return BelongsTo
     */
    public function vocabulary()
    {
        return $this->belongsTo(Vocabulary::class);
    }
}
