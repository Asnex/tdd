<?php

namespace Tests\Feature;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_book_can_be_added_to_the_library()
    {
      //  $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Cool book title',
            'author' => 'Danko'
        ]);

//        $response->assertOk();
        $this->assertCount(1, Book::all());

        $book = Book::first();

        $response->assertRedirect($book->path());
    }

    public function test_a_title_is_required()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Danko'
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_a_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'Cool title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
       // $this->withoutExceptionHandling();
          $this->post('/books', [
            'title' => 'New titles',
            'author' => 'New authors'
        ]);

          $book = Book::first();

        $response = $this->patch($book->path(), [
            'title' => 'New title',
            'author' => 'New author'
        ]);

        $this->assertEquals('New title', Book::first()->title);
        $this->assertEquals('New author', Book::first()->author);

        $response->assertRedirect($book->path());

    }

    /** @test */
    public function a_book_can_be_deleted()
    {
       // $this->withoutExceptionHandling();
        $this->post('/books', [
            'title' => 'New titles',
            'author' => 'New authors'
        ]);

        $book = Book::first();
        $this->assertCount(1, Book::all());


        $response = $this->delete($book->path());

        $this->assertCount(0, Book::all());

        $response->assertRedirect('/books');
    }
}
