<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <style>
            body {
                font-size: 10pt !important;
            }
            /* Center tables for demo */
            table {
                margin: 0 auto;
                width: 100% !important;
            }

            /* Default Table Style */
            table {
                color: #333;
                background: white;
                border: 1px solid grey;
                font-size: 12pt;
                border-collapse: collapse;
            }

            table thead th,
            table tfoot th {
                color: #777;
                background: rgba(0,0,0,.1);
            }

            table caption {
                padding:.5em;
            }

            table th,
            table td {
                padding: .5em;
                border: 1px solid lightgrey;
            }

            /* Zebra Table Style */
            [data-table-theme*=zebra] tbody tr:nth-of-type(odd) {
                background: rgba(0,0,0,.05);
            }

            [data-table-theme*=zebra][data-table-theme*=dark] tbody tr:nth-of-type(odd) {
                background: rgba(255,255,255,.05);
            }

            /* Dark Style */
            [data-table-theme*=dark] {
                color: #ddd;
                background: #333;
                font-size: 12pt;
                border-collapse: collapse;
            }

            [data-table-theme*=dark] thead th,
            [data-table-theme*=dark] tfoot th {
                color: #aaa;
                background: rgba(0255,255,255,.15);
            }

            [data-table-theme*=dark] caption {
                padding:.5em;
                margin-bottom: 2em !important;
            }

            [data-table-theme*=dark] th,
            [data-table-theme*=dark] td {
                padding: .5em;
                border: 1px solid grey;
            }
        </style>
    </head>

    <body>
        <h3>{{$vote_name}}</h3>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Kandidat</th>
                    <th>Perolehan Suara</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $models as $key => $item)
                    <tr>
                        <td><img src="{{$item['photo']}}" /></td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['number_of_votes']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>

</html>