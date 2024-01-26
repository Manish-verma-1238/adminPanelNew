@include('admin.common.header')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('category.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>States & UT</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item">States & UT</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">States & UT</h2>
            <p class="section-lead">
                On this page, you can grant permissions to book rides in a specific States & UT.
            </p>

            @include('admin.common.message')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Grant permissions to States & UT</h4>
                        </div>
                        <form id="stateId" action="{{route('states.update')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <div class="col-md-4">
                                        <h4>States</h4>
                                        @if(isset($states) && !empty($states))
                                        @php $displayStates = false; @endphp
                                        @foreach($states as $state)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="states[]" value="{{$state->name ?? ''}}" @if($state->show == 'yes' ) checked @endif>
                                            <label class="form-check-label" for="{{$state->name ?? ''}}">{{$state->name ?? ''}}</label>
                                        </div>
                                        @if($state->name === 'West Bengal')
                                        @break
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <h4>Union Territories</h4>
                                        @if(isset($states) && !empty($states))
                                        @foreach($states as $state)
                                        @if($state->name === 'Andaman and Nicobar Islands')
                                        @php $displayStates = true; @endphp
                                        @endif

                                        @if($displayStates)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="states[]" value="{{$state->name ?? ''}}" @if($state->show == 'yes' ) checked @endif>
                                            <label class="form-check-label" for="{{$state->name ?? ''}}">{{$state->name ?? ''}}</label>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                    <a href="{{route('dashboard')}}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>

@include('admin.common.footer')
@include('admin.assets.categoryjs')