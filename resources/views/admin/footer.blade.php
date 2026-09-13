    </main>

    <footer class="app-footer">
        <strong>
            Copyright &copy; 2026&nbsp;
            <a href="{{ url('/') }}" class="text-decoration-none">Coupon Night</a>.
        </strong>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

<script src="{{ asset('admin/js/adminlte.js') }}"></script>
<script src="{{ asset('admin/js/script.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | TinyMCE Editor
    |--------------------------------------------------------------------------
    | Agar TinyMCE loaded hoga to chalega, warna error nahi dega.
    */
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: '.tinymce-editor',
            height: 500,
            menubar: true,
            branding: false,
            promotion: false,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table wordcount',
            toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image table | code preview fullscreen'
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Select2
    |--------------------------------------------------------------------------
    */
    if (typeof $ !== 'undefined' && $.fn.select2) {
        $('.select2').select2({
            width: '100%'
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Summernote Editor
    |--------------------------------------------------------------------------
    | .editor class Summernote ke liye rakhi hai.
    */
    if (typeof $ !== 'undefined' && $.fn.summernote) {
        $('.editor').summernote({
            height: 80,
            placeholder: 'Write your content here...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    }

    /*
    |--------------------------------------------------------------------------
    | DataTables
    |--------------------------------------------------------------------------
    | Agar kisi table par .datatable class hogi to auto DataTable ban jayegi.
    */
    if (typeof $ !== 'undefined' && $.fn.DataTable) {
        $('.datatable').each(function () {
            if (!$.fn.DataTable.isDataTable(this)) {
                $(this).DataTable();
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Flatpickr
    |--------------------------------------------------------------------------
    | Date fields ke liye.
    */
    if (typeof flatpickr !== 'undefined') {
        flatpickr('.flatpickr', {
            dateFormat: 'Y-m-d'
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Sortable
    |--------------------------------------------------------------------------
    */
    if (typeof Sortable !== 'undefined') {
        const connectedSortables = document.querySelectorAll('.connectedSortable');

        connectedSortables.forEach((connectedSortable) => {
            new Sortable(connectedSortable, {
                group: 'shared',
                handle: '.card-header',
            });
        });

        const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = 'move';
        });
    }

});
</script>
<script>
document.querySelectorAll('.sidebar-menu .nav-item').forEach(function(item) {
    item.addEventListener('mouseenter', function() {
        var submenu = this.querySelector('.nav-treeview');
        if (!submenu) return;

        var rect = this.getBoundingClientRect();
        var submenuHeight = submenu.offsetHeight || 200;
        var viewportHeight = window.innerHeight;

        // Left position - sidebar ke right side mein
        submenu.style.left = rect.right + 'px';

        // Smart vertical positioning
        var topPos = rect.top;

        // Agar submenu neeche viewport se bahar jayega to upar shift karo
        if (topPos + submenuHeight > viewportHeight - 10) {
            topPos = viewportHeight - submenuHeight - 10;
        }

        // Agar negative ho jaye to top pe rakh do
        if (topPos < 0) topPos = 5;

        submenu.style.top = topPos + 'px';
    });
});
</script>
<script>
    setTimeout(() => {

        document.querySelectorAll('.admin-toast-alert').forEach((alert) => {

            alert.style.transition = '0.5s';
            alert.style.opacity = '0';

            setTimeout(() => {
                alert.remove();
            }, 500);

        });

    }, 3000); // 3 seconds
</script>
@stack('scripts')

</body>
</html>

<x-delete-modal />