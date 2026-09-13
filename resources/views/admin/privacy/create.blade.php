@extends('admin.master')

@section('title', 'Add Privacy FAQs')

@section('content')
<div class="container py-4">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Add Privacy FAQs</h4>
            <a href="{{ route('admin.privacy.index') }}" class="btn btn-secondary btn-sm">Back</a>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix these errors:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.privacy.store') }}" method="POST">
                @csrf

                <div id="faq-wrapper">
                    <div class="faq-item border rounded p-3 mb-3">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Question</label>
                            <input type="text" name="question[]" class="form-control" placeholder="Enter question" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Answer</label>
                            <textarea name="answer[]" class="form-control editor" rows="5" placeholder="Enter answer" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sort Order</label>
                            <input type="number" name="sort_order[]" class="form-control" value="0">
                        </div>

                        <button type="button" class="btn btn-danger remove">Remove</button>
                    </div>
                </div>

                <button type="button" class="btn btn-success mb-3" id="addMore">+ Add More</button>
                <br>

                <button type="submit" class="btn btn-primary">Save FAQs</button>
            </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    function initEditor(selector) {
        $(selector).summernote({
            placeholder: 'Write your Privacy FAQ answer here...',
            height: 250
        });
    }

    initEditor('.editor');

    $('#addMore').on('click', function () {
        let uniqueId = 'editor_' + Date.now();

        let html = `
            <div class="faq-item border rounded p-3 mb-3">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Question</label>
                    <input type="text" name="question[]" class="form-control" placeholder="Enter question" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Answer</label>
                    <textarea id="${uniqueId}" name="answer[]" class="form-control" rows="5" placeholder="Enter answer" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Sort Order</label>
                    <input type="number" name="sort_order[]" class="form-control" value="0">
                </div>

                <button type="button" class="btn btn-danger remove">Remove</button>
            </div>
        `;

        $('#faq-wrapper').append(html);
        initEditor('#' + uniqueId);
    });

    $(document).on('click', '.remove', function () {
        if ($('.faq-item').length > 1) {
            let item = $(this).closest('.faq-item');

            item.find('textarea').each(function () {
                if ($(this).next('.note-editor').length) {
                    $(this).summernote('destroy');
                }
            });

            item.remove();
        }
    });

});
</script>
@endpush