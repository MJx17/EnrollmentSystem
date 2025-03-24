<?php

// app/Http/Livewire/DualListbox.php

namespace App\Http\Livewire;

use Livewire\Component;

class DualListbox extends Component
{
    public $subjects;
    public $selectedSubjects;

    public function mount($subjects, $selectedSubjects)
    {
        $this->subjects = $subjects;
        $this->selectedSubjects = $selectedSubjects;
    }

    public function moveToSelected($subjectId)
    {
        if (($key = array_search($subjectId, $this->subjects)) !== false) {
            unset($this->subjects[$key]);
            $this->selectedSubjects[] = $subjectId;
        }
    }

    public function moveToAvailable($subjectId)
    {
        if (($key = array_search($subjectId, $this->selectedSubjects)) !== false) {
            unset($this->selectedSubjects[$key]);
            $this->subjects[] = $subjectId;
        }
    }

    public function render()
    {
        return view('livewire.dual-listbox');
    }
}
