<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PageAccount extends Component
{
    public $search = '';
    public $page = 1;
    public $perPage = 10;

    public $showModal = false;
    public $modalType = 'view'; // view | create | edit

    public $accountId;
    public $nama;
    public $email;
    public $password;
    public $password_text;
    public $role = 'admin';
    public $status = 'Y';

    public function updatedSearch()
    {
        $this->page = 1;
    }

    public function nextPage()
    {
        $this->page++;
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    public function resetForm()
    {
        $this->accountId = null;
        $this->nama = '';
        $this->email = '';
        $this->password = '';
        $this->password_text = '';
        $this->role = 'admin';
        $this->status = 'Y';
    }

    public function create()
    {
        $this->resetForm();
        $this->modalType = 'create';
        $this->showModal = true;
    }

    public function view($id)
    {
        $data = DB::table('accounts')->where('id', $id)->first();

        if (!$data) return;

        $this->accountId = $data->id;
        $this->nama = $data->nama;
        $this->email = $data->email;
        $this->role = $data->role;
        $this->status = $data->status;
        $this->password_text = $data->password_text;
        $this->password = '';

        $this->modalType = 'view';
        $this->showModal = true;
    }

    public function enableEdit()
    {
        $this->modalType = 'edit';
    }

    public function save()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        if ($this->modalType === 'create') {

            $this->validate([
                'password' => 'required|min:5'
            ]);

            DB::table('accounts')->insert([
                'nama' => $this->nama,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'password_text' => $this->password,
                'role' => $this->role,
                'status' => $this->status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if ($this->modalType === 'edit') {

            $updateData = [
                'nama' => $this->nama,
                'email' => $this->email,
                'role' => $this->role,
                'status' => $this->status,
                'updated_at' => now(),
            ];

            if (!empty($this->password)) {
                $updateData['password'] = Hash::make($this->password);
                $updateData['password_text'] = $this->password;
            }

            DB::table('accounts')
                ->where('id', $this->accountId)
                ->update($updateData);
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        DB::table('accounts')->where('id', $id)->delete();
    }

    public function render()
    {
        $query = DB::table('accounts')
            ->when($this->search, function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });

        $total = $query->count();
        $lastPage = (int) ceil($total / $this->perPage);

        if ($this->page > $lastPage && $lastPage > 0) {
            $this->page = $lastPage;
        }

        $accounts = $query
            ->orderByDesc('id')
            ->offset(($this->page - 1) * $this->perPage)
            ->limit($this->perPage)
            ->get();

        return view('livewire.cms.page-account', [
            'accounts' => $accounts,
            'lastPage' => $lastPage,
        ]);
    }
}