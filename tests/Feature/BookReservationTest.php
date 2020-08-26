<?php

namespace Tests\Feature;
use App\Models\Book;
use App\Models\Author;
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

        $response = $this->post('/books', $this->data());

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
        $response = $this->post('/books', array_merge($this->data(), ['author_id' => '']));

        $response->assertSessionHasErrors('author_id');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
       // $this->withoutExceptionHandling();
          $this->post('/books', $this->data());

          $book = Book::first();

        $response = $this->patch($book->path(), [
            'title' => 'New title',
            'author_id' => 'New author'
        ]);

        $this->assertEquals('New title', Book::first()->title);
        $this->assertEquals(2, Book::first()->author_id);

        $response->assertRedirect($book->path());

    }

    /** @test */
    public function a_book_can_be_deleted()
    {
       // $this->withoutExceptionHandling();
        $this->post('/books', $this->data());

        $book = Book::first();
        $this->assertCount(1, Book::all());


        $response = $this->delete($book->path());

        $this->assertCount(0, Book::all());

        $response->assertRedirect('/books');
    }

    /** @test */
    public function a_new_author_is_automatically_added()
    {
        $this->withoutExceptionHandling();
        $this->post('/books', $this->data());
        $book = Book::first();
        $author = Author::first();

        $this->assertEquals($author->id, $book->author_id);
        $this->assertCount(1, Author::all());

    }

    /**
     * @return array
     */
    private function data()
    {
        return [
            'title' => 'Cool book title',
            'author_id' => 1
        ];
    }
}
