<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ArticleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ArticleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;    
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Article::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/article');
        CRUD::setEntityNameStrings('article', 'articles');

        CRUD::addFields($this->getFieldsData());
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'id', 'type' => 'number', 'prefix' => '#']);
        CRUD::column('title');
        CRUD::column('content');
        CRUD::column('created_at');
        CRUD::column('updated_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ArticleRequest::class);

        // CRUD::field('id');
        // CRUD::field('title');
        // CRUD::field('content');
        // CRUD::field('created_at');
        // CRUD::field('updated_at');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    private function getFieldsData($show = false) {
        return [
            [
                'name'  => 'title',
                'label' => 'Title',
                'type'  => 'text',
            ],
            [
                'name'  => 'content',
                'label' => 'Content',
                'type'  => ($show ? 'textarea' : 'ckeditor'),
            ],
            [   // select2multiple = n-n relationship (with pivot table)
                'label' => 'Tags',
                'type'  => ($show ? 'select' : 'relationship'),
                'name'  => 'tags',   // the method that defines the relationship in model

                // optional
                //'entity'    => 'tags',  // the method that defines the relationship in model
                //'model'     => 'App\Models\Tag', // foreign key model
                //'attribute' => 'name',  // freign key attribute that is shown to user
                //'pivot'     => 'true',  // on create & update, do you need to add/delete pivot table entires?
            ]
        ];
    }

    protected function setupShowOperation() {
        // CRUD::set('show.setFromDb', false);
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumns($this->getFieldsData(true));
    }


    public function fetchTag() {
        return $this->fetch(\App\Models\Tag::class);
    }
}
