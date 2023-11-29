<div class="row">
    <div class="col-md-12">
        <table width="100%">
            <tr>
                <td width="15%" style="vertical-align: top !important;">
                    <img src="{{ url($plant->image_url) }}" alt="{{ $plant->name }} Image" width="150" style="border-radius: 6px;" />
                </td>
                <td align="left" style="vertical-align: top !important;">
                    <h4>{{ $plant->name }}</h4>

                    <div class="row justify-content-between">
                        <div class="col-md-9">
                            <div class="row justify-content-center text-center text-white">
                                <div class="col-md-3" style="background: #35A24C; margin: 8px; padding: 12px;">
                                    <p>Sow Depth</p>
                                    <h4 class="text-white"><span class="dripicons dripicons-arrow-down"></span></h4>
                                    <h6 class="text-white">{{ $plant->sow_depth }}</h6>
                                    <?php
                                       $sow_depth = App\GardeningEssential::where('plant_id', $id)->where('essential_type_id', 1)->first();
                                    ?>
                                    @if($sow_depth)
                                        @if($sow_depth->link != "")
                                            <a href="{{ $sow_depth->link }}" target="_blank">
                                                <img src="{{ asset('assets/images/youtube.png') }}" title="{{ $sow_depth->link }}" width="50" alt="youtube Link" style="cursor: pointer;" />
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-md-3" style="background: #35A24C; margin: 8px; padding: 12px;">
                                    <p>Distance Between Plants</p>
                                    <h4 class="text-white"><span class="dripicons dripicons-swap"></span></h4>
                                    <h6 class="text-white">{{ $plant->distance_between_plants }}</h6>
                                    <?php
                                        $dbp = App\GardeningEssential::where('plant_id', $id)->where('essential_type_id', 2)->first();
                                    ?>
                                    @if($dbp)
                                        @if($dbp->link != "")
                                            <a href="{{ $dbp->link }}" target="_blank">
                                                <img src="{{ asset('assets/images/youtube.png') }}" title="{{ $dbp->link }}" width="50" alt="youtube Link" style="cursor: pointer;" />
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-md-3" style="background: #35A24C; margin: 8px; padding: 12px;">
                                    <p>Days Before Germination</p>
                                    <h4 class="text-white"><span class="bi bi-flower1"></span></h4>
                                    <h6 class="text-white">{{ $plant->days_before_germination }}</h6>
                                    <?php
                                        $dbg = App\GardeningEssential::where('plant_id', $id)->where('essential_type_id', 3)->first();
                                    ?>
                                    @if($dbg)
                                        @if($dbg->link != "")
                                            <a href="{{ $dbg->link }}" target="_blank">
                                                <img src="{{ asset('assets/images/youtube.png') }}" title="{{ $dbg->link }}" width="50" alt="youtube Link" style="cursor: pointer;" />
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div><br>
                            <div class="row justify-content-center text-center text-white">
                                <div class="col-md-3" style="background: #35A24C; margin: 8px; padding: 12px;">
                                    <p>Harvest In</p>
                                    <h4 class="text-white"><span class="bi bi-calendar-date-fill"></span></h4>
                                    <h6 class="text-white">{{ $daysRemaining }} Days</h6>
                                    <?php
                                        $hi = App\GardeningEssential::where('plant_id', $id)->where('essential_type_id', 4)->first();
                                    ?>
                                    @if($hi)
                                        @if($hi->link != "")
                                            <a href="{{ $hi->link }}" target="_blank">
                                                <img src="{{ asset('assets/images/youtube.png') }}" title="{{ $hi->link }}" width="50" alt="youtube Link" style="cursor: pointer;" />
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-md-3" style="background: #35A24C; margin: 8px; padding: 12px;">
                                    <p>Lowest Temperature</p>
                                    <h4 class="text-white"><span class="fa fa-temperature-low"></span></h4>
                                    <h6 class="text-white">{{ $plant->lowest_temperature }}</h6>
                                    <?php
                                        $lt = App\GardeningEssential::where('plant_id', $id)->where('essential_type_id', 5)->first();
                                    ?>
                                    @if($lt)
                                        @if($lt->link != "")
                                            <a href="{{ $lt->link }}" target="_blank">
                                                <img src="{{ asset('assets/images/youtube.png') }}" title="{{ $lt->link }}" width="50" alt="youtube Link" style="cursor: pointer;" />
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-md-3" style="background: #35A24C; margin: 8px; padding: 12px;">
                                    <p>Highest Temperature</p>
                                    <h4 class="text-white"><span class="fa fa-temperature-high"></span></h4>
                                    <h6 class="text-white">{{ $plant->highest_temperature }}</h6>
                                    <?php
                                        $ht = App\GardeningEssential::where('plant_id', $id)->where('essential_type_id', 6)->first();
                                    ?>
                                    @if($ht)
                                        @if($ht->link != "")
                                            <a href="{{ $ht->link }}" target="_blank">
                                                <img src="{{ asset('assets/images/youtube.png') }}" title="{{ $ht->link }}" width="50" alt="youtube Link" style="cursor: pointer;" />
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- <dil class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div id="chart-status"></div>
                                </div>
                            </div>
                        </dil> -->
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- <script>
    var series = [];
    var labels = [];
    var colors = [];
    @foreach ($harvested_plants_arr as $dateKey => $harvested_plant)
        series.push(parseInt("{{$harvested_plant['percentage_qty']}}", 10))
        labels.push("{{$harvested_plant['status']}}")
        colors.push("{{$harvested_plant['color']}}")
    @endforeach
    var chartStatus = {
        series: series,
        labels: labels,
        colors: colors,
        chart: {
          type: "donut",
          width: "100%",
          height: "350px",
        },
        legend: {
          position: "bottom",
        },
        plotOptions: {
          pie: {
            donut: {
              size: "30%",
            },
          },
        },
    }

    var chartVisitorsProfile = new ApexCharts(
        document.getElementById("chart-status"),
        chartStatus
    )
    chartVisitorsProfile.render()
</script> -->