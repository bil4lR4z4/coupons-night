@extends('admin.master')

@section('title', 'Add Marque')

@section('content')
<div class="container py-4">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Add Marque</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.marque.save') }}" method="POST">
                @csrf

                <div id="faq-wrapper">
                    @if($marques->count() > 0)
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($marques as $key => $marque)
                            <div class="faq-item border rounded p-3 mb-3">
                                <div class="mb-3">
                                    <textarea name="name[]" class="form-control editor" rows="5" placeholder="Enter Name">{{ $marque->name ?? '' }}</textarea>
                                    <input type="hidden" name="id[]" value="{{ $marque->id ?? '' }}" hidden>
                                </div>
                                @if($no != 1)
                                    <button type="button" class="btn btn-danger remove">Remove</button>
                                @endif
                                @php
                                    $no++;
                                @endphp
                            </div>
                        @endforeach
                    @else
                        <div class="faq-item border rounded p-3 mb-3">
                            <div class="mb-3">
                                <textarea name="name[]" class="form-control editor" rows="5" placeholder="Enter Name">{{ $marque->name ?? '' }}</textarea>
                            </div>
                            <button type="button" class="btn btn-danger remove">Remove</button>
                        </div>
                    @endif
                </div>

                <button type="button" class="btn btn-success mb-3" id="addMore">+ Add More</button>
                <br>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            placeholder: 'Write your Marque here...',
            height: 250
        });
    }

    initEditor('.editor');

    $('#addMore').on('click', function () {
        let uniqueId = 'editor_' + Date.now();

        let html = `
            <div class="faq-item border rounded p-3 mb-3">
                <div class="mb-3">
                    <textarea id="${uniqueId}" name="name[]" class="form-control" rows="5" placeholder="Enter answer" required></textarea>
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