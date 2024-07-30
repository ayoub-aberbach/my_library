<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\issueBook;
use Illuminate\Support\Str;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class IssueBooks extends Component
{
    use WithPagination;

    public bool $tableShow = true;
    public bool $createForm = false;
    public bool $updateForm = false;

    public string $book_id = '';
    public string $issue_date = '';
    public string $return_date = '';
    public string $client = '';
    public string $fromDate = '';
    public string $toDate = '';

    public string $issuedBook_id;

    #[Layout("components.layouts.app")]
    public function render()
    {
        $issueBooks = issueBook::query();

        if ($this->fromDate && $this->toDate) {
            $issueBooks = issueBook::whereBetween('issue_date', [$this->fromDate, $this->toDate])->orderBy("created_at", "DESC")->get();
        } elseif ($this->book_id) {
            $issueBooks = issueBook::where('book_id', $this->book_id)->orderBy("created_at", "DESC")->get();
        } else {
            $issueBooks = issueBook::orderBy("created_at", "DESC")->paginate(10);
        }

        return view(
            'livewire.issue-books',
            [
                "issuedBooks_count" => IssueBook::count(),
                "issueBooks" => $issueBooks,
                'all_books' => Book::get(),
            ]
        );
    }

    public function showTable()
    {
        $this->tableShow = true;
        $this->createForm = false;
        $this->updateForm = false;

        $this->book_id = "";
        $this->issue_date = "";
        $this->return_date = "";
        $this->client = "";
        $this->resetValidation();
    }

    public function addForm()
    {
        $this->createForm = true;
        $this->tableShow = false;
        $this->updateForm = false;

        $this->resetValidation();
    }

    public function store()
    {
        $data = $this->validate(
            [
                "book_id" => ["required", "exists:books,id"],
                "client" => ["required", "string"],
                "issue_date" => ["required", "date"],
                "return_date" => ["nullable", "date"]
            ],
            [
                'book_id' => "The book field is required"
            ]
        );

        $book = Book::find($data["book_id"])->first();

        $issuedBooksExist = $book->issuedBooks()
            ->where(
                function ($query) use ($data) {
                    $query->where('return_date', "")->orWhere(function ($query) use ($data) {
                        $query->where('return_date', '>', $data['issue_date'])->where('return_date', "<>", "");
                    });
                }
            )->get();

        if ($issuedBooksExist->isNotEmpty()) {
            return $this->addError('book_id', 'This book is issued, or was issued between these dates.');
        };

        issueBook::create(array_merge(['id' => Str::uuid()], $data));

        $this->tableShow = true;
        $this->createForm = false;
        $this->updateForm = false;

        $this->book_id = "";
        $this->issue_date = "";
        $this->return_date = "";
        $this->client = "";
        $this->resetValidation();
    }

    public function edit($id)
    {
        $this->tableShow = false;
        $this->updateForm = true;
        $this->createForm = false;

        $issue_book = issueBook::find($id);

        $this->issuedBook_id = $issue_book->id;
        $this->client = $issue_book->client;
        $this->issue_date = $issue_book->issue_date;
        $this->return_date = $issue_book->return_date;
        $this->book_id = $issue_book->book_id;

        $this->resetValidation();
    }

    public function update($id)
    {
        $issued_book = issueBook::find($id);

        if (!$issued_book) {
            return $this->addError('book_id', 'This book is not found');
        }

        $this->validate([
            "return_date" => ["required", "date"]
        ]);

        if ($issued_book->return_date === "" && $this->return_date >= date("Y-m-d")) {
            $issued_book->return_date = $this->return_date;
            $issued_book->save();
        } elseif ($this->return_date < date("Y-m-d")) {
            return $this->addError('return_date', "Should be equal to <" . $issued_book->issue_date . "> or later");
        } else {
            return $this->addError('book_id', "This book has a record with these dates");
        }

        $this->tableShow = true;
        $this->createForm = false;
        $this->updateForm = false;

        $this->book_id = "";
        $this->issue_date = "";
        $this->return_date = "";
        $this->client = "";
        $this->resetValidation();
    }

    public function destroy($id)
    {
        $result = issueBook::find($id);
        $result->delete();
    }

    public function clearFilter()
    {
        $this->toDate = '';
        $this->fromDate = '';
        $this->book_id = '';
    }
}
