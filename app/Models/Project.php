<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;

    //implemeto la softDeletes() nel model in questo caso per i project nel db projects
    use SoftDeletes;

    protected $fillable = ['title', 'thumb', 'description', 'authors', 'type_id', 'tech', 'link_github', 'link'];

    public function type():BelongsTo{
        return $this->belongsTo(Type::class);
    }

    public function technologies(): BelongsToMany {
        return $this->belongsToMany(Tecnology::class);
    }

}
