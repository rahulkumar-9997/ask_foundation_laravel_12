<script src="{{asset('backend/assets/js/jquery-3.7.1.min.js')}}" type="text/javascript"></script>
<!-- Bootstrap Core JS -->
<script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<!-- Feather Icon JS -->
<script src="{{asset('backend/assets/js/feather.min.js')}}" type="text/javascript"></script>
<!-- Slimscroll JS -->
<script src="{{asset('backend/assets/js/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<!-- Datatable JS -->
<script src="{{asset('backend/assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/assets/js/dataTables.bootstrap5.min.js')}}" type="text/javascript"></script>
<!-- Summernote JS -->
<script src="{{asset('backend/assets/plugins/summernote/summernote-bs4.min.js')}}" type="text/javascript"></script>
<!-- Select2 JS -->
<script src="{{asset('backend/assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
<!-- Datetimepicker JS -->
<script src="{{asset('backend/assets/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/assets/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<!-- Bootstrap Tagsinput JS -->
<script src="{{asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/assets/js/script.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/assets/plugins/toastr/toastify-js.js')}}" type="text/javascript"></script>
@stack('scripts')
@if(session()->has('success'))
<script>
   Toastify({   
       text: "{{ session()->get('success') }}",   
       duration: 5000,   
       gravity: "top",   
       position: "right",   
       className: "bg-success",   
       close: true,   
       onClick: function() {}   
   }).showToast();   
</script>
@endif
@if(session()->has('error'))
<script>
   Toastify({   
       text: "{{ session()->get('error') }}",   
       duration: 5000,   
       gravity: "top",   
       position: "right",   
       className: "bg-danger",   
       close: true,   
       onClick: function() {}   
   }).showToast();
   
</script>
@endif
@if($errors->any())
<script>
   @foreach($errors->all() as $error)   
   Toastify({   
       text: "{{ $error }}",   
       duration: 4000,   
       gravity: "top",   
       position: "right",   
       className: "bg-danger",   
       close: true,   
       onClick: function() {}   
   }).showToast();   
   @endforeach   
</script>
@endif