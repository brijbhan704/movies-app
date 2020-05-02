<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewmoviesTest extends TestCase
{
    //test
    public function the_main_pageshow_correct_info()
    {
       
        $response = $this->get(route('movies.index'));

        $response = assertSuccessful();

        $response = assertSee('Poplur Movies');
       
    }
}
