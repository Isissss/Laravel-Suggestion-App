<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Profile extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $picture;


    public function __construct($picture)
    {
       if(!$picture) {
           $picture = "https://avatarfiles.alphacoders.com/292/thumb-292554.png";
       } else {
           $picture = 'https://crafatar.com/avatars/' . $picture . '?overlay';
       }
       $this->picture = $picture;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.profile');
    }
}
