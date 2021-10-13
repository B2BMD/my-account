<ul class="test-listing">
    @isset($lab_reports)
    @if ($lab_reports != '' && $lab_reports->status == 'success')
        @php
        $lab_reports = $lab_reports->data;
        if (!is_array($lab_reports)) {
            $lab_reports = [];
        }
        @endphp
        @foreach ($lab_reports as $data)
            <script>
                $(".search-bar").show();
            </script>
            <li class="test-list">
                <div class="test-list-inner">
                    <div class="left">
                        <img src="{{ asset('assets/images/tests/pin.png') }}" alt="pin">
                        <div>
                            <span class="main">{{ $data->pdf }}</span>
                            <span class="sub">
                                {{ date('l, M d', strtotime($data->created_at)) }} </span>
                        </div>
                    </div>
                    <div class="right">
                        <a class="btn white" href="https://www.b2bmdllc.com/lab_reports/uploads/{{ $case_id }}/{{ $data->pdf }}" target="__blank">View test</a>
                    </div>
                </div>
            </li>
        @endforeach
    @else
        <li class="test-list">
            <center> {{$lab_reports->message}} </center>
            <script>
                $("#test_search_bar").hide();
            </script>
        </li>
    @endif
    @endisset
</ul>