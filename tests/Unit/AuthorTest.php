<?php

namespace Tests\Unit;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_dob_is_nullable()
    {
        Author::firstOrCreate([
            'name' => 'Some name'
        ]);

        $this->assertCount(1, Author::all());
    }

}
