@extends("newlook3.main")
@section('style')
    <style>
      .image-radio-group {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-radio-item {
            position: relative;
            margin: 0 10px;
            cursor: pointer;
        }

        .image-radio-item input[type="radio"] {
            position: absolute;
            clip: rect(0, 0, 0, 0);
            pointer-events: none;
        }

        .image-radio-item img {
            width: 100px;
            border: 3px solid transparent;
            transition: border-color 0.3s;
            padding: 5px
        }

        .image-radio-item input[type="radio"]:checked + img {
            border-color: #f1602b;
        }
    </style>
@endsection
@section('content')
<div class="content-wrapper">
  <div class="container-full">
    <section class="content">
      <div class="row mx-auto">
        <div class="card card-body">
            <div class="edit-form">
                <form id="vtuForm" class="form-horizontal form-element col-12" method="POST" action="{{route('purchaseData')}}">
                    @csrf
                    <input type="hidden" name="network" id="network">
                    <div class="form-group row align-items-center">
                        <label for="network" class="col-sm-4 form-label image-radio">Select Biller</label>
                        <div class="image-radio-group col-sm-8">
                            <label class="image-radio-item">
                                <input type="radio" name="network" value="GLO" id="network-glo">
                                <img src="https://www.seekpng.com/png/full/222-2223040_glo-highest-gainer-in-voice-data-subscribers-in.png" alt="Glo">
                            </label>
                            <label class="image-radio-item">
                                <input type="radio" name="network" value="MTN" id="network-mtn">
                                <img src="https://seeklogo.com/images/M/mtn-logo-40644FC8B0-seeklogo.com.png" alt="MTN">
                            </label>
                            <label class="image-radio-item">
                                <input type="radio" name="network" value="Airtel" id="network-airtel">
                                <img src="https://seeklogo.com/images/A/airtel-logo-593C498F73-seeklogo.com.png" alt="Airtel">
                            </label>
                            <label class="image-radio-item">
                                <input type="radio" name="network" value="9mobile" id="network-9mobile">
                                <img src="https://www.seekpng.com/png/full/344-3443327_9mobile-mtn-glo-airtel-and-9mobile.png" alt="9Mobile">
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 form-label">Purchase Type</label>
                        <div class="col-sm-10">
                            <input type="radio" id="bundle-radio" name="bundle-type" value="data" checked>
                            <label for="bundle-radio">Data Bundle</label>

                            <input type="radio" id="airtime-radio" name="bundle-type" value="airtime">
                            <label for="airtime-radio">Airtime</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="data" class="col-sm-2 form-label">Phone Number(+234)</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="phone" name="phone_number" placeholder="phone number" required value="+2348145302579">
                        </div>
                    </div>
                    {{-- select data amount --}}
                    <div class="form-group row" id="data-bundle-select-row">
                        <label for="data" class="col-sm-2 form-label">Data Bundle</label>
                        <div class="col-sm-10">
                            <select name="data_plan" class="form-control ps-2" id="data-bundle-select">
                                <option value="">Select a Network provider</option>
                            </select>
                        </div>
                    </div>

                    {{-- select airtime amount --}}
                    <div class="form-group row" id="airtime-amount-row" style="display:none;">
                        <label for="airtime-amount" class="col-sm-2 form-label">Airtime Amount</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="airtime-amount" name="airtime_amount" placeholder="Enter airtime amount" min="50">
                        </div>
                    </div>
                    <input type="hidden" name="amount" id="data-bundle-amount">

                    <div class="form-group row">
                        <div class=" col-sm-10">
                            <button type="submit" class="btn-custom wp100 waves-effect waves-dark">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </section>
  </div>
</div>

@endsection
@section('js')
{{-- <script>
    $(document).ready(function () {
       
       $('#vtuForm').on('submit', function (event) {
           event.preventDefault();

           const formData = $(this).serialize();

           $.ajax({
               url: "{{route('purchaseData')}}",
               method: "POST",
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: formData,
               success: function (response) {
                   // Handle the successful response
                   swal.fire("Success!", response.message, "success");
               },
               error: function (xhr, status, error) {
                   // Handle the error response
                   const response = JSON.parse(xhr.responseText);
                   swal.fire("Error!", response.message, "error");
               },
           });
       });
   });

</script>
<script>
   function updateDataBundles() {
       const selectedNetwork = document.querySelector('input[name="network"]:checked').value;
       const dataBundleSelect = document.getElementById('data-bundle-select');
       const dataBundleAmount = document.getElementById('data-bundle-amount');

       // Fetch the data bundles from VtuController
       fetch('/get-data-bundles', {
           method: 'POST',
           headers: {
           'Content-Type': 'application/json',
           'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
           },
           body: JSON.stringify({ network: selectedNetwork })
       })
       .then(response => response.json())
       .then(dataBundles => {
           // Clear the current options
           dataBundleSelect.innerHTML = '<option value="">Select data bundle</option>';
           // Add the new options
           dataBundles.forEach(bundle => {
           const option = document.createElement('option');
           option.value = bundle.value;
           option.textContent = bundle.text;
           dataBundleSelect.appendChild(option);
           });

           // Update the data bundle amount
           dataBundleSelect.addEventListener('change', () => {
           const selectedDataBundle = dataBundles.find(bundle => bundle.value === dataBundleSelect.value);
           if (selectedDataBundle) {
               const amount = selectedDataBundle.amount; // replace "amount" with the correct property name
               dataBundleAmount.value = amount;
           } else {
               dataBundleAmount.value = '';
           }
           });
       })
       .catch(error => {
           console.error('Error fetching data bundles:', error);
       });
   }

   document.getElementById('network-glo').addEventListener('change', updateDataBundles);
   document.getElementById('network-mtn').addEventListener('change', updateDataBundles);
   document.getElementById('network-airtel').addEventListener('change', updateDataBundles);
   document.getElementById('network-9mobile').addEventListener('change', updateDataBundles);
</script> --}}
<script>
    $(document).ready(function () {
       
       $('#vtuForm').on('submit', function (event) {
           event.preventDefault();

           const formData = $(this).serialize();
           $.ajax({
               url: "{{route('purchaseData')}}",
               method: "POST",
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: formData,
               success: function (response) {
                   // Handle the successful response
                   swal.fire("Success!", response.message, "success");
               },
               error: function (xhr, status, error) {
                   // Handle the error response
                   const response = JSON.parse(xhr.responseText);
                   swal.fire("Error!", response.message, "error");
               },
           });
       });
   });

</script>
<script>

   function updatePurchaseType() {
       const purchaseType = document.querySelector('input[name="bundle-type"]:checked').value;
       const dataBundleSelectRow = document.getElementById('data-bundle-select-row');
       const airtimeAmountRow = document.getElementById('airtime-amount-row');

       if (purchaseType === 'airtime') {
           dataBundleSelectRow.style.display = 'none';
           airtimeAmountRow.style.display = 'block';
       } else {
           dataBundleSelectRow.style.display = 'block';
           airtimeAmountRow.style.display = 'none';
       }
   }


   function updateDataBundles() {
       const selectedNetwork = document.querySelector('input[name="network"]:checked').value;
       const dataBundleSelect = document.getElementById('data-bundle-select');
       const dataBundleAmount = document.getElementById('data-bundle-amount');

       // Fetch the data bundles from VtuController
       fetch('/get-data-bundles', {
           method: 'POST',
           headers: {
           'Content-Type': 'application/json',
           'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
           },
           body: JSON.stringify({ network: selectedNetwork })
       })
       .then(response => response.json())
       .then(dataBundles => {
           // Clear the current options
           dataBundleSelect.innerHTML = '<option value="">Select data bundle</option>';
           // Add the new options
           dataBundles.forEach(bundle => {
           const option = document.createElement('option');
           option.value = bundle.value;
           option.textContent = bundle.text;
           dataBundleSelect.appendChild(option);
           });

           // Update the data bundle amount
           dataBundleSelect.addEventListener('change', () => {
           const selectedDataBundle = dataBundles.find(bundle => bundle.value === dataBundleSelect.value);
           if (selectedDataBundle) {
               const amount = selectedDataBundle.amount; // replace "amount" with the correct property name
               dataBundleAmount.value = amount;
           } else {
               dataBundleAmount.value = '';
           }
           });
       })
       .catch(error => {
           console.error('Error fetching data bundles:', error);
       });
   }

   function validateForm(e) {
       const purchaseType = document.querySelector('input[name="bundle-type"]:checked').value;
       const dataBundleSelect = document.getElementById('data-bundle-select');
       const airtimeAmount = document.getElementById('airtime-amount');
       const dataPlan = document.getElementById('data-bundle-select');
       const selectedNetwork = document.querySelector('input[name="network"]:checked').value;

       document.getElementById('network').value = selectedNetwork;

       if (purchaseType === 'airtime') {
           dataPlan.value = 'airtime';
       }

       if (purchaseType === 'data' && dataBundleSelect.value === '') {
           e.preventDefault();
           alert('Please select a data bundle.');
           return false;
       } else if (purchaseType === 'airtime' && (airtimeAmount.value === '' || parseFloat(airtimeAmount.value) < 1)) {
           e.preventDefault();
           alert('Please enter a valid airtime amount.');
           return false;
       }

       return true;
   }



   document.getElementById('vtuForm').addEventListener('submit', validateForm);

   document.getElementById('network-glo').addEventListener('change', updateDataBundles);
   document.getElementById('network-mtn').addEventListener('change', updateDataBundles);
   document.getElementById('network-airtel').addEventListener('change', updateDataBundles);
   document.getElementById('network-9mobile').addEventListener('change', updateDataBundles);
   //
   document.getElementById('bundle-radio').addEventListener('change', updatePurchaseType);
   document.getElementById('airtime-radio').addEventListener('change', updatePurchaseType);

</script>
@endsection
