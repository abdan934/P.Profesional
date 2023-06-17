@extends('layout/template')

@section('isi-konten')
    
     
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
        
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                    <div class="testimonial-item text-center">
                            <div id="reader" width="600px"></div>
                            <input type="text" class="mt-3" id="result">
                    </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        // console.log(`Code matched = ${decodedText}`, decodedResult);
                html5QrcodeScanner.clear()
                $('#result').val(decodedText)
            }

            function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>


@endsection