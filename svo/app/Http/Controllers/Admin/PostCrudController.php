<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class PostCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Post::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/post');
        CRUD::setEntityNameStrings('post', 'posts');
    }

    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        CRUD::column('is_moderated')
            ->type('boolean')
            ->label('Moderated')
            ->options([0 => 'No', 1 => 'Yes']);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(PostRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        CRUD::field('is_moderated')
            ->type('boolean')
            ->label('Допустить?')
            ->options([0 => 'No', 1 => 'Yes']);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}