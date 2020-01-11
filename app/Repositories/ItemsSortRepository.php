<?php


namespace App\Repositories;


use App\Models\ItemsSort;
use App\User;
use Illuminate\Http\Request;

class ItemsSortRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new ItemsSort();
    }

    public function store(Request $request, int $id)
    {
        if (!is_null($this->model->find(['user_id' => "$id"]))){
            $this->model->where('user_id', "$id")->delete();
        }
        $count = 1;
        foreach ($request->request as $item){
            $this->model->create(['user_id' => $id, 'item_name' => $item[0], 'position' => $count]);
            ++$count;
        };
    }

    public function sortedList(User $user)
    {
        return $this->model->where('user_id', $user->id)->orderBy('position', 'asc')->get();
    }
}
