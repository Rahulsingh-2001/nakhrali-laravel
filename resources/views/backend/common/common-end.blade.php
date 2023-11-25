<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('vendor/jsvalidation\js\jsvalidation.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- @if ($view_type == 'LISTING') --}}
<script src="{{ asset('lib/datatables/DataTables-bs/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('lib/datatables/DataTables-bs/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('lib/datatables/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('lib/datatables/responsive/js/responsive.bootstrap4.min.js') }}"></script>
{{-- @endif --}}

<script src="{{ asset('backend/dist/js/common-script.js') }}"></script>

@stack('custum-scripts')
</body>

</html>
