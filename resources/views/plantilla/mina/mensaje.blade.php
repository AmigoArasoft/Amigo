@if(session()->has('info'))
	<script>toastr.success("{{ session('info') }}")</script>
@endif
@if(session()->has('warning'))
	<script>toastr.warning("{{ session('warning') }}")</script>
@endif
@if(session()->has('error'))
	<script>toastr.error("{{ session('error') }}")</script>
@endif
@if(isset($errors) && count($errors))
    @foreach($errors->all() as $error)
    	<script>toastr.error("{{ $error }}")</script>
    @endforeach
@endif