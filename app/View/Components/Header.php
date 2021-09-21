<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    public $title, $link, $showCreate;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $link, $showCreate)
    {
        $this->title = $title;
        $this->link = $link;
        $this->showCreate = $showCreate == 'true' ? true : false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header');
    }
}
