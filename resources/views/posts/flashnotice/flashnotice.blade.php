<script type="text/javascript">
    @if (session('error'))
        $(function () {
        toastr.error('{{ session('error') }}');
        });
    @endif
    @if (session('deleteerror'))
        $(function () {
        toastr.error('{{ session('deleteerror') }}');
        });
    @endif
    @if (session('deletesuccess'))
        $(function () {
        toastr.success('{{ session('deletesuccess') }}');
        });
    @endif
    @if (session('success'))
        $(function () {
        toastr.success('{{ session('success') }}');
        });
    @endif
    @if (session('updatesuccess'))
        $(function () {
        toastr.success('{{ session('updatesuccess') }}');
        });
    @endif
    @if (session('profilesuccess'))
        $(function () {
        toastr.success('{{ session('profilesuccess') }}');
        });
    @endif
    @if (session('warning'))
        $(function () {
        toastr.warning('{{ session('warning') }}');
        });
    @endif
    @if (session('info'))
        $(function () {
        toastr.info('{{ session('info') }}');
        });
    @endif
</script>
