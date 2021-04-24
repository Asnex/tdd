<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_author_can_be_created()
    {
       // $this->withExceptionHandling();
      $this->post('/authors', $this->author());

      $author =  Author::all();
      $this->assertCount(1, $author);
      $this->assertInstanceOf(Carbon::class, $author->first()->dob);
      $this->assertEquals('1991/15/05',  $author->first()->dob->format('Y/d/m'));
    }

    /**
     * @test
     */
    public function a_name_is_required()
    {
        $response = $this->post('/authors', array_merge($this->author(), ['name' => '']));

        $response->assertSessionHasErrors('name');
    }

    /**
     * @test
     */
    public function a_dob_is_required()
    {
        $response = $this->post('/authors', array_merge($this->author(), ['dob' => '']));

        $response->assertSessionHasErrors('dob');
    }

    /**
     * @return string[]
     */
    private function author()
    {
        return [
            'name' => 'Author name',
            'dob'  => '05/15/1991'
        ];
    }
}
