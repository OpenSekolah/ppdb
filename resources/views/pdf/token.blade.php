<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <style>
            body {
                background-color: #ffffff;
            }

            .card {
                width: 100%;
                text-align: center;
                background-color: #F3F4F6;
                padding: 4px !important;
            }

            .header {
                font-size: 11pt !important;
                font-weight: bold;
            }

            .token {
                font-weight: bold;
                color: #FF0000;
            }

            .footer {
                font-size: 9pt !important;
                color: #606060;
            }
        </style>
    </head>

    <body>
        <table class="table-auto" style="width: 100% !important;">
            <tbody>
            @foreach ($models as $items)
                <tr>
                    @foreach ($items as $item)
                    <td width="33.3%" style="padding: 5px !important;">
                        <div class="card">
                            <p class="header">Token No {{ $item['sequence'] }}</p>
                            <h2 class="token">{{ $item['token'] }}</h2>
                            <p class="footer">{{ $item['name'] }}</p>
                        </div>
                    </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>

</html>