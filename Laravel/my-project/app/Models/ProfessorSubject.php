<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProfessorSubject extends Pivot
{
    protected $fillable = ['professor_id', 'subject_id'];

    // Optionally, you can define relationships if needed.
    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
