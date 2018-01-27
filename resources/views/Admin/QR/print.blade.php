@extends('layouts.adminLayouts')
@section('content')

    <main>
        <div class="text-center" id='print'>
            {!! QrCode::size(300)->generate( $qr ); !!}
        </div>
        <center>><input type="button" onclick="CallPrint('print');" value="Распечатать"/></center>

    </main>
    <script> function CallPrint(strid) {
            var prtContent = document.getElementById(strid);
            var prtCSS = '';
            var WinPrint = window.open('left=20,top=50,width=900,height =300,toolbar=0,scrollbars=1,status=0');

            var print = document.createElement("div");
            print.className = "contentpane";
            print.setAttribute("id", "print");
            print.setAttribute("style", "margin: 100px");
            print.appendChild(prtContent.cloneNode(true));

            WinPrint.document.body.appendChild(print);

            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }
    </script>

@stop