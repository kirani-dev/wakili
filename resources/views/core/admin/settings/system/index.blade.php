@extends('layouts.dashboard')

@section('content')

    @include('common.auto_tabs',[
    'tabs_folder'=>'core.admin.settings.system.tabs',
    'tabs'=> ['category_types'],
    'base_url'=>'admin/settings/system'
   ])

@endsection
