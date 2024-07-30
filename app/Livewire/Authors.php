<?php

namespace App\Livewire;

use App\Models\Author;
use Illuminate\Support\Str;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;


class Authors extends Component
{
    use WithPagination;

    public bool $tableShow = true;
    public bool $createForm = false;
    public bool $updateForm = false;

    public string $firstname = '';
    public string $lastname = '';

    public string $author_id = "";

    public string $search = '';

    #[Layout("components.layouts.app")]
    public function render()
    {

        $authors = Author::query();

        if ($this->search !== "") {
            $authors = Author::where('firstname', 'LIKE', '%' . $this->search . '%')
                ->orWhere('lastname', 'LIKE', '%' . $this->search . '%')
                ->orderBy("created_at", "DESC")
                ->get();
        } else {
            $authors = Author::orderBy("created_at", "DESC")->paginate(10);
        }

        return view(
            'livewire.authors',
            [
                "authors" => $authors,
                "authors_count" => Author::count()
            ]
        );
    }

    public function showTable()
    {
        $this->tableShow = true;
        $this->createForm = false;
        $this->updateForm = false;

        $this->firstname = "";
        $this->lastname = "";
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
        $this->validate([
            "firstname" => ["required", "string", "unique:authors"],
            "lastname" => ["required", "string", "unique:authors"]
        ]);

        Author::create([
            'id' => Str::uuid(),
            'firstname' => $this->firstname,
            'lastname' => $this->lastname
        ]);

        $this->tableShow = true;
        $this->createForm = false;
        $this->updateForm = false;

        $this->firstname = "";
        $this->lastname = "";
        $this->resetValidation();
    }

    public function edit($id)
    {
        $this->updateForm = true;
        $this->tableShow = false;
        $this->createForm = false;

        $author = Author::find($id);

        $this->author_id = $author->id;
        $this->firstname = $author->firstname;
        $this->lastname = $author->lastname;

        $this->resetValidation();
    }

    public function update($id)
    {
        $author = Author::find($id);

        $this->validate([
            "firstname" => ["required", "string"],
            "lastname" => ["required", "string"]
        ]);

        $author->firstname = $this->firstname;
        $author->lastname = $this->lastname;

        $author->save();

        $this->tableShow = true;
        $this->createForm = false;
        $this->updateForm = false;

        $this->firstname = "";
        $this->lastname = "";
        $this->resetValidation();
    }

    public function destroy($id)
    {
        $author = Author::find($id);
        if (count($author->books) === 0) {
            $author->delete();
            $this->dispatch("author_deleted");
        } else {
            return $this->dispatch("author_denied");
        }
    }
}
