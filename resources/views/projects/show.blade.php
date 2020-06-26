@extends('layouts.app')

@section('content')
<!-- Page title -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <h2 class="page-title">
                Empty page
            </h2>
        </div>
    </div>
</div>
<!-- Content here -->
<projets-show-component guid="{{ $project->guid }}"></projets-show-component>
@endsection
