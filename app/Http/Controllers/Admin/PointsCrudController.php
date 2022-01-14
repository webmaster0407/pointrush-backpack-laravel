<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PointsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PointsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PointsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Points::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/points');
        CRUD::setEntityNameStrings('points', 'points');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::addColumn(['name' => 'id',        'type' => 'number',     'label' => 'ID',    'prefix' => '#']);
        CRUD::addColumn(['name' => 'title',     'type' => 'text',       'label' => 'Title']);
        CRUD::addColumn(['name' => 'lat',       'type' => 'number',     'label' => 'Lat']);
        CRUD::addColumn(['name' => 'lon',       'type' => 'number',     'label' => 'Lon']);
        CRUD::addColumn(['name' => 'start',     'type' => 'date',       'label' => 'Start']);
        CRUD::addColumn(['name' => 'stop',      'type' => 'date',       'label' => 'Stop']);
        CRUD::addColumn(['name' => 'radius',    'type' => 'number',     'label' => 'Radius']);
        CRUD::addColumn(['name' => 'time',      'type' => 'boolean',    'label' => 'Time']);
        CRUD::addColumn(['name' => 'showtitle', 'type' => 'boolean',    'label' => 'ShowTitle']);
        CRUD::addColumn(['name' => 'distort',   'type' => 'boolean',    'label' => 'Distort']);
        CRUD::addColumn(['name' => 'distortion','type' => 'number',     'label' => 'Distortion']);



    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PointsRequest::class);

        
        CRUD::addField(['name' => 'title',     'type' => 'text',       'label' => 'Title']);
        CRUD::addField(['name' => 'lat',       'type' => 'number',     'label' => 'Lat',    'default' => '35.13201367331942']);
        CRUD::addField(['name' => 'lon',       'type' => 'number',     'label' => 'Lon',    'default' => '-95.75683593750001']);
        // CRUD::addField(['name' => 'start',     'type' => 'date',       'label' => 'Start']);
        // CRUD::addField(['name' => 'stop',      'type' => 'date',       'label' => 'Stop']);
        CRUD::addField(['name' => 'radius',    'type' => 'number',     'label' => 'Radius', 'default' => '10']);
        // CRUD::addField(['name' => 'time',      'type' => 'boolean',    'label' => 'Show Timer']);
        // CRUD::addField(['name' => 'showtitle', 'type' => 'boolean',    'label' => 'Show Title']);
        // CRUD::addField(['name' => 'distort',   'type' => 'boolean',    'label' => 'Distort']);
        // CRUD::addField(['name' => 'distortion','type' => 'number',     'label' => 'Distortion']);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         * 
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
        // $this->setupCreateOperation();
        CRUD::setValidation(PointsRequest::class);

        
        CRUD::addField(['name' => 'title',     'type' => 'text',       'label' => 'Title']);
        CRUD::addField(['name' => 'lat',       'type' => 'number',     'label' => 'Lat']);
        CRUD::addField(['name' => 'lon',       'type' => 'number',     'label' => 'Lon']);
        CRUD::addField(['name' => 'start',     'type' => 'date',       'label' => 'Start']);
        CRUD::addField(['name' => 'stop',      'type' => 'date',       'label' => 'Stop']);
        CRUD::addField(['name' => 'radius',    'type' => 'number',     'label' => 'Radius']);
        CRUD::addField(['name' => 'time',      'type' => 'boolean',    'label' => 'Show Timer']);
        CRUD::addField(['name' => 'showtitle', 'type' => 'boolean',    'label' => 'Show Title']);
        CRUD::addField(['name' => 'distort',   'type' => 'boolean',    'label' => 'Distort']);
        CRUD::addField(['name' => 'distortion','type' => 'number',     'label' => 'Distortion']);

    }
}
