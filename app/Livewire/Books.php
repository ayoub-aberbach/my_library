<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Str;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


class Books extends Component
{
    use WithPagination;

    public bool $tableShow = true;
    public bool $createForm = false;
    public bool $updateForm = false;

    public string $searchBook = '';
    public string $searchAuthor = '';

    public string $book_id;
    public string $title;
    public string $page_count;
    public string $publish_date;
    public string $author_id;

    #[Layout("components.layouts.app")]
    public function render()
    {
        $authors = Author::get();
        $books = Book::query();

        if ($this->searchBook) {
            $books = Book::where('title', 'LIKE', '%' . $this->searchBook . '%')
                ->orderBy("created_at", 'DESC')->get();
        } else if ($this->searchAuthor) {
            foreach ($authors as $author) {
                if (str_starts_with($author->firstname . " " . $author->lastname, $this->searchAuthor)) {
                    $books = Book::Where('author_id', $author->id)->orderBy("created_at", 'DESC')->get();
                }
            }
        } else {
            $books = Book::orderBy("created_at", 'DESC')->paginate(10);
        }

        return view('livewire.books', [
            "books" => $books,
            "authors" => $authors,
            "books_count" => Book::count()
        ]);
    }

    public function showTable()
    {
        $this->tableShow = true;
        $this->createForm = false;
        $this->updateForm = false;

        $this->title = "";
        $this->page_count = "";
        $this->publish_date = "";
        $this->author_id = "";
        $this->resetValidation();
    }

    public function addForm()
    {
        $this->tableShow = false;
        $this->createForm = true;
        $this->updateForm = false;
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate([
            "title" => ["required", "string", "unique:books"],
            "page_count" => ["required", "integer"],
            "publish_date" => ["required", "date"],
            "author_id" => ["required", "exists:authors,id"]
        ], [
            "author_id" => "The book author field is required"
        ]);

        Book::create([
            "id" => Str::uuid(),
            "title" => $this->title,
            "page_count" => $this->page_count,
            "publish_date" => $this->publish_date,
            "author_id" => $this->author_id
        ]);

        $this->tableShow = true;
        $this->createForm = false;
        $this->updateForm = false;

        $this->title = "";
        $this->page_count = "";
        $this->publish_date = "";
        $this->author_id = "";
        $this->resetValidation();
    }

    public function edit($id)
    {
        $this->tableShow = false;
        $this->updateForm = true;
        $this->createForm = false;

        $book = Book::find($id);

        $this->book_id = $book->id;
        $this->title = $book->title;
        $this->page_count = $book->page_count;
        $this->publish_date = $book->publish_date;
        $this->author_id = $book->author_id;

        $this->resetValidation();
    }

    public function update($id)
    {
        $book = Book::find($id);
        $this->validate([
            "title" => ["required", "string"],
            "page_count" => ["required", "integer"],
            "publish_date" => ["required", "date"],
            "author_id" => ["required", "exists:authors,id"]
        ]);

        $book->title = $this->title;
        $book->page_count = $this->page_count;
        $book->publish_date = $this->publish_date;
        $book->author_id = $this->author_id;

        $book->save();

        $this->tableShow = true;
        $this->createForm = false;
        $this->updateForm = false;

        $this->title = "";
        $this->page_count = "";
        $this->publish_date = "";
        $this->author_id = "";
        $this->resetValidation();
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        if (count($book->issuedbooks) === 0) {
            $book->delete();
            $this->dispatch("book_deleted");
        } else {
            return $this->dispatch("book_denied");
        }
    }
}
