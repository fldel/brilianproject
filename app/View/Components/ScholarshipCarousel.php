<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ScholarshipCarousel extends Component
{
    public $scholarships; // ✅ property harus ada

    /**
     * Create a new component instance.
     */
    public function __construct($scholarships)
    {
        $this->scholarships = $scholarships; // ✅ assign ke property
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.scholarship-carousel');
    }
}
