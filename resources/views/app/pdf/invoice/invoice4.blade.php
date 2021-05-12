<!DOCTYPE html>
<html>

<head>
    <title>@lang('pdf_invoice_label') - {{$invoice->invoice_number}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css">
        /* -- Base -- */
        body {
            font-family: "DejaVu Sans";
        }

        html {
            margin: 0px;
            padding: 0px;
            margin-top: 1px;
        }

        .text-center {
            text-align: center
        }

        hr {
            margin: 0 30px 0 30px;
            color: rgba(0, 0, 0, 0.2);
            border: 0.5px solid #EAF1FB;
        }

        /* -- Header -- */

        .header-bottom-divider {
            color: rgba(0, 0, 0, 0.2);
            position: absolute;
            top: 90px;
            left: 0px;
            width: 100%;
        }

        .header-container {
            position: absolute;
            width: 100%;
            height: 90px;
            left: 0px;
            top: -50px;
        }

        .header-logo {
            height: 50px;
            margin-top: 20px;
            text-transform: capitalize;
            color: #817AE3;
        }

        .header {
            font-size: 4px;
            color: rgba(0, 0, 0, 0.7);
        }

        .content-wrapper {
            display: block;
            margin-top: 0px;
            padding-top: 1px;
            padding-bottom: 1px;
        }

        .company-address-container {
            padding-top: 1px;
            padding-left: 2px;
            float: left;
            width: 120px;
            margin-bottom: 1px;
        }

        .company-address-container h1 {
            font-size: 4px;
            line-height: 1px;
            letter-spacing: 0.05em;
            margin-bottom: 0px;
            margin-top: 1px;
        }

        .company-address {
            margin-top: 1px;
            text-align: left;
            font-size: 4px;
            line-height: 4px;
            color: #595959;
            width: 80px;
            word-wrap: break-word;
        }

        .invoice-details-container {
            float: right;
            padding: 30px 3px 0 0;
        }

        .attribute-label {
            font-size: 4px;
            line-height: 1px;
            padding-right: 5px;
            text-align: left;
            color: #55547A;
        }

        .attribute-value {
            font-size: 4px;
            line-height: 1px;
            text-align: right;
        }

        /* -- Shipping -- */

        .shipping-address-container {
            float: right;
            padding-left: 40px;
            width: 80px;
        }

        .shipping-address {
            font-size: 4px;
            line-height: 4px;
            color: #595959;
            padding: 1px 0px 0px 1px;
            margin: 0px;
            width: 80px;
            word-wrap: break-word;
        }

        /* -- Billing -- */

        .billing-address-container {
            padding-top: 50px;
            float: left;
            padding-left: 30px;
        }

        .billing-address-label {
            font-size: 12px;
            line-height: 18px;
            padding: 0px;
            margin-top: 27px;
            margin-bottom: 0px;
        }

        .billing-address-name {
            max-width: 160px;
            font-size: 8px;
            line-height: 22px;
            padding: 0px;
            margin: 0px;
        }

        .billing-address {
            font-size: 12px;
            line-height: 15px;
            color: #595959;
            padding: 45px 0px 0px 30px;
            margin: 0px;
            width: 160px;
            word-wrap: break-word;
        }

        /* -- Items Table -- */

        .items-table {
            margin-top: 1px;
            padding: 0px 10px 2px 1px;
            page-break-before: avoid;
            page-break-after: auto;
        }

        .items-table hr {
            height: 0.1px;
        }

        .item-table-heading {
            font-size: 4;
            text-align: center;
            color: rgba(0, 0, 0, 0.85);
            padding: 5px;
            color: #55547A;
        }

        tr.item-table-heading-row th {
            border-bottom: 0.620315px solid #E8E8E8;
            font-size: 4px;
            line-height: 1px;
        }

        tr.item-row td {
            font-size: 4px;
            line-height: 2px;
        }

        .item-cell {
            font-size: 4;
            text-align: center;
            padding: 5px;
            padding-top: 2px;
            color: #040405;
        }

        .item-description {
            color: #595959;
            font-size: 4px;
            line-height: 2px;
        }

        /* -- Total Display Table -- */

        .total-display-container {
            padding: 0 25px;
        }

        .total-display-table {
            border-top: none;
            page-break-inside: avoid;
            page-break-before: auto;
            page-break-after: auto;
            margin-left: 5px;
            margin-top: 20px;
        }

        .total-table-attribute-label {
            font-size: 6px;
            color: #55547A;
            text-align: left;
            padding-left: 5px;
        }

        .total-table-attribute-value {
            font-weight: bold;
            text-align: right;
            font-size: 6px;
            color: #040405;
            padding-right: 10px;
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .total-border-left {
            border: 1px solid #E8E8E8 !important;
            border-right: 0px !important;
            padding-top: 0px;
            padding: 8px !important;
        }

        .total-border-right {
            border: 1px solid #E8E8E8 !important;
            border-left: 0px !important;
            padding-top: 0px;
            padding: 8px !important;
        }

        /* -- Notes -- */

        .notes {
            font-size: 12px;
            color: #595959;
            margin-top: 15px;
            margin-left: 30px;
            width: 442px;
            text-align: left;
            page-break-inside: avoid;
        }

        .notes-label {
            font-size: 8px;
            line-height: 22px;
            letter-spacing: 0.05em;
            color: #040405;
            width: 108px;
            height: 19.87px;
            padding-bottom: 10px;
        }

        /* -- Helpers -- */

        .text-primary {
            color: #5851DB;
        }

        .text-center {
            text-align: center
        }

        table .text-left {
            text-align: left;
        }

        table .text-right {
            text-align: right;
        }

        .border-0 {
            border: none;
        }

        .py-2 {
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .py-8 {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .py-3 {
            padding: 3px 0;
        }

        .pr-20 {
            padding-right: 20px;
        }

        .pr-10 {
            padding-right: 10px;
        }

        .pl-20 {
            padding-left: 20px;
        }

        .pl-10 {
            padding-left: 10px;
        }

        .pl-0 {
            padding-left: 0;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <div style="padding-top: 1px">
            <div class="company-address-container company-address">
                {!! $company_address !!}
            </div>
            <div class="invoice-details-container">
                <table>
                    <tr>
                        <td class="attribute-label">@lang('pdf_invoice_number')</td>
                        <td class="attribute-value"> &nbsp;{{$invoice->invoice_number}}</td>
                    </tr>
                    <tr>
                        <td class="attribute-label">@lang('pdf_invoice_date')</td>
                        <td class="attribute-value"> &nbsp;{{$invoice->formattedInvoiceDate}}</td>
                    </tr>
                </table>
            </div>

            <div style="clear: both;"></div>
        </div>

        <div class="shipping-address-container shipping-address" @if($billing_address !=='</br>' ) style="float:left;" @else style="display:block; float:left: padding-left: 0px;" @endif>
            @if($shipping_address)
                <b>@lang('pdf_ship_to')</b> <br>

                {!! $shipping_address !!}
            @endif
        </div>

            <div style="position: relative; clear: both;">
                @include('app.pdf.invoice.partials.table1')
            </div>

        <div class="notes">
            @if($notes)
                <div class="notes-label">
                    @lang('pdf_notes')
                </div>

                {!! $notes !!}
            @endif
        </div>
    </div>
</body>

</html>
