@extends(backpack_view('blank'))

@php
   // $widgets['before_content'][] = [
   //     'type'        => 'jumbotron',
   //     'heading'     => trans('backpack::base.welcome'),
   //     'content'     => trans('backpack::base.use_sidebar'),
   //     'button_link' => backpack_url('logout'),
   //     'button_text' => trans('backpack::base.logout'),
   // ];

    $userCount = App\Models\User::count();
    $trackCount = App\Models\Track::count();
    $pointsCount = App\Models\Points::count();  
    $userid = Illuminate\Support\Facades\Auth::guard('backpack')->user()->id;
    $mytrackCount = App\Models\Track::where('user_id', '=', $userid)->get()->count();
 
    // notice we use Widget::add() to add widgets to a certain group
    Widget::add()->to('before_content')->type('div')->class('row')->content([
        // notice we use Widget::make() to add widgets as content (not in a group)
        Widget::make()
            ->type('progress')
            ->class('card border-0 text-white bg-primary')
            ->progressClass('progress-bar')
            ->value($userCount)
            ->description('Registered users.')
            ->progress(100*(int)$userCount/300)
            ->hint(300-$userCount.' more until next milestone.'),

        // alternatively, to use widgets as content, we can use the same add() method,
        // but we need to use onlyHere() or remove() at the end
        
        Widget::add()
            ->type('progress')
            ->class('card border-0 text-white bg-success')
            ->progressClass('progress-bar')
            ->value($trackCount)
            ->description('Total Tracks.')
            ->progress(100*(int)$trackCount/500)
            ->hint(500-$trackCount.' more until next milestone.')
            ->onlyHere(),

         Widget::add()
            ->type('progress')
            ->class('card border-0 text-white bg-warning')
            ->progressClass('progress-bar')
            ->value($pointsCount)
            ->description('Total Points.')
            ->progress(100*(int)$pointsCount/2000)
            ->hint(2000-$pointsCount.' more until next milestone.')
            ->onlyHere(),

        Widget::add()
            ->type('progress')
            ->class('card border-0 text-white bg-dark')
            ->progressClass('progress-bar')
            ->value($mytrackCount)
            ->description('Your Tracks.')
            ->progress(100*(int)$mytrackCount/100)
            ->hint(100-$mytrackCount.' more until next milestone.')
            ->onlyHere(),
            
        ]); 
     
@endphp

@section('content')
@endsection