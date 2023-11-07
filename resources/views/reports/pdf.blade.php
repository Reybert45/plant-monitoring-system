<html><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reports</title>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;     
        }
        #plant-table {
            border-collapse: collapse;
            width: 100%;
        }
        #plant-table td {
            border: 1px solid gray;
            padding: 4px 8px;
        }
        @page { margin: 12px; }
        body { margin: 12px; }
    </style>
</head><body>
    <div style="text-align: center;">
        <table style="margin: auto;">
            <tr>
                <td style="vertical-align: middle;" align="center;">
                    <img src="assets/images/mifs_logo.jpg" alt="MISFS Logo" width="60">
                </td>
                <td style="vertical-align: middle;">
                    <h1>MISF Report</h1>
                </td>
            </tr>
        </table>
    </div>
    <br />
    <table id="plant-table">
        <tr>
            <td style="font-weight: bold; text-align: center;">Plant</td>
            <td style="font-weight: bold; text-align: center;">Quantity</td>
            <td style="font-weight: bold; text-align: center;">Amount</td>
            <td style="font-weight: bold; text-align: center;">Harvested Date</td>
            <td style="font-weight: bold; text-align: center;">Employee In-charge</td>
        </tr>
        @forelse ($harvested_plants_list as $harvested_plant)
            <tr>
                <td>{{ $harvested_plant->plant->name }}</td>
                <td>{{ $harvested_plant->quantity }}</td>
                <td>{!! $harvested_plant->amount != 0 ? '<span style="font-family: DejaVu Sans;">&#x20B1;</span> '. $harvested_plant->amount : "" !!}</td>
                <td>{{ date('m/d/Y', strtotime($harvested_plant->harvested_date)) }}</td>
                <td>{{ mb_convert_case($harvested_plant->user->person->first_name, MB_CASE_TITLE, "UTF-8") .' '. (!in_array($harvested_plant->user->person->middle_name, ["",null,".","N/A","n/a","NA"]) ? substr(mb_convert_case($harvested_plant->user->person->middle_name, MB_CASE_TITLE, "UTF-8"), 0, 1).'.' : '') .' '. mb_convert_case($harvested_plant->user->person->last_name, MB_CASE_TITLE, "UTF-8") }}</td>
            </tr>
        @empty
            <tr>
                <td align="center" colspan="5" style="color: grey; padding: 32px 12px;">Nothing was found in the database.</td>
            </tr>
        @endforelse
    </table>
</body></html>