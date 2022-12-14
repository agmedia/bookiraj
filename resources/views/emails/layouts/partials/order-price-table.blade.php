@push('css')
    <style>
        #products, #totals {
            /*font-family: "Roboto", Arial, Helvetica, sans-serif;*/
            font-size: 13px;
            border-collapse: collapse;
            width: 100%;
        }

        #products td, #products th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #totals td, #totals th {
            border: 1px solid #ddd;
            padding: 6px 8px;
        }

        #products tr:nth-child(even){background-color: #f2f2f2;}

        /*#products tr:hover {background-color: #ddd;}*/

        #products th {
            font-size: 15px;
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #163c68;
            color: white;
        }
    </style>
@endpush

<table id="products">
    <tr>
        <th>{{ __('front/common.apartment') }}</th>
        <th style="text-align: right;" width="25%">{{ __('front/common.total') }}</th>
    </tr>


    @foreach ($checkout['total']['items'] as $item)
        <tr>
            <td>{{ $item['price_text'] }} x {{ $item['count'] }} {{ $item['title'] }}</td>
            <td style="text-align: right;">{{ $item['total_text'] }}</td>
        </tr>
    @endforeach
</table>
<table id="totals">
    @foreach ($checkout['total']['total'] as  $item)
        <tr>

            <td style="border-left: none; text-align: right; ">{{ $item['title'] }}</td>
            <td style="border-left: none; text-align: right;" width="20%">{{ $item['total_text'] }}</td>
        </tr>
    @endforeach
</table>



