<?php
namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $parentLabel;
    public $parentRoute;
    public $currentPageTitle;

    public function __construct($parentLabel = null, $parentRoute = null, $currentPageTitle = null)
    {
        $this->parentLabel = $parentLabel;
        $this->parentRoute = $parentRoute;
        $this->currentPageTitle = $currentPageTitle;
    }

    public function render()
    {
        return view('components.breadcrumb');
    }
}
