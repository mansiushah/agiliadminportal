@extends('layouts.master')
@section('title', 'Analytics')
@section('content')
<div class="right_bottom_ttl analaytics_bottom_ttl">
    <div class="right_bottom_ttl_rht">
        <h4>Analytics</h4>
        <p>Track your advertising performance and audience insights</p>
    </div>

    <div class="right_bottom_ttl_lft analytics_rht_ttl">
        <div class="user_select_drpdwn mb-3">
            <label>Organisation</label>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option selected>ACME LTD.</option>
                <option>Asiatic Pvt. Ltd</option>
                <option>Green Valley Spa</option>
                <option>Happy Life Clinic</option>
                <option>Tech Solutions Inc</option>
            </select>
        </div>

        <div class="user_select_drpdwn mb-3">
            <label>Offer</label>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option selected>Summer Sale</option>
                <option>Free Coffee Monday</option>
                <option>Gym Membership Deal</option>
                <option>Summer Sale</option>
                <option>Tech Gadget Sale</option>
            </select>
        </div>

    </div>

</div>
<div class="row mb-4">
    <div class="col-sm-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-3">
        <div class="analytics_card">
            <div class="analytics_card_lft">
                <h6>Total Views</h6>
                <h2>15,234</h2>
            </div>
            <div class="analytics_card_rht">
                <img src="{{ url('public/assets/img/eye-blie-btn.svg') }}" alt="eye-blie-btn" class="img-fluid">
            </div>
        </div>
    </div>


    <div class="col-sm-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-3">
        <div class="analytics_card">
            <div class="analytics_card_lft">
                <h6>Total Clicks</h6>
                <h2>2,878</h2>
            </div>
            <div class="analytics_card_rht">
                <img src="{{ url('public/assets/img/click-blue-btn.svg') }}" alt="click-blue-btn" class="img-fluid">
            </div>
        </div>
    </div>


</div>
<div class="manage_user_main_card">
    <div class="manage_user_main manage_user_main_organizations mb-5 analytics__mains">
        <div class="manage_user_main_card_lft">
            <h3>Age & Gender Demographics</h3>
        </div>

        <div class="manage_user_main_card_rht user_mian_rights all_offer_tbl analytics_dropdown">
            <div class="user_select_drpdwn">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Views</option>
                    <option value="1">Clicks</option>
                </select>
            </div>

            <div class="user_select_drpdwn">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Last 24 hours</option>
                    <option value="1">Last 7 days</option>
                    <option value="2">Last 30 days</option>
                    <option value="3">Last 60 days </option>
                    <option value="3">Last 90 days </option>
                    <option value="3">All time</option>
                </select>
            </div>

            <div class="user_select_drpdwn">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Export</option>
                    <option value="1">CSV</option>
                    <option value="2">PDF</option>
                </select>
            </div>
        </div>
    </div>

    <div id="chartContainer">
        <canvas id="myChart"></canvas>
    </div>
    <!-- Bottom content -->
    <div class="chart-bottom">
        <div class="legend-item">
            <div class="legend-color dark-blue"></div>
            <strong>Men</strong>
            <span>22% (105)</span>
            <span>Cost per Clicks: £0.82</span>
        </div>
        <div class="legend-item">
            <div class="legend-color pink"></div>
            <strong>Women</strong>
            <span>69% (236)</span>
            <span>Cost per Clicks: £0.84</span>
        </div>
        <div class="legend-item">
            <div class="legend-color cyan"></div>
            <strong>Non-binary</strong>
            <span>9% (16)</span>
            <span>Cost per Clicks: £0.84</span>
        </div>
    </div>
    <!-- BOOOTM -->
</div>
</div>
 @endsection
 @push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function () {
        const ctx = $('#myChart');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['13-17', '18-24', '25-34', '35-44', '45-54', '55-64', '65+'],
                datasets: [
                    {
                        label: 'Men',
                        data: [1, 6, 5, 4, 3, 2, 1],
                        backgroundColor: '#1a1a66'
                    },
                    {
                        label: 'Women',
                        data: [2, 22, 34, 15, 9, 5, 2],
                        backgroundColor: '#ff6699'
                    },
                    {
                        label: 'Non-binary',
                        data: [1, 4, 8, 2, 1, 3, 1],
                        backgroundColor: '#33ccff'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.dataset.label + ': ' + context.raw;
                            }
                        }
                    },
                    legend: {
                        display: false // hide default legend (we built custom below chart)
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Count'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Age Groups'
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
