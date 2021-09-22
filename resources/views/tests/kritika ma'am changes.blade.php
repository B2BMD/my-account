<ul class="nav nav-tabs" id="leftTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link <?php if (!empty($yearArray) && empty($monthArray) && empty($weekArray)) {
            echo 'active';
        } ?>" id="year-tab" data-toggle="tab" href="#year" role="tab" aria-controls="year" aria-selected="true">Year</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link  <?php if (!empty($monthArray) && empty($weekArray)) {
            echo 'active';
        } ?>" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">Month</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link   <?php if (!empty($weekArray) && empty($yearArray) && empty($monthArray)) {
            echo 'active';
        } ?>" id="week-tab" data-toggle="tab" href="#week" role="tab" aria-controls="week" aria-selected="false">Week</a>
    </li>
</ul>
<div class="tab-content" id="leftTabContent">
    {{-- different docs --}}
    <div class="tab-pane fade  <?php if (!empty($yearArray) && empty($monthArray) && empty($weekArray)) {
        echo 'show active';
    } ?>" id="year" role="tabpanel" aria-labelledby="year-tab">
        {{-- Year Tab --}}
        <ul class="doctors-listing">
            @php $count=0; @endphp
            @foreach ($yearArray as $data)
                @php $count++ @endphp
                <li class="doctors-list" casenum="{{ $data->case_number }}" doc_info='{{ json_encode($data) }}'>
                    <div class="profile-icon">
                        <img src="data:image/png;base64,{{$data->doc_image ?? asset('doc.png')}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                        <div>
                            <span class="main">{{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}</span>
                            <span class="sub diagnos">{{ $data->diagnosis }}</span>
                        </div>
                    </div>
                    <div class="time-list">
                        <span><img src="{{ asset('assets/images/visits/bell.png') }}" alt="time">{{ date('l, M d', strtotime($data->created_at)) }} </span>
                        {{-- <a href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}" alt="dot"></a> --}}
                    </div>
                    <span class="bottom-line"></span>
                </li>
            @endforeach
            @if ($count == 0)
                <center> No Records Found </center>
            @endif
        </ul>
    </div>

    <div class="tab-pane fade  <?php if (!empty($monthArray) && empty($weekArray)) {
        echo 'show active';
    } ?>" id="month" role="tabpanel" aria-labelledby="month-tab">
        {{-- Month Tab --}}
        <ul class="doctors-listing">
            @php $count=0; @endphp
            @foreach ($monthArray as $data)
                @php $count++ @endphp
                <li class="doctors-list" casenum="{{ $data->case_number }}" doc_info='{{ json_encode($data) }}'>
                    <div class="profile-icon">
                        <img src="data:image/png;base64,{{$data->doc_image}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                        <div>
                            <span class="main">{{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}</span>
                            <span class="sub diagnos">{{ $data->diagnosis }}</span>
                        </div>
                    </div>
                    <div class="time-list">
                        <span><img src="{{ asset('assets/images/visits/bell.png') }}" alt="time"> {{ date('l, M d', strtotime($data->created_at)) }} </span>
                        <a href="javascript:void(0)"><img src="{{ asset('assets/images/visits/dots.png') }}" alt="dot"></a>
                    </div>
                    <span class="bottom-line"></span>
                </li>
            @endforeach
            @if ($count == 0)
                <center> No Records Found </center>
            @endif
        </ul>
    </div>

    <div class="tab-pane fade  <?php if (!empty($weekArray) && empty($yearArray) && empty($monthArray)) {
        echo 'show active';
    } ?>" id="week" role="tabpanel" aria-labelledby="week-tab">
        {{-- Week Tab --}}
        <ul class="doctors-listing">
            @php $count=0; @endphp
            @foreach ($weekArray as $data)
                @php $count++ @endphp
                <li class="doctors-list" casenum="{{ $data->case_number }}"
                    doc_info='{{ json_encode($data) }}'>
                    <div class="profile-icon">
                        <img src="data:image/png;base64,{{$data->doc_image}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                        <div>
                            <span
                                class="main">{{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}</span>
                            <span class="sub diagnos">{{ $data->diagnosis }}</span>
                        </div>
                    </div>
                    <div class="time-list">
                        <span><img src="{{ asset('assets/images/visits/bell.png') }}"
                                alt="time">
                            {{ date('l, M d', strtotime($data->created_at)) }}</span>
                        <a href="javascript:void(0)"><img
                                src="{{ asset('assets/images/visits/dots.png') }}"
                                alt="dot"></a>
                    </div>
                    <span class="bottom-line"></span>
                </li>
            @endforeach
            @if ($count == 0)
                <center> No Records Found </center>
            @endif
        </ul>
    </div>
</div>