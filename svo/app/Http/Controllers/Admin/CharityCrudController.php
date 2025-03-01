<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\CharityRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class CharityCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Charity::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/charity');
        CRUD::setEntityNameStrings('charity', 'charities');
    }

    protected function setupListOperation()
    {
        CRUD::setFromDb(); 
    }

    protected function setupCreateOperation()
{
    CRUD::setValidation(CharityRequest::class);
    CRUD::setFromDb();

    logger('Date field value:', [request('date_field_name')]); // Log the date value
}

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}