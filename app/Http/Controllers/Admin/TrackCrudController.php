<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TrackRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;

/**
 * Class TrackCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TrackCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Track::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/track');
        CRUD::setEntityNameStrings('track', 'tracks');

        $this->crud->addFields($this->getFieldsData());

        $this->crud->setShowView('customTrackView.show');
        $this->crud->setEditView('customTrackView.edit');
        $this->crud->setCreateView('customTrackView.create');
        $this->crud->setListView('customTrackView.list');
        $this->crud->setReorderView('customTrackView.reorder');
        $this->crud->setDetailsRowView('customTrackView.details_row');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::addColumn(['name' => 'id', 'type' => 'number', 'label' => 'ID', 'prefix' => '#']); 
        CRUD::addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']); 
        CRUD::addColumn(['name' => 'hide_menu_bar', 'type' => 'boolean', 'label' => 'Hide Menu Bar']); 
        CRUD::addColumn(['name' => 'show_log_public', 'type' => 'boolean', 'label' => 'Show Log Public']); 
        CRUD::addColumn(['name' => 'visitor', 'type' => 'number', 'label' => 'Visitors']); 
        // CRUD::addColumn(['name' => 'user_id', 'type' => 'number', 'label' => 'User ID']); 
        // CRUD::addColumn([    // Select2Multiple = n-n relationship (with pivot table)
        //         'label'     => "Points",
        //         'type'      => "select",
        //         'name'      => 'points', // the method that defines the relationship in your Model
        //     ]);
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
        CRUD::setValidation(TrackRequest::class);
        // CRUD::addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']); 

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
                'name' => 'user_id',
                'type' => 'hidden',
                'value' => Auth::guard('backpack')->user()->id,
            ],
            [
                'name'=> 'title',
                'label' => 'Title',
                'type'=> 'text'
            ],
            [    // Select2Multiple = n-n relationship (with pivot table)
                'label'     => "Points",
                // 'type'      => ($show ? "select": 'select2_multiple'),
                'type'  => ($show ? 'select' : 'relationship'),
                'name'      => 'points', // the method that defines the relationship in your Model
                'ajax'  => true,
                'inline_create' => ['entity' => 'points'],
                'placeholder' => 'Add Points...',
                // optional
                // 'entity'    => 'tags', // the method that defines the relationship in your Model
                // 'model'     => "App\Models\Tag", // foreign key model
                // 'attribute' => 'name', // foreign key attribute that is shown to user
                // 'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            ],
            [   
                'name' => 'hide_menu_bar', 
                'type' => 'boolean', 
                'label' => 'Hide Menu Bar'
            ],
            [
                'name' => 'show_log_public', 
                'type' => 'boolean', 
                'label' => 'Show Log Public'
            ],
            // [
            //     'name' => 'visitor', 
            //     'type' => 'number', 
            //     'label' => 'Visitors'
            // ],
        ];
    }

    protected function setupShowOperation() {
        // by default the Show operation will try to show all columns in the db table,
        // but we can easily take over, and have full control of what columns are shown,
        // by changing this config for the Show operation
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumns($this->getFieldsData(true));
    }

    public function fetchPoints() {
        return $this->fetch(\App\Models\Points::class);
    }

}
