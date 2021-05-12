@extends('layouts.ticket')
@section('recipient')
{{-- <section class="sheet padding-10mm"> --}}
    <!-- Write HTML just like a web page -->
    <article>
      {!! $company_address !!}
      {{$invoice->invoice_number}}
      {{$invoice->formattedInvoiceDate}}
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
    </article>
  {{-- </section> --}}
@endsection
<script type="text/javascript">
  <!--
    setTimeout(function () { window.print(); }, 500);
        window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
  //-->
  </script>
