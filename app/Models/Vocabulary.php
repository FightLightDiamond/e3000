<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vocabulary extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['sentence', 'means', 'spelling', 'image'];

    /**
     * @return HasMany
     */
    public function sentences()
    {
        return $this->hasMany(Sentence::class);
    }
}
